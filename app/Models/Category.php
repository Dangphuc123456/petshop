<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories'; // Tên bảng trong database
    protected $primaryKey = 'category_id'; // Khóa chính

    protected $fillable = [
        'category_name',
    ];

    public $timestamps = false; // Vì bảng không có created_at và updated_at

    // Định nghĩa mối quan hệ với bảng pets
    public function pets()
    {
        return $this->hasMany(Pet::class, 'category_id', 'category_id');
    }
}
