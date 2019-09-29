<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class ProdukIngredient extends Model
{
    protected $table = 'product_ingredient';

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
