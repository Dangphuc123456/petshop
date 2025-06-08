<div class="modal-header bg-info text-white">
    <h5 class="modal-title"> 📋Chi tiết Tin Tức</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
</div>

<div class="modal-body">
    <h3>{{ $news->title }}</h3>
    <p><strong>Tác giả:</strong> {{ $news->author }}</p>
    <p><strong>Ngày tạo:</strong> {{ $news->created_at->format('d/m/Y H:i') }}</p>

    <hr>

    {{-- Nội dung chính --}}
    <p>{!! nl2br(e($news->content)) !!}</p>

    {{-- Các nội dung bổ sung (content2 đến content8) --}}
    @for ($i = 2; $i <= 8; $i++)
        @php
            $contentField = 'content' . $i;
        @endphp
        @if (!empty($news->$contentField))
            <p>{!! nl2br(e($news->$contentField)) !!}</p>
        @endif
    @endfor

    <hr>

    {{-- Hình ảnh (image_url đến image_url6) --}}
    <div class="d-flex flex-wrap gap-2">
        @for ($i = 1; $i <= 6; $i++)
            @php
                $imgField = $i === 1 ? 'image_url' : 'image_url' . $i;
            @endphp
            @if (!empty($news->$imgField))
                <div>
                    <img src="{{ asset('anh/' . $news->$imgField) }}" alt="Ảnh {{ $i }}" style="max-width: 150px; max-height: 150px; object-fit: cover;" class="img-thumbnail">
                </div>
            @endif
        @endfor
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
</div>
