<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pet;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $pets = Pet::paginate($perPage)->appends(['perPage' => $perPage]);
        $category = Category::all();
        return view('admin.pets.index', compact('pets', 'perPage', 'category'));
    }
    public function create()
    {
        return view('admin.pets.create');
    }
    public function store(Request $request)
    {
        $data = [
            'pet_id' => $request->input('pet_id'),
            'species' => $request->input('species'),
            'breed' => $request->input('breed'),
            'age' => $request->input('age'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image_url' => $request->input('image_url'),
            'status' => $request->input('status') ? 1 : 0,
            'category_id' => $request->input('category_id'),
            'gender' => $request->input('gender'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Insert data into the database
        Pet::create($data);

        // Redirect to index with a success message
        return redirect()->route('admin.pets.index')->with('success', 'Thêm thành công thú cưng!');
    }


    public function edit($pet_id, Request $request)
    {
        $pet = Pet::findOrFail($pet_id);

        // Lấy giá trị từ query string
        $page = $request->query('page', 1);
        $perPage = $request->query('perPage', 10);

        // Truyền vào view
        return view('admin.pets.edit', compact('pet', 'page', 'perPage'));
    }

    public function show($pet_id)
    {
        $pet = Pet::findOrFail($pet_id);
        return view('admin.pets.detail', compact('pet'));
    }
    public function update(Request $request, string $pet_id)
    {
        $pets = Pet::find($pet_id);
        if (!$pets) {
            return abort(404);
        }

        $request->validate([
            // Validation rules
        ]);

        $pets->species = $request->species;
        $pets->breed = $request->breed;
        $pets->age = $request->age;
        $pets->price = $request->price;
        $pets->description = $request->description;
        $pets->image_url = $request->image_url;
        $pets->status = $request->status;
        $pets->category_id = $request->category_id;
        $pets->gender = $request->gender;
        $pets->updated_at = now();

        $pets->save();

        // Lấy lại giá trị page và perPage từ form
        $page = $request->input('page');
        $perPage = $request->input('perPage');

        return redirect()->route('admin.pets.index', [
            'page' => $page,
            'perPage' => $perPage
        ])->with('success', 'Thú cưng đã được cập nhật thành công.');
    }

    public function destroy($pet_id)
    {
        $pets = Pet::findOrFail($pet_id);
        $pets->delete();

        return redirect()->route('admin.pets.index')
            ->with('success', 'Xóa nhà sản phẩm thành công!');
    }
}
