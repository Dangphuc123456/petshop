<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pet;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $dog = Pet::where('species', 'Chó')->inRandomOrder()->limit(10)->get();
        $cats = Pet::where('species', 'Mèo')->inRandomOrder()->limit(10)->get();
        $accessories = Pet::where('species', 'Phụ kiện')->inRandomOrder()->limit(10)->get();
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();
        $cart = session()->get('cart', []);
        return view('User.home', compact('cart', 'dog', 'cats', 'accessories', 'dogCategories', 'catCategories', 'accessoryCategories'));
    }
    public function category($category_id = null)
    {
        // Lấy tất cả danh mục chó, mèo, phụ kiện
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();

        // Khởi tạo danh sách sản phẩm
        $dog = collect();
        $cats = collect();
        $accessories = collect();
        $relatedCategories = collect();

        if ($category_id) {
            $selectedCategory = Category::find($category_id);
            if ($selectedCategory) {
                // Lấy danh sách danh mục cùng loại (cùng nhóm "Chó", "Mèo" hoặc "Phụ kiện")
                if (str_starts_with($selectedCategory->category_name, 'Chó')) {
                    $dog = Pet::where('category_id', $category_id)->get();
                    $relatedCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
                } elseif (str_starts_with($selectedCategory->category_name, 'Mèo')) {
                    $cats = Pet::where('category_id', $category_id)->get();
                    $relatedCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
                } else {
                    $accessories = Pet::where('category_id', $category_id)->get();
                    $relatedCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
                        ->where('category_name', 'NOT LIKE', 'Mèo%')
                        ->get();
                }
            }
        }
        $cart = session()->get('cart', []);
        return view('User.category', compact('cart', 'dogCategories', 'catCategories', 'accessoryCategories', 'dog', 'cats', 'accessories', 'relatedCategories'));
    }

    public function getProductsByCategory($type, $category_id = null)
    {
        // Lấy danh mục theo nhóm
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();

        // Xác định danh mục chính và danh mục liên quan
        $categories = collect();
        $title = '';
        $relatedCategories = collect();

        if ($type === 'dogs') {
            $categories = $dogCategories->pluck('category_id')->toArray();
            $title = '🐶 Tất cả chó cảnh';
            $relatedCategories = $dogCategories;
        } elseif ($type === 'cats') {
            $categories = $catCategories->pluck('category_id')->toArray();
            $title = '🐱 Tất cả mèo cảnh';
            $relatedCategories = $catCategories;
        } elseif ($type === 'accessories') {
            $categories = $accessoryCategories->pluck('category_id')->toArray();
            $title = '🛍️Tất cả phụ kiện';
            $relatedCategories = $accessoryCategories;
        } else {
            abort(404); // Nếu type không hợp lệ, trả về lỗi 404
        }

        // Nếu có category_id, lọc sản phẩm theo danh mục con
        if ($category_id) {
            $products = Pet::where('category_id', $category_id)->get();
        } else {
            $products = Pet::whereIn('category_id', $categories)->get();
        }
        $cart = session()->get('cart', []);
        // Trả về view với dữ liệu
        return view('User.product', compact('cart', 'products', 'title', 'dogCategories', 'catCategories', 'accessoryCategories', 'relatedCategories', 'type'));
    }
    public function productdetails($pet_id, $category_id = null)
    {
        // lấy thông tin sản phẩm và sản phẩm tương tự
        $products = Pet::find($pet_id);
        $similarProducts = Pet::where('category_id', $products->category_id)
            ->where('pet_id', '!=', $pet_id)
            ->limit(8)
            ->get();
        $category = Category::all();
        // Lấy tất cả danh mục chó, mèo, phụ kiện
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();

        // Khởi tạo danh sách sản phẩm
        $dog = collect();
        $cats = collect();
        $accessories = collect();
        $relatedCategories = collect();

        if ($category_id) {
            $selectedCategory = Category::find($category_id);
            if ($selectedCategory) {
                // Lấy danh sách danh mục cùng loại (cùng nhóm "Chó", "Mèo" hoặc "Phụ kiện")
                if (str_starts_with($selectedCategory->category_name, 'Chó')) {
                    $dog = Pet::where('category_id', $category_id)->get();
                    $relatedCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
                } elseif (str_starts_with($selectedCategory->category_name, 'Mèo')) {
                    $cats = Pet::where('category_id', $category_id)->get();
                    $relatedCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
                } else {
                    $accessories = Pet::where('category_id', $category_id)->get();
                    $relatedCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
                        ->where('category_name', 'NOT LIKE', 'Mèo%')
                        ->get();
                }
            }
        }
        $cart = session()->get('cart', []);
        return view('User.productdetails', compact('cart', 'dogCategories', 'catCategories', 'accessoryCategories', 'dog', 'cats', 'accessories', 'relatedCategories', 'similarProducts', 'products', 'category'));
    }

    public function about()
    {
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();
        $cart = session()->get('cart', []);
        return view('User.about', compact('cart', 'dogCategories', 'catCategories', 'accessoryCategories'));
    }
    public function contact()
    {
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();
        $cart = session()->get('cart', []);
        return view('User.contact', compact('cart', 'dogCategories', 'catCategories', 'accessoryCategories'));
    }
    public function news()
    {
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();
        $cart = session()->get('cart', []);
        return view('User.news', compact('cart', 'dogCategories', 'catCategories', 'accessoryCategories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Tìm kiếm theo tên, mô tả, giống loài
        $pets = Pet::where('name', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->orWhere('breed', 'LIKE', "%$query%")
            ->get();
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();
        $cart = session()->get('cart', []);
        return view('User.search', compact('cart', 'pets', 'query', 'dogCategories', 'catCategories', 'accessoryCategories'));
    }

    public function serviceandhotel()
    {
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();
        $cart = session()->get('cart', []);
        return view('User.serviceandhotel', compact('cart', 'dogCategories', 'catCategories', 'accessoryCategories'));
    }
}
