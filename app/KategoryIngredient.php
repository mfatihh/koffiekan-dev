<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoryIngredient extends Model
{
    protected $table = 'Kategory_ingredient';
    protected $fillable = ['kategory_name'];

    public function ingredient()
    {
        return $this->hasMany(Ingredient::class);
    }
}
