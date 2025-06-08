<div class="modal-header bg-primary text-white">
    <h5 class="modal-title text-center w-100"> 📋Chi tiết danh mục </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body d-flex justify-content-center">
    <div style="max-width: 600px; width: 100%;">
        <div class="mb-3 d-flex align-items-center justify-content-center">
            <label class="form-label fw-bold me-2" style="min-width: 120px;">Mã danh mục</label>
            <input 
                type="text" 
                class="form-control" 
                name="category_id" 
                value="{{ $category->category_id }}" 
                style="max-width: 250px;"
            >
        </div>

        <div class="mb-3 d-flex align-items-center justify-content-center">
            <label class="form-label fw-bold me-2" style="min-width: 120px;">Tên danh mục</label>
            <input 
                type="text" 
                class="form-control" 
                name="category_name" 
                value="{{ $category->category_name }}" 
                style="max-width: 250px;"
            >
        </div>
    </div>
</div>