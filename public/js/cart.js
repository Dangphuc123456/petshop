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



