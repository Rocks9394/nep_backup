<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    public function FoodItems()
{
    return $this->belongsTo(FoodItems::class, 'food_id');
}
}
