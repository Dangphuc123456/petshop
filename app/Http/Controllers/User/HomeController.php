<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Pet;
use App\Models\Service;
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
        $news = News::all();
        return view('User.home', compact('news', 'cart', 'dog', 'cats', 'accessories', 'dogCategories', 'catCategories', 'accessoryCategories'));
    }
    public function category($category_id, $category_name)
    {
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();

        $dog = collect();
        $cats = collect();
        $accessories = collect();
        $relatedCategories = collect();

        if ($category_id) {
            $selectedCategory = Category::find($category_id);
            if ($selectedCategory) {
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
        return view('User.category', compact('cart', 'dogCategories', 'catCategories', 'accessoryCategories', 'dog', 'cats', 'accessories', 'relatedCategories', 'category_name'));
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
    public function productdetails($pet_id, $description = null, $category_id = null)
    {
        // lấy thông tin sản phẩm và sản phẩm tương tự
        $products = Pet::find($pet_id);
        $description = $description ?? $products->description;
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
        return view('User.productdetails', compact('description', 'cart', 'dogCategories', 'catCategories', 'accessoryCategories', 'dog', 'cats', 'accessories', 'relatedCategories', 'similarProducts', 'products', 'category'));
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
        $news = News::all();
        return view('User.news', compact('news', 'cart', 'dogCategories', 'catCategories', 'accessoryCategories'));
    }

    public function search(Request $request)
    {
        $query = trim($request->input('query'));
        $categoryFilter = $request->input('category');

        $petsQuery = Pet::query();

        if ($query !== '') {
            $petsQuery->where(function ($q) use ($query) {
                // 1) Always search the text fields
                $q->where('description', 'LIKE', "%{$query}%")
                    ->orWhere('species', 'LIKE', "%{$query}%")
                    ->orWhere('breed', 'LIKE', "%{$query}%");

                // 2) Only if the query is numeric, search by price
                //    We remove commas and dots so "1,500.00" → "150000" → numeric.
                $numeric = str_replace([',', '.'], '', $query);
                if (is_numeric($numeric)) {
                    $price = (float) $numeric;
                    $q->orWhereBetween('price', [max($price - 100000, 0), $price + 100000]);
                }
            });
        }

        if ($categoryFilter) {
            $petsQuery->whereHas('category', function ($q) use ($categoryFilter) {
                $q->where('category_name', 'LIKE', "%{$categoryFilter}%");
            });
        }

        $pets = $petsQuery->get();
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();
        $cart = session()->get('cart', []);

        return view('User.search', compact(
            'cart',
            'pets',
            'query',
            'dogCategories',
            'catCategories',
            'accessoryCategories'
        ));
    }


    public function serviceandhotel()
    {
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();
        $cart = session()->get('cart', []);
        $services = Service::all();
        return view('User.serviceandhotel', compact('cart', 'dogCategories', 'catCategories', 'accessoryCategories', 'services'));
    }
    public function newdetail($id)
    {
        $dogCategories = Category::where('category_name', 'LIKE', 'Chó%')->get();
        $catCategories = Category::where('category_name', 'LIKE', 'Mèo%')->get();
        $accessoryCategories = Category::where('category_name', 'NOT LIKE', 'Chó%')
            ->where('category_name', 'NOT LIKE', 'Mèo%')
            ->get();
        $cart = session()->get('cart', []);

        // Tìm tin tức theo ID  
        $newsDetail = News::find($id);

        // Kiểm tra nếu không tìm thấy tin tức
        if (!$newsDetail) {
            return redirect()->route('User.index')->with('error', 'Bản tin không tồn tại.');
        }

        // Lấy các tin tức khác (ngoại trừ tin đang xem), giới hạn 5 tin mới nhất
        $relatedNews = News::where('id', '!=', $id)
            ->orderBy('created_at', 'desc') // Sắp xếp theo thời gian mới nhất
            ->limit(5)
            ->get();

        // Trả về view với thông tin tin tức chi tiết và danh sách tin tức liên quan  
        return view('User.newdetail', compact('newsDetail', 'cart', 'dogCategories', 'catCategories', 'accessoryCategories', 'relatedNews'));
    }
}
