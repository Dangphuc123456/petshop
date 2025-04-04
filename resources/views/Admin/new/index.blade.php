@extends('Admin.admin')  

@section('title', 'List News')  

@section('main')  
<div class="table-container">  
    <h2 class="table-title">List of News Articles</h2>  
    <div class="d-flex justify-content-end mb-3">  
        <a href="{{ route('admin.new.create') }}" class="btn btn-primary">  
            <i class="fas fa-plus"></i> Add News Article  
        </a>  
    </div>  
    <table class="table">  
        <thead>  
            <tr>  
                <th>News ID</th>  
                <th>Title</th>  
                <th>Author</th>  
                <th>Created At</th>  
                <th>Actions</th>  
            </tr>  
        </thead>  
        <tbody>  
            @foreach($news as $article)  
            <tr>  
                <td>{{ $article->id }}</td>  
                <td>{{ $article->title }}</td>  
                <td>{{ $article->author }}</td>  
                <td>{{ $article->created_at->format('Y-m-d H:i') }}</td>  
                <td>  
                    <a href="{{ route('admin.new.edit', $article->id) }}" class="btn-edit">  
                        <button class="btn-delete" style="background-color:yellow">Edit</button>  
                    </a>  
                    <a href="{{ route('admin.new.detail', $article->id) }}" class="btn-edit">  
                        <button class="btn-delete" style="background-color:green">Show</button>  
                    </a>  
                    <form action="{{ route('new.destroy', $article->id) }}" method="POST" class="d-inline">  
                        @csrf  
                        @method('DELETE')  
                        <button type="submit" class="btn-delete" style="background-color:red; margin-top:10px">Delete</button>  
                    </form>  
                </td>  
            </tr>  
            @endforeach  
        </tbody>  
    </table>  

    @if($news->isEmpty())  
        <p class="text-center">No news articles found.</p>  
    @endif  
</div>  
@endsection  