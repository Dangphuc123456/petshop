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
        <div class="form-container register-container">
            <h2>Sign Up Form</h2>
            <form action="#" method="POST">
                <input type="text" placeholder="Username" required>
                <input type="email" placeholder="Email" required>

                <div class="password-container">
                    <input type="password" id="password" placeholder="Password" required>
                    <span class="toggle-password">
                        <i class="fas fa-eye" id="togglePassword"></i>
                    </span>
                </div>

                <div class="password-container">
                    <input type="password" id="confirm-password" placeholder="Confirm Password" required>
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

    // Gán sự kiện click cho từng trường mật khẩu
    document.getElementById("togglePassword").addEventListener("click", function() {
        togglePasswordVisibility("password", "togglePassword");
    });

    document.getElementById("toggleConfirmPassword").addEventListener("click", function() {
        togglePasswordVisibility("confirm-password", "toggleConfirmPassword");
    });
</script>