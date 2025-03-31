// header
document.addEventListener("DOMContentLoaded", function () {
    const dropdowns = document.querySelectorAll(".dropdown");

    dropdowns.forEach(dropdown => {
        dropdown.addEventListener("mouseenter", function () {
            this.querySelector(".dropdown-menu").style.display = "block";
        });

        dropdown.addEventListener("mouseleave", function () {
            this.querySelector(".dropdown-menu").style.display = "none";
        });
    });
});

// slideshow

let slideIndex = 0;
const slides = document.querySelectorAll(".custom-slide");
const dots = document.querySelectorAll(".custom-dot");

function showSlides() {
    // Ẩn tất cả slides
    slides.forEach(slide => slide.classList.remove("active"));
    dots.forEach(dot => dot.classList.remove("active"));

    // Hiển thị slide hiện tại
    slides[slideIndex].classList.add("active");
    dots[slideIndex].classList.add("active");

    // Chuyển sang slide tiếp theo
    slideIndex = (slideIndex + 1) % slides.length;

    setTimeout(showSlides, 3000); // Chuyển ảnh mỗi 3 giây
}

// Điều khiển slide khi nhấn vào dot
function currentSlide(n) {
    slideIndex = n;
    showSlides();
}
// Bắt đầu slideshow
showSlides();

//cuộn trang
window.addEventListener('scroll', function () {
    var scrollToTopBtn = document.getElementById('scroll-to-top-btn');
    if (window.pageYOffset > 200) {//đủ 200px hiện nút và ngược lại là k hiện 
      scrollToTopBtn.style.display = 'block';
    } else {
      scrollToTopBtn.style.display = 'none';
    }
  });
  document.getElementById('scroll-to-top-btn').addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
  
//tăng giảm số lượng
document.addEventListener("DOMContentLoaded", function () {
  const quantityInput = document.getElementById("quantity");
  const decreaseBtn = document.querySelector(".quantity-control button:first-child");
  const increaseBtn = document.querySelector(".quantity-control button:last-child");

  function decreaseQuantity(event) {
      event.preventDefault(); // Ngăn chặn hành vi mặc định
      let value = parseInt(quantityInput.value);
      if (value > 1) {
          quantityInput.value = value - 1;
      }
  }

  function increaseQuantity(event) {
      event.preventDefault(); // Ngăn chặn hành vi mặc định
      let value = parseInt(quantityInput.value);
      if (value < quantityInput.max) {
          quantityInput.value = value + 1;
      }
  }

  decreaseBtn.addEventListener("click", decreaseQuantity);
  increaseBtn.addEventListener("click", increaseQuantity);
});

