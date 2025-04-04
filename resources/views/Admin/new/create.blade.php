@extends('Admin.admin')  
@section('title', 'Add New News')  
@section('main')  
<div class="container my-5">  
    <div class="card shadow-sm">  
        <div class="card-header bg-success text-white">  
            <h2 class="text-center mb-0">Add New News</h2>  
        </div>  
        <div class="card-body">  
            <form action="{{ route('admin.new.store') }}" method="POST" >  
                @csrf  

                <div class="mb-3">  
                    <label for="title" class="form-label">Title</label>  
                    <input type="text" class="form-control" name="title" id="title" required>  
                </div>  

                <div class="mb-3">  
                    <label for="content" class="form-label">Content</label>  
                    <textarea class="form-control" name="content" id="content" rows="4" required></textarea>  
                </div>  

                <div class="mb-3">  
                    <label for="content2" class="form-label">Additional Content</label>  
                    <textarea class="form-control" name="content2" id="content2" rows="4"></textarea>  
                </div>  

                <div class="mb-3">  
                    <label for="content3" class="form-label">Additional Content 3</label>  
                    <textarea class="form-control" name="content3" id="content3" rows="4"></textarea>  
                </div>  

                <div class="mb-3">  
                    <label for="content4" class="form-label">Additional Content 4</label>  
                    <textarea class="form-control" name="content4" id="content4" rows="4"></textarea>  
                </div>  
                <div class="mb-3">  
                    <label for="content5" class="form-label">Additional Content 5</label>  
                    <textarea class="form-control" name="content5" id="content5" rows="4"></textarea>  
                </div>  

                <div class="mb-3">  
                    <label for="content6" class="form-label">Additional Content 6</label>  
                    <textarea class="form-control" name="content6" id="content6" rows="4"></textarea>  
                </div>
                <div class="mb-3">  
                    <label for="conten7" class="form-label">Additional Content 7</label>  
                    <textarea class="form-control" name="content7" id="content7" rows="4"></textarea>  
                </div>
                <div class="mb-3">  
                    <label for="conten8" class="form-label">Additional Content 8</label>  
                    <textarea class="form-control" name="content8" id="content8" rows="4"></textarea>  
                </div>
                <div class="mb-3">  
                    <label for="image_url" class="form-label">Image URL</label>  
                    <input type="file" class="form-control" name="image_url" id="image_url">  
                </div>  

                <div class="mb-3">  
                    <label for="image_url2" class="form-label">Image URL 2</label>  
                    <input type="file" class="form-control" name="image_url2" id="image_url2">  
                </div>  

                <div class="mb-3">  
                    <label for="image_url3" class="form-label">Image URL 3</label>  
                    <input type="file" class="form-control" name="image_url3" id="image_url3">  
                </div>  

                <div class="mb-3">  
                    <label for="image_url4" class="form-label">Image URL 4</label>  
                    <input type="file" class="form-control" name="image_url4" id="image_url4">  
                </div>  

                <div class="mb-3">  
                    <label for="image_url5" class="form-label">Image URL 5</label>  
                    <input type="file" class="form-control" name="image_url5" id="image_url5">  
                </div>  

                <div class="mb-3">  
                    <label for="image_url6  " class="form-label">Image URL 6</label>  
                    <input type="file" class="form-control" name="image_url6  " id="image_url6  ">  
                </div>  

                <div class="mb-3">  
                    <label for=" image_url7 " class="form-label">Image URL 7</label>  
                    <input type="file" class="form-control" name=" image_url7 " id=" image_url7 ">  
                </div>  


                <div class="mb-3">  
                    <label for="author" class="form-label">Author</label>  
                    <input type="text" class="form-control" name="author" id="author" required>  
                </div>  

                <div class="text-center">  
                    <button type="submit" class="btn btn-primary btn-lg">Add News</button>  
                </div>  
            </form>  
        </div>  
    </div>  
</div>  
@endsection  