<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Dùng Authenticatable thay vì Model
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'customers'; // Đảm bảo đúng tên bảng

    protected $primaryKey = 'customer_id'; // Nếu khóa chính không phải là 'id'

    protected $fillable = [
        'username',
        'password',
        'name',
        'email',
        'phone',
        'address',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
