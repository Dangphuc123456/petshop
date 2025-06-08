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
    <style>
        /* Thêm lớp giữ tỷ lệ phù hợp cho iframe */
        .map-container {
            position: relative;
            width: 100%;
            padding-bottom: 75%;
            /* Tỷ lệ 4:3 để giữ aspect ratio */
            height: 0;
        }

        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
</head>

<body>
    @include('User.component.header')
    <section class="container my-4" style="position: relative; font-family: 'Open Sans', sans-serif;">
  <!-- Ảnh nền chính -->
  <div style="position: relative; overflow: hidden;">
    <img src="{{ asset('anh/avatar.jpg') }}" alt="Pet House Sài Gòn" style="width:100%; height:600px; object-fit:cover;" />
    <!-- Thông tin địa chỉ nổi bật -->
    <div style="
      position: absolute; top: 20px; left: 20px;
      padding: 30px; border-radius: 12px; width: calc(100% - 40px);
      max-width: 600px;color:aliceblue">
      
      <h4 style="margin-bottom: 15px; color: aliceblue;">Liên hệ Pet House</h4>
      <p style="margin: 5px 0;"><i class="fas fa-map-marker-alt"></i> Cửa Hàng Miền Nam: 1045 Kha Vạn Cân, Linh Trung, Thủ Đức, Tp.HCM</p>
      <p style="margin: 5px 0;"><i class="fas fa-map-marker-alt"></i> Cửa Hàng Miền Bắc: Số 428 Minh Khai, Hai Bà Trưng, Hà Nội</p>
      <!-- Nút gọi -->
      <div style="margin-top: 15px; text-align: center;">
        <a href="tel:0379889868" style="
          display: inline-block;
          background-color: #dc3545; color: #fff;
          padding: 12px 30px;
          border-radius: 50px;
          font-weight: bold;
          font-size: 1.2em;
          text-decoration: none;
          box-shadow: 0 4px 8px rgba(0,0,0,0.2);
          transition: background-color 0.3s, transform 0.2s;">
          🌟 Gọi ngay: 0379.889.868
        </a>
      </div>
    </div>
  </div>
</section>
    <div class="container my-2">
        <h2 class="mb-4 text-center">Bản đồ Cửa Hàng Thú Cưng Hà Nội & TP.HCM</h2>
        <div class="row g-4">
            <!-- Bản đồ Hà Nội -->
            <div class="col-md-6">
                <h5 class="text-center mb-3">Cửa Hàng Thú Cưng Hà Nội</h5>
                <div class="map-container">
                   <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13638.535292859075!2d105.864067!3d20.996983000000004!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac0f86e2e5e5%3A0x950f4342e726ea0b!2zMjkzIFAuIE1pbmggS2hhaSwgVsSpbmggVHV5LCBIYWkgQsOgIFRyxrBuZywgSMOgIE7hu5lpLCBWaWV0bmFt!5e1!3m2!1sfr!2sus!4v1747677672275!5m2!1sfr!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <!-- Bản đồ TP.HCM -->
            <div class="col-md-6">
                <h5 class="text-center mb-3">Cửa Hàng Thú Cưng Tp.HCM</h5>
                <div class="map-container">
                   <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14346.952488594965!2d106.75981!3d10.859354!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175279a88f812e1%3A0x9117460b44c6033!2zMTA0NSDEkC4gS2hhIFbhuqFuIEPDom4sIFBoxrDhu51uZyBMaW5oIFRydW5nLCBUaOG7pyDEkOG7qWMsIEjhu5MgQ2jDrSBNaW5oLCBWaWV0bmFt!5e1!3m2!1sfr!2sus!4v1747677696623!5m2!1sfr!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>

    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
</body>

</html>