<?php

namespace App\Cart;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Product;
use App\Transaction;
use App\Cart\CartCollection;
use App\Customer;
use App\Stok;
use App\Ingredient;
use App\ProdukIngredient;
use DB;
/**
 * Transaction Draft Interface.
 */
abstract class TransactionDraft
{
    public $items = [];
    //public $items2 = [];
    public $type;
    public $customer = ['name' => null, 'phone' => null];
    public $payment;
    public $tanggal;
    
    public function toArray()
    {
        return [
            'invoice_no' => 2,
            'date'       => 1,
            'items'      => $this->items(),
            'total'      => 0,
            'payment'    => 0,
            'customer'   => 0,
            'status_id'  => 0,
            'creator_id' => 0,
            'remark'     => '',
        ];
    }

    public function items()
    {
        return collect($this->items)->sortBy('name');
    }

    public function addItem(Item $item)
    {
        $this->items[] = $item;

        return $item->product;
    }

    public function removeItem($itemKey)
    {
        unset($this->items[$itemKey]);
    }

    public function empty()
    {
        $this->items = [];
    }

    public function getSubtotal()
    {
        return $this->items()->sum('subtotal');
    }

    public function getTotal()
    {
        return $this->items()->sum('subtotal') - $this->getDiscountTotal();
    }

    public function getPokok()
    {
        return $this->items()->sum('subTotalPokok');
    }

    public function getItemsCount()
    {
        return $this->items()->count();
    }

    public function getTotalQty()
    {
        return $this->items()->sum('qty');
    }

    public function getDiscountTotal()
    {
        return $this->items()->sum('item_discount_subtotal');
    }

    public function updateItem($itemKey, $newItemData)
    {
        if (!isset($this->items[$itemKey])) {
            return;
        }

        $item = $this->items[$itemKey];

        $this->items[$itemKey] = $item->updateAttribute($newItemData);

        return $item;
    }

    public function search(Product $product)
    {
        $productItem = $this->items()->where('id', $product->id)->first();

        return $productItem;
    }

    public function searchItemKeyFor(Product $product)
    {
        return $this->items()->search(function ($item, $key) use ($product) {
            return $item->product->id == $product->id;
        });
    }

    public function getExchange()
    {
        return $this->payment - $this->getTotal();
    }

    public function store()
    {
        $transaction = new Transaction();
        $transaction->invoice_no = $this->getNewInvoiceNo();
        $transaction->items = $this->getItemsArray();
        $transaction->type = $this->type;
        $transaction->payment = $this->getTotal();
        $transaction->user_id = auth()->id() ?: 1;
        $transaction->created_at = $this->tanggal;
        $transaction->save();
        
        $transaction2 = new Transaction();
        $transaction2->setConnection('mysql2');
        $transaction2->setTable('transactions');
        $transaction2->invoice_no = $transaction->invoice_no;
        $transaction2->items = $transaction->items;
        $transaction2->type = $transaction->type;
        $transaction2->payment = $transaction->payment;
        $transaction2->user_id = auth()->id() ?: 1;
        $transaction2->store_id =  1;
        $transaction2->created_at = $this->tanggal;
        $transaction2->save();
        
        return $transaction;
    }

    public function getNewInvoiceNo()
    {
        $prefix = 'INV';

        $sNextKode = "";
        $sLastKode = "";
        $value = Transaction::orderBy('id', 'desc')->first();
        if ($value != "") { // jika sudah ada, langsung ambil dan proses...
            $sLastKode = intval(substr($value->invoice_no, 3)); // ambil 3 digit terakhir
            $sLastKode = intval($sLastKode) + 1; // konversi ke integer, lalu tambahkan satu
            $sNextKode = $prefix.substr(preg_replace('/\D/', '', $this->tanggal),2,4).substr($sLastKode,4); // format hasilnya dan tambahkan prefix
        } else { // jika belum ada, gunakan kode yang pertama
            $sNextKode = $prefix.substr(preg_replace('/\D/', '', $this->tanggal),2,4).'0001';
        }
        return $sNextKode;

        //return $prefix.'0001';
    }

    protected function getItemsArray()
    {
        $items = [];
        foreach ($this->items as $item) {
            $items[] = [
                'id'                     => $item->product->id,
                'name'                   => $item->name,
                'unit'                   => $item->unit,
                'price'                  => $item->price,
                'qty'                    => $item->qty,
                'item_discount'          => $item->item_discount,
                'item_discount_subtotal' => $item->item_discount_subtotal,
                'subtotal'               => $item->subtotal,
            ];

            $product = Product::find($item->product->id);

            foreach($product->productIngredient as $item2){
                $ingredient = Ingredient::where('id', $item2->id)->first();
                //dd($ingredient);

                $produk_ingredient = ProdukIngredient::where('product_id',$product->id)->where('ingredient_id', $ingredient->id)->first();
                
                $ingredient->stok = $ingredient->stok - ($produk_ingredient->nilai* $item->qty);
                $ingredient->save();

                $stok = new Stok;
                $stok->kode_produk = $ingredient->id;
                $stok->no_invoice = $this->getNewInvoiceNo();
                //$stok->nama = $ingredient->ingredient_nama;
                $stok->keluar = $produk_ingredient->nilai * $item->qty;
                $stok->sisa_stok = $ingredient->stok;
                $stok->harga = $produk_ingredient->harga* $item->qty;
                $stok->created_at = $this->tanggal;
                $stok->save();
                
                $stok2 = new Stok;
                $stok2->setConnection('mysql2');
                $stok2->setTable('stoks');
                $stok2->store_id = 1;
                $stok2->kode_produk = $ingredient->id;
                $stok2->no_invoice = $stok->no_invoice;
                $stok2->keluar = $produk_ingredient->nilai * $item->qty;
                $stok2->sisa_stok = $ingredient->stok;
                $stok2->harga = $produk_ingredient->harga* $item->qty;
                $stok2->created_at = $this->tanggal;
                $stok2->save();
                
            }
        }

        return $items;
    }

    public function destroy()
    {
        $cart = app(CartCollection::class);

        return $cart->removeDraft($this->draftKey);
    }

    public function getDraftkey()
    {
        $cart = app(CartCollection::class);

        return $cart->get($this->draftKey);
    }
}
