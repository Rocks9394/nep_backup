<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodItems extends Model
{
    use HasFactory;
    protected $table = 'calorie_records';
    protected $fillable = [
        'user_id','food_id','food_name', 'amount','status',
    'serving_type','calculated_calories'];

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
    
}
