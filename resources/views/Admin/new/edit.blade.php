<div class="modal-header bg-warning text-white">
    <h5 class="modal-title">Chỉnh sửa Tin Tức #{{ $news->id }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{ route('admin.new.update', $news->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $news->title }}" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" name="content" id="content" rows="4" required>{{ $news->content }}</textarea>
        </div>

        <div class="mb-3">
            <label for="content2" class="form-label">Additional Content 1</label>
            <textarea class="form-control" name="content2" id="content2" rows="4">{{ $news->content2 }}</textarea>
        </div>

        <div class="mb-3">
            <label for="content3" class="form-label">Additional Content 2</label>
            <textarea class="form-control" name="content3" id="content3" rows="4">{{ $news->content3 }}</textarea>
        </div>

        <div class="mb-3">
            <label for="content4" class="form-label">Additional Content 3</label>
            <textarea class="form-control" name="content4" id="content4" rows="4">{{ $news->content4 }}</textarea>
        </div>

        <div class="mb-3">
            <label for="content5" class="form-label">Additional Content 4</label>
            <textarea class="form-control" name="content5" id="content5" rows="4" required>{{ $news->content5 }}</textarea>
        </div>

        <div class="mb-3">
            <label for="content6" class="form-label">Additional Content 5</label>
            <textarea class="form-control" name="content6" id="content6" rows="4" required>{{ $news->content6 }}</textarea>
        </div>

        <div class="mb-3">
            <label for="content7" class="form-label">Additional Content 6</label>
            <textarea class="form-control" name="content7" id="content7" rows="4" required>{{ $news->content7 }}</textarea>
        </div>
        <div class="mb-3">
            <label for="content8" class="form-label">Additional Content 7</label>
            <textarea class="form-control" name="content8" id="content8" rows="4" required>{{ $news->content8 }}</textarea>
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">Image URL</label>
            <input type="file" class="form-control" name="image_url" id="image_url" value="{{ $news->image_url }}">
        </div>

        <div class="mb-3">
            <label for="image_url2" class="form-label">Image URL 2</label>
            <input type="file" class="form-control" name="image_url2" id="image_url2" value="{{ $news->image_url2 }}">
        </div>

        <div class="mb-3">
            <label for="image_url3" class="form-label">Image URL 3</label>
            <input type="file" class="form-control" name="image_url3" id="image_url3" value="{{ $news->image_url3 }}">
        </div>

        <div class="mb-3">
            <label for="image_url4" class="form-label">Image URL 4</label>
            <input type="file" class="form-control" name="image_url4" id="image_url4" value="{{ $news->image_url4 }}">
        </div>

        <div class="mb-3">
            <label for="image_url5" class="form-label">Image URL 5</label>
            <input type="file" class="form-control" name="image_url5" id="image_url5" value="{{ $news->image_url5 }}">
        </div>

        <div class="mb-3">
            <label for="image_url6" class="form-label">Image URL 6</label>
            <input type="file" class="form-control" name="image_url6" id="image_url6" value="{{ $news->image_url6 }}">
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" name="author" id="author" value="{{ $news->author }}">
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fas fa-save me-1"></i> Cập nhật
            </button>
        </div>
    </form>
</div>