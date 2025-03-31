<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;
    protected $table = 'pets'; // Bảng trong database
    protected $primaryKey = 'pet_id'; // Khóa chính

    protected $fillable = [
        'name', 'species', 'breed', 'age', 'price', 'description', 
        'image_url', 'status', 'category_id', 'gender', 
        'quantity_in_stock', 'quantity_sold'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
