function confirmDelete() {
    console.log("Hộp thoại xác nhận được gọi!");
    return confirm("Bạn có chắc muốn xóa sản phẩm này không?");
}

// Kiểm tra xem thông báo có tồn tại không  
window.onload = function () {
    var successMessage = document.getElementById('success-message');
    if (successMessage) {
        // Đặt thời gian 2 giây (2000 milliseconds)  
        setTimeout(function () {
            // Ẩn thông báo  
            successMessage.style.display = 'none';
        }, 700);
    }
}; 

window.addEventListener('DOMContentLoaded', (event) => {
    // Nếu có thông báo
    let alert = document.getElementById('success-alert');

    // Kiểm tra xem phần tử có tồn tại không
    if (alert) {
        // Sau 5 giây, ẩn thông báo bằng cách thay đổi độ mờ (opacity)
        setTimeout(() => {
            alert.style.opacity = 0;
            // Sau khi opacity chuyển về 0, ẩn hẳn phần tử
            setTimeout(() => {
                alert.style.display = 'none';
            }, 1000); // Thời gian để opacity mờ dần (1 giây)
        }, 2000); // Hiển thị trong 5 giây
    }
});

