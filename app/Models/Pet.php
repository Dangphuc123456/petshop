<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pet extends Model
{
    use HasFactory;
    protected $table = 'pets'; // Bảng trong database
    protected $primaryKey = 'pet_id'; // Khóa chính

    protected $fillable = [
       'species', 'breed', 'age', 'price', 'description', 
        'image_url', 'status', 'category_id', 'gender', 
        'quantity_in_stock', 'quantity_sold','slug'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($pet) {
            
            $pet->slug = Str::slug($pet->description); 
        });
    }
}
