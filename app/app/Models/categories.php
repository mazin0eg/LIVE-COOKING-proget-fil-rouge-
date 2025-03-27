<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $fillable = [
        'name',
        'recipes_id',
    ];

    public function recipes()
    {
        return $this->belongsTo(recipes::class);
    }

   
}
