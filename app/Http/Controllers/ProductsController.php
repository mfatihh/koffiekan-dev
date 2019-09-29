<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Unit;
use App\Ingredient;
use App\ProdukIngredient;
use App\KategoryIngredient;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $unit = Unit::all();
        $ingredient = Ingredient::all();
        $editableProduct = null;
        $q = $request->get('q');
        $products = Product::join('product_units', 'product_units.id', 'products.unit_id')
        ->select('product_units.name as kategori', 'products.*')
        ->latest()
        ->get();

        if (in_array($request->get('action'), ['edit', 'delete']) && $request->has('id')) {
            $editableProduct = Product::find($request->get('id'));
        }
        //dd($ingredient);

        return view('products.index', compact('products', 'editableProduct', 'unit', 'ingredient'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $newProduct = $request->validate([
            'name'         => 'required',
            'cash_price'   => 'required|numeric', 
            'kode_produk' => 'required',
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->cash_price = $request->cash_price;
        $product->h_i = $request->h_i;
        $product->kode_produk = $request->kode_produk;
        $product->unit_id = $request->unit_id;
        $product->save();
        
        $product2 = new Product;
        $product2->setConnection('mysql2');
        $product2->setTable('products');
        $product2->product_id = $product->id;
        $product2->store_id = 1;
        $product2->name = $request->name;
        $product2->cash_price = $request->cash_price;
        $product2->h_i = $request->h_i;
        $product2->kode_produk = $request->kode_produk;
        $product2->unit_id = $request->unit_id;
        $product2->save();

        $product->productIngredient()->detach();
        foreach ($request->category as $subCategory) {
            $product->productIngredient()->attach($subCategory);
        }

        flash(trans('product.created'), 'success');

        return redirect()->route('products.index')->with('message', 'Tambah data berhasil');
    }

    public function edit($id){
        $unit = Unit::all();
        $ingredient = Ingredient::all();
        $product = Product::find($id);
        $product_ingredient = ProdukIngredient::join('products', 'products.id', 'product_ingredient.product_id')->join('ingredient', 'ingredient.id', 'product_ingredient.ingredient_id')->where('product_ingredient.product_id', $id)->get();
        return view('products.edit', compact('unit','ingredient','product', 'product_ingredient'));
    }

    public function update(Request $request, $id)
    {
        $productData = $request->validate([
            'name'         => 'required',
            'cash_price'   => 'required|numeric',
            'kode_produk' => 'required',
        ]);

        
        $product = Product::find($id);
        $product->name = $request->name;
        $product->cash_price = $request->cash_price;
        $product->h_i = $request->h_i;
        $product->kode_produk = $request->kode_produk;
        $product->unit_id = $request->unit_id;
        $product->save();
        
        $product2 = Product::first()->setConnection('mysql2')->setTable('products')->where('product_id', $id)->where('store_id', 1)->first();
        $product2->name = $request->name;
        $product2->cash_price = $request->cash_price;
        $product2->h_i = $request->h_i;
        $product2->kode_produk = $request->kode_produk;
        $product2->unit_id = $request->unit_id;
        $product2->save();

        flash(trans('product.updated'), 'success');

        return redirect()->route('products.index')->with('message', 'Update data berhasil');
    }

    public function updateSatuan(Request $request)
    {
        $productData = $request->validate([
            'ingredient_id' => 'required',
            'product_id' => 'required',
        ]);

        $product = ProdukIngredient::join('ingredient', 'ingredient.id', 'product_ingredient.ingredient_id')->where('product_ingredient.product_id',request('product_id'))->where('product_ingredient.ingredient_id', request('ingredient_id'))->first();

        $product_ingredient = ProdukIngredient::where('product_id',request('product_id'))->where('ingredient_id', request('ingredient_id'))->first();
        $product_ingredient->nilai = $request->nilai;
        $product_ingredient->harga = $request->nilai / $product->satuan_harga *  $product->harga_satuan;
        $product_ingredient->save();

        flash(trans('product.updated'), 'success');

        return redirect()->back()->with('message', 'Update data berhasil');
    }

    public function addSatuan(Request $request)
    {
        $productData = $request->validate([
            'ingredient_id' => 'required',
            'product_id' => 'required',
        ]);
        
        if(ProdukIngredient::where('ingredient_id', $request->ingredient_id)->where('product_id', $request->product_id)->first() != null){ 
            return redirect()->back()->with('message', 'data sudah ada');
        }
        else{
        $product = new ProdukIngredient;
        $product->ingredient_id = $request->ingredient_id;
        $product->product_id = $request->product_id;
        $product->save();
        
        return redirect()->back()->with('message', 'tambah data berhasil');}

    }

    public function destroySatuan(Request $request){
        
        $productData = $request->validate([
            'ingredient_id' => 'required',
            'product_id' => 'required',
        ]);

        $product = ProdukIngredient::where('product_id',request('product_id'))->where('ingredient_id', request('ingredient_id'))->first();
        $product->delete();

        flash(trans('product.updated'), 'success');

        return redirect()->back()->with('message', 'Hapus data berhasil');
    }

    public function destroy($id)
    {
        $product = Product::find($id)->delete();
        return back()->with('message', 'Hapus data berhasil');;
    }

    public function priceList()
    {
        $products = Product::orderBy('name')->with('unit')->get();

        return view('products.price-list', compact('products'));

        // $pdf = \PDF::loadView('products.price-list', compact('products'));
        // return $pdf->stream('price-list.pdf');
    }

    public function show($id)
    {
        $barang = Product::find($id);
        return view('products/detail', compact('barang'));
    }

    public function approve($id)
    {
        $barang = Product::find($id);
        $barang->status = 1;
        $barang->save();
        return redirect()->route('products.index');
    }

    public function denied($id)
    {
        $barang = Product::find($id);
        $barang->status = 2;
        $barang->save();
        return redirect()->route('products.index');
    }

    public function addKategory(Request $request)
    {   
        
        $product = new KategoryIngredient;
        $product->kategory_name = $request->kategory_name;
        // dd($product);
        $product->save();
        
        return redirect()->back()->with('message', 'tambah data berhasil');
    }

    
}
