<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $fillable = [
        'name',
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'category_recipe', 'category_id', 'recipe_id');
    }

   
}
