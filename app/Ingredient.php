<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Ingredient extends Model
{
    protected $table = 'ingredient';
    protected $fillable = [
        'id',
        'kategory_ingredient_id',
        'ingredient_nama',
        'satuan',
        'expired_at'
    ];

    public function product()
    {
    	return $this->belongsToMany(Product::class,'products','product_id','ingredient_id');
    }

    public function kategory_ingredient()
    {
    	return $this->belongsToMany(KategoryIngredient::class,'id');
    }
}
