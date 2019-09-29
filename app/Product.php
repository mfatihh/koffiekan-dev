<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProdukIngredient;

class Product extends Model
{
    protected $guarded = [
        'created_at', 'updated_at'
    ];

    public function getPrice($type = 'cash')
    {
        if ($type == 'credit' && $this->credit_price) {
            return $this->credit_price;
        }

        return $this->cash_price;
    }

    public function getPriceModal()
    {
        return $this->harga_modal;
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function productIngredient()
    {
    	return $this->belongsToMany(Ingredient::class,'product_ingredient','product_id','ingredient_id');
    }

    public function ingredient()
    {
    	return $this->hasMany(ProdukIngredient::class,'product_id','ingredient_id', 'stok');
    }
}