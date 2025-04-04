<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('User.component.header')
    @include('User.component.slideshow')
    <div class="product-box">
        <h3>📰Tin Tức</h3>
        <div class="news">
            @foreach($news as $new)
            <div class="news-item">
                <div class="date">{{ \Carbon\Carbon::parse($new->created_at)->format('d/m/Y') }}</div>
                <img class="img_SP" src="{{ asset('anh/' . $new->image_url) }}" alt="Product image">
                <div class="date">{{ $new->create_at }}</div>
                <div class="Main-content">
                    <h2>{{ $new->title }}</h2>
                    <p>{{ $new->content }}</p>
                    <a href="{{ route('User.newdetail', ['id' => $new->id]) }}" class="read-more">Đọc chi tiết</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
</body>

</html>