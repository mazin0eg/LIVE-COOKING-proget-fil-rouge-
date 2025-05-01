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
        return $this->hasMany(Recipe::class, 'category_id');
    }

   
}
