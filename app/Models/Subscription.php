<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'start_date',
        'meals_per_week',
        'people_per_meal',
        'price_per_week',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meals()
    {
        return $this->belongsToMany(Meal::class);
    }
}
