<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'prep_time',
        'cook_time',
        'servings',
        'image_path',
        'difficulty',
        'cuisine',
        'category_id',
    ];

    /**
     * Get the user that owns the recipe.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that the recipe belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(categories::class, 'category_id');
    }

    /**
     * Get the ingredients for the recipe.
     */
    public function ingredients(): HasMany
    {
        return $this->hasMany(RecipeIngredient::class);
    }

    /**
     * Get the steps for the recipe.
     */
    public function steps(): HasMany
    {
        return $this->hasMany(RecipeStep::class)->orderBy('order');
    }

    /**
     * Get the equipment for the recipe.
     */
    public function equipment(): HasMany
    {
        return $this->hasMany(RecipeEquipment::class);
    }
    
    /**
     * Get the cooking records for this recipe.
     */
    public function cookedRecords(): HasMany
    {
        return $this->hasMany(CookedRecipe::class);
    }
}
