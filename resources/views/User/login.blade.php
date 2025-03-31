<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/loginvsregister.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body>
    <div class="container">
        <div class="form-container login-container">
            <h2>Login Form</h2>
            <form action="{{ route('User.login.submit') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Email" required>

                <div class="password-container">
                    <input type="password" id="password" name="password"placeholder="Password" required>
                    <span class="toggle-password">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </span>
                </div>
                <div class="options">
                    <label>
                        <input type="checkbox" name="remember">
                    </label>
                </div>
                <button type="submit">Login</button>
                <p>Chưa có tài khoản? <a href="{{ route('User.register') }}">Đăng ký</a></p>
            </form>
        </div>
    </div>

</body>

</html>
<script>
    document.getElementById("toggleIcon").addEventListener("click", function() {
        let passwordField = document.getElementById("password");
        let icon = this;

        if (passwordField.type === "password") {
            passwordField.type = "text"; // Hiển thị mật khẩu
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash"); // Đổi icon
        } else {
            passwordField.type = "password"; // Ẩn mật khẩu
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye"); // Đổi icon lại
        }
    });
</script>