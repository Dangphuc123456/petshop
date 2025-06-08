<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="icon" href="{{ asset('anh/petshop.png') }}">
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('User.component.header')
    <div class="container">
        <h2>Hồ sơ khách hàng</h2>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('User.profile.update') }}" method="POST" >
            @csrf
            <div class="mb-3">
                <label class="form-label">Tên đăng nhập:</label>
                <input type="text" class="form-control" value="{{ $customer->username }}" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Họ và Tên:</label>
                <input type="text" name="name" class="form-control" value="{{ $customer->name }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" value="{{ $customer->email }}">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Số điện thoại:</label>
                <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Địa chỉ:</label>
                <textarea name="address" class="form-control">{{ $customer->address }}</textarea>
            </div>
            <!-- Phần đổi mật khẩu (mặc định ẩn đi) -->
            <div id="passwordFields" style="display: none;">
                <div class="mb-3">
                    <label class="form-label">Mật khẩu mới:</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Xác nhận mật khẩu:</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>

            <div class="d-flex gap-2 mb-3">
                <button type="button" class="btn btn-warning" onclick="togglePasswordFields()">Đổi mật khẩu</button>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>

    <script>
        function togglePasswordFields() {
            var passwordFields = document.getElementById("passwordFields");
            if (passwordFields.style.display === "none") {
                passwordFields.style.display = "block";
            } else {
                passwordFields.style.display = "none";
            }
        }
    </script>

    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
</body>

</html>
<script>
    document.getElementById('editButton').onclick = function() {
        // Bỏ `readonly` để cho phép chỉnh sửa  
        let inputs = document.querySelectorAll('#profileForm input');
        inputs.forEach(function(input) {
            input.removeAttribute('readonly'); // Bỏ readonly  
        });

        // Hiển thị nút Lưu  
        document.getElementById('saveButton').classList.remove('d-none');
    }
</script>