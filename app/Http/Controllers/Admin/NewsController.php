<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        // Lấy dữ liệu phân trang, mới nhất trước
        $news = News::orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->appends(['perPage' => $perPage]);

        return view('admin.new.index', compact('news', 'perPage'));
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
            'image_url3' => $request->input('image_url3'),
            'image_url4' => $request->input('image_url4'),
            'image_url5' => $request->input('image_url5'),
            'image_url6 ' => $request->input('image_url6'),
            'author' => $request->input('author'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        News::create($data);

        return redirect()->route('admin.new.index')->with('success', 'News created successfully.');
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('admin.new.detail', compact('news'));
    }
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.new.edit', compact('news'));
    }
    public function update(Request $request, $id)
    {
        $news = News::find($id);
        if (!$news) {

            return abort(404);
        }

        $request->validate([]);
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
        $news->updated_at = date("Y-m-d H:i:s");
        $news->save();
        return redirect()->route('admin.new.index', ['id' => $id])->with('success', 'News updated successfully.');
    }

    public function destroy($id)
    {
        // Delete the news article  
        $news = News::findOrFail($id);
        $news->delete();
        return redirect()->route('admin.new.index')->with('success', 'News deleted successfully.');
    }
}
