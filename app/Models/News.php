<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';  
    protected $primaryKey = 'id';
    protected $fillable = [  
        'title',  
        'content',  
        'content2',  
        'content3',  
        'content4',  
        'content5',  
        'content6',  
        'content7',  
        'content8',  
        'image_url',  
        'image_url2',  
        'image_url3',  
        'image_url4',
        'image_url5',
        'image_url6',
        'image_url7', 
        'author',  
        'created_at',
        'updated_at',
    ];  

}
