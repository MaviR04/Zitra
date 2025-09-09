<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'meal_name',
        'description',
        'prep_time',
        'image',
        'is_vegan',
        'is_vegetarian',
        'is_gluten_free',
    ];
    protected static function booted()
    {
        static::saving(function ($meal) {
            if ($meal->is_vegan) {
                $meal->is_vegetarian = true;
            }
        });
    }

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }
}
