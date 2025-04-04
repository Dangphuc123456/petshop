<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()  
    {  
        $news = News::all();  
        return view('admin.new.index', compact('news'));  
    }  

    public function create()  
    {    
        return view('admin.new.create');  
    }  

    public function store(Request $request)  
    {  
        // Validate and store the news article  
        $data = [
            'id' => $request->input('id'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'content2' => $request->input('content2'),
            'content3' => $request->input('content3'),
            'content4' => $request->input('content4'),
            'content5' => $request->input('content5'),
            'content6' => $request->input('content6'),
            'content7' => $request->input('content7'),
            'content8' => $request->input('content8'),
            'image_url' => $request->input('image_url'),
            'image_url2' => $request->input('image_url2'),
            'image_url3' => $request->input('image_url3') ,
            'image_url4' => $request->input('image_url4'),
            'image_url5' => $request->input('image_url5'),
            'image_url6 '=> $request->input('image_url6'),
            'author' => $request->input('author'),
            'created_at' => now(),
            'updated_at' => now(),
        ]; 

        News::create($data); 

        return redirect()->route('admin.new.index')->with('success', 'News created successfully.');  
    }  

    public function show(string $id)  
    {  
        $news = News::where('id', $id)->first();

        if (!$news) {
            // Handle the case where no pet is found with the given pet_id
            return abort(404); // Return a 404 error page
        }

        // Extract individual attributes
        $id = $news->id;
        $title = $news->title;
        $content = $news->content;
        $content2 = $news->content2;
        $content3 = $news->content3;
        $content4 = $news->content4;
        $content5 = $news->content5;
        $content6 = $news->content6;
        $content7 = $news->content7;
        $content8 = $news->content8;
        $image_url = $news->image_url;
        $image_url2 = $news->image_url2;
        $image_url3 = $news->image_url3;
        $image_url4 = $news->image_url4;
        $image_url5 = $news->image_url5;
        $image_url6 = $news->image_url6;
        $created_at = $news->created_at;
        $updated_at = $news->updated_at;
        $author = $news->author; 
        return view('admin.new.show', compact('news','title','content','content2','content3','content4','content5','content6','content7','image_url','image_url2','image_url3','image_url4','image_url5', 'image_url6', 'author','created_at','updated_at'));  
    }  

    public function edit($id)  
    {  
        $news = News::where('id', $id)->first();

        if (!$news) {
            return abort(404); // Trả về trang lỗi 404 nếu không tìm thấy sản phẩm
        }
        return view('admin.new.edit', compact('news'));  
    }  

    public function update(Request $request, $id)  
    {  
        $news = News::find($id);
        if (!$news) {
            // Xử lý khi không tìm thấy thú cưng
            return abort(404); // Trả về trang lỗi 404
        }
    
        $request->validate([
            // Định nghĩa các quy tắc kiểm tra dữ liệu nếu cần
            // Ví dụ: 'name' => 'required|max:255',
        ]);
    
        // Cập nhật các thuộc tính của thú cưng từ dữ liệu gửi từ form
        $news->title = $request->title;
        $news->content = $request->content;
        $news->content2 = $request->content2;
        $news->content3 = $request->content3;
        $news->content4 = $request->content4;
        $news->content5 = $request->content5;
        $news->content6 = $request->content6;
        $news->content7 = $request->content7;
        $news->content8 = $request->content8;
        $news->image_url = $request->image_url;
        $news->image_url2 = $request->image_url2;
        $news->image_url3 = $request->image_url3;
        $news->image_url4 = $request->image_url4;
        $news->image_url5 = $request->image_url5;
        $news->image_url6 = $request->image_url6;
        $news->author = $request->author;
        $news->updated_at = date("Y-m-d H:i:s"); // Cập nhật thời gian sửa đổi
    
        // Lưu các thay đổi vào cơ sở dữ liệu
        $news->save(); 
        return redirect()->route('admin.new.index',['id' => $id])->with('success', 'News updated successfully.');  
    }  

    public function destroy($id)  
    {  
        // Delete the news article  
        $news = News::findOrFail($id);  
        $news->delete();  
        return redirect()->route('admin.new.index')->with('success', 'News deleted successfully.');  
    }  
}  

