<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pet;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   public function getCategories()
   {
       $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
       $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
       $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
                                      ->where('category_name', 'NOT LIKE', 'Mèo%')
                                      ->get();
       return view('User.home', compact('dogCategories', 'catCategories', 'accessoryCategories'));
   }
  
}
