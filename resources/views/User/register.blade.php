<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="icon" href="{{ asset('anh/petshop.png') }}">
    <link rel="stylesheet" href="{{ asset('css/loginvsregister.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="form-container register-container">
            <h2>Sign Up Form</h2>
            <form action="{{ route('User.register.submit') }}" method="POST">
                @csrf
                <input type="text" name="username" placeholder="Username" required maxlength="50" value="{{ old('username') }}">
                <input type="email" name="email" placeholder="Email" required maxlength="100" value="{{ old('email') }}">
                <input type="text" name="name" placeholder="Full Name" required maxlength="100" value="{{ old('name') }}">
                <input type="text" name="phone" placeholder="Phone (10-15 digits)" required pattern="\d{10,15}" value="{{ old('phone') }}">
                <input type="text" name="address" placeholder="Address" required maxlength="255" value="{{ old('address') }}">

                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Password" required minlength="6">
                    <span class="toggle-password">
                        <i class="fas fa-eye" id="togglePassword"></i>
                    </span>
                </div>

                <div class="password-container">
                    <input type="password" id="confirm-password" name="password_confirmation" placeholder="Confirm Password" required minlength="6">
                    <span class="toggle-password">
                        <i class="fas fa-eye" id="toggleConfirmPassword"></i>
                    </span>
                </div>

                <button type="submit">Sign Up</button>
                <p>Đã có tài khoản? <a href="{{ route('User.login') }}">Đăng nhập</a></p>
            </form>

        </div>
    </div>

</body>

</html>
<script>
    function togglePasswordVisibility(passwordFieldId, iconId) {
        let passwordField = document.getElementById(passwordFieldId);
        let icon = document.getElementById(iconId);

        if (passwordField.type === "password") {
            passwordField.type = "text"; // Hiển thị mật khẩu
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash"); // Đổi icon
        } else {
            passwordField.type = "password"; // Ẩn mật khẩu
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye"); // Đổi icon lại
        }
    }

    document.getElementById("togglePassword").addEventListener("click", function() {
        togglePasswordVisibility("password", "togglePassword");
    });

    document.getElementById("toggleConfirmPassword").addEventListener("click", function() {
        togglePasswordVisibility("confirm-password", "toggleConfirmPassword");
    });
</script>