<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="icon" href="{{ asset('anh/petshop.png') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('User.component.header')
    <div style="text-align: justify; line-height: 1.8; font-size: 16px; padding: 0 30px ;">
        <h2 style="text-align: center;margin-top:20px">CHÍNH SÁCH BẢO HÀNH tại PetShop</h2>

        <ul>
            <li><strong>Tất cả các bé thú cưng của PetShop</strong> đều được bảo hành sức khỏe 7 ngày tính từ ngày bé về nhà mới. (Nhằm nâng cao chất lượng dịch vụ, PetShop mở bán gói dịch vụ bảo <br>hành sức khỏe 365 ngày đối với khách hàng có nhu cầu).</li>

            <li><strong>Hỗ trợ và đồng hành tư vấn</strong> cùng khách hàng trong suốt quá trình nuôi thú cưng. Có bất kỳ vấn đề gì không rõ, khách hàng có thể gọi hoặc chat zalo với PetShop để được <br>giải đáp nhanh nhất.</li>

            <li><strong>Hỗ trợ tư vấn dinh dưỡng và sức khỏe</strong> của bé trọn đời. Cụ thể là cách xử lý, điều trị các loại bệnh thông thường, hay làm sao để chăm cho bé mập, khỏe, lông đẹp…</li>

            <li><strong>Trong vòng 7 ngày đầu về nhà mới</strong>, nếu không may thú cưng của bạn bị bệnh, chúng tôi sẽ chịu hoàn toàn chi phí điều trị. Trường hợp xấu nhất là bé tử vong, chúng tôi sẽ đền <br>bù khách hàng một bé thú cưng khác có giá trị tương tự.</li>

            <li><strong>Liên kết với các bệnh viện thú y lớn</strong> ở Sài Gòn và Hà Nội để hỗ trợ khách hàng và các bé thú cưng một cách nhanh và hiệu quả nhất, với chi phí tối ưu nhất.</li>

            <li><strong>Hoàn trả:</strong> Chúng tôi cam kết không bán chó tật lỗi, lai tạp. Nếu sau khi bé về nhà mới mà khách hàng phát hiện có những vấn đề nêu trên, chúng tôi sẽ hoàn trả toàn bộ chi phí <br>vận chuyển và bồi thường gấp đôi số tiền khách đã mua.</li>

            <li><strong>Lưu ý:</strong> Thú cưng còn nhỏ thường mắc các bệnh về đường ruột như bệnh Parvo và Care. Nguyên nhân chủ yếu là khách hàng cho chó ăn đồ ăn lạ, đồ ăn không phải của chó, hoặc cho chó cắn<br> gặm xương, cành cây… dẫn đến viêm ruột. Hoặc tiếp xúc với môi trường công cộng nhiều mầm bệnh, hoặc liếm chân tay sau khi về từ môi trường bên ngoài…</li>

            <li>Vì vậy, quý khách hàng cần lưu ý vấn đề này. Trong thời gian bảo hành, nếu xảy ra bệnh đường ruột do lỗi sơ ý của người mua, chúng tôi không chịu trách nhiệm bảo hành.</li>
        </ul>

        <p><strong>PetShop – Cửa hàng mua bán thú cảnh Uy tín tại Việt Nam</strong></p>
        <ul>
            <li>Địa chỉ: 1045 Kha Vạn Cân, Thủ Đức, Tp.HCM (đối diện 1294c Kha Vạn Cân, Linh Trung, Thủ Đức, Hồ Chí Minh)</li>
            <li>Hà Nội: 428 Minh Khai – Hai Bà Trưng – Hà Nội</li>
            <li>Hotline: 0379.88.868</li>
            <li>Email: pethouse.com.vn@gmail.com</li>
        </ul>
    </div>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
</body>

</html>