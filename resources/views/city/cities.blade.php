@extends('layouts.master') 

@section('content')

    <div class="row" style="margin-top: -25px;">
        <!-- Sol Menü (Alt Başlıklar) -->
        <div class="col-md-3 mb-3">
            <div class="mobile-hidden d-block">

                    <div class="d-flex justify-content-between">
                        <h4 class="sidebarTitle">şehirler</h4>  
                    </div>

                    <ul id="subcategories-list" class="list-group" >
                    
                    </ul>
        
                    <div id="pagination-container" class="pagination-container mt-3"></div>
       
            </div>

            <div class="mobile-show d-none">
                <a class="btn btn-primary w-100" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                    <i class="bi bi-chat-dots me-2"></i> şehirleri yorumla
                </a>
           

                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">şehirler</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                        <div class="offcanvas-body">
                            
                        <ul id="subcategories-list" class="list-group mobile-cities-list" >
                        
                        </ul>
            
                        <div id="pagination-container" class="pagination-container mt-3">
                    
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- Ana İçerik Alanı -->
        <div class="col-md-9 main-content">          
            <h2 class="page-title">Şehir Rehberi</h2>
            <div id="cities-content" class="content-area">

                  <!-- Placeholder Başlangıç -->              

                <div class="row placeholder-content">

                    <div class="d-flex justify-content-between mb-3">
                        <span class="content-title">Yükleniyor...</span>
                    </div>

                    <div class="col-md-4 mb-5">
                        <div class="card placeholder-glow">
                            <div class="placeholder-image bg-secondary" style="height: 180px;"></div>
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-4"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <div class="card placeholder-glow">
                            <div class="placeholder-image bg-secondary" style="height: 180px;"></div>
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-4"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <div class="card placeholder-glow">
                            <div class="placeholder-image bg-secondary" style="height: 180px;"></div>
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-4"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-5">
                        <div class="card placeholder-glow">
                            <div class="placeholder-image bg-secondary" style="height: 180px;"></div>
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-4"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <div class="card placeholder-glow">
                            <div class="placeholder-image bg-secondary" style="height: 180px;"></div>
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-4"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <div class="card placeholder-glow">
                            <div class="placeholder-image bg-secondary" style="height: 180px;"></div>
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-4"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Placeholder Bitiş -->

                <div class="real-content" style="display: none;">
                    {{-- 2024 Yılı Öğrenci Yaşam Giderleri - Aylık Ortalama --}}
                    <div class="d-flex justify-content-between mb-3">
                        <span class="content-title">2024 Yılı Öğrenci Yaşam Giderleri - Aylık Ortalama</span>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('cities/istanbul.jpg') }}" alt="istanbul">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-content">
                                        <h3 class="card-title">İstanbul</h3>
                                        <h4 class="card-location">15.000 ₺</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('cities/ankara.jpeg') }}" alt="ankara">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-content">
                                        <h3 class="card-title">Ankara</h3>
                                        <h4 class="card-location">12.000 ₺</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('cities/izmir.jpg') }}" alt="izmir">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-content">
                                        <h3 class="card-title">İzmir</h3>
                                        <h4 class="card-location">11.000 ₺</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('cities/bursa.jpg') }}" alt="bursa">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-content">
                                        <h3 class="card-title">Bursa</h3>
                                        <h4 class="card-location">10.000 ₺</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('cities/konya.jpg') }}" alt="konya">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-content">
                                        <h3 class="card-title">Konya</h3>
                                        <h4 class="card-location">9.000 ₺</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('cities/adana.jpg') }}" alt="adana">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-content">
                                        <h3 class="card-title">Adana</h3>
                                        <h4 class="card-location">8.000 ₺</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                    </div>

                    {{-- 2024 Kültürel Etkinlikler: Şehirlerdeki Sosyal Yaşam ve Fırsatlar --}}
                    <div class="d-flex justify-content-between mt-5 mb-3">
                        <span class="content-title">2024 Kültürel Etkinlikler: Şehirlerdeki Sosyal Yaşam ve Fırsatlar</span>
                    </div>

                    <div class="table-responsive mb-5">
                        <table class="table table-hover table-striped align-middle text-center shadow-sm" style="border-radius: 10px; overflow: hidden;">
                            <thead class="bg-dark text-light">
                                <tr style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                    <th style="padding: 15px;">Şehir</th>
                                    <th>🎵 Konserler ve Müzik</th>
                                    <th>🎭 Tiyatro</th>
                                    <th>🎨 Sergiler</th>
                                    <th>🤝 Sosyal Sorumluluk</th>
                                    <th>⚽ Spor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>İstanbul</strong></td>
                                    <td>
                                        <p>50+ öğrenci konseri</p>
                                        <p>15 büyük sanatçı etkinliği</p>
                                    </td>
                                    <td>
                                        <p>30+ tiyatro gösterimi</p>
                                        <p>10 tiyatro kulübü etkinliği</p>
                                    </td>
                                    <td>
                                        <p>20+ sanat sergisi</p>
                                        <p>10 öğrenci sanat etkinliği</p>
                                    </td>
                                    <td>
                                        <p>8 sosyal sorumluluk projesi</p>
                                        <p>5 çevre temizliği etkinliği</p>
                                    </td>
                                    <td>
                                        <p>10+ üniversite içi spor turnuvası</p>
                                        <p>3 büyük maraton</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Ankara</strong></td>
                                    <td>
                                        <p>25+ konser etkinliği</p>
                                        <p>10 öğrenci konseri</p>
                                    </td>
                                    <td>
                                        <p>15 tiyatro gösterimi</p>
                                        <p>8 öğrenci tiyatrosu</p>
                                    </td>
                                    <td>
                                        <p>12+ sanat sergisi</p>
                                        <p>7 özel sergi etkinliği</p>
                                    </td>
                                    <td>
                                        <p>5 sosyal sorumluluk projesi</p>
                                        <p>3 çevre etkinliği</p>
                                    </td>
                                    <td>
                                        <p>5 üniversite içi spor turnuvası</p>
                                        <p>2 büyük maraton</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>İzmir</strong></td>
                                    <td>
                                        <p>20+ konser etkinliği</p>
                                        <p>8 büyük sanatçı etkinliği</p>
                                    </td>
                                    <td>
                                        <p>18 tiyatro gösterimi</p>
                                        <p>6 öğrenci tiyatrosu</p>
                                    </td>
                                    <td>
                                        <p>15+ sanat sergisi</p>
                                        <p>5 öğrenci sanat etkinliği</p>
                                    </td>
                                    <td>
                                        <p>10 sosyal sorumluluk projesi</p>
                                        <p>4 çevre etkinliği</p>
                                    </td>
                                    <td>
                                        <p>8 üniversite içi spor turnuvası</p>
                                        <p>2 büyük maraton</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Bursa</strong></td>
                                    <td>
                                        <p>15+ konser etkinliği</p>
                                        <p>6 öğrenci konseri</p>
                                    </td>
                                    <td>
                                        <p>12 tiyatro gösterimi</p>
                                        <p>5 öğrenci tiyatrosu</p>
                                    </td>
                                    <td>
                                        <p>10+ sanat sergisi</p>
                                        <p>3 özel sergi etkinliği</p>
                                    </td>
                                    <td>
                                        <p>7 sosyal sorumluluk projesi</p>
                                        <p>4 çevre etkinliği</p>
                                    </td>
                                    <td>
                                        <p>6 üniversite içi spor turnuvası</p>
                                        <p>1 büyük maraton</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Konya</strong></td>
                                    <td>
                                        <p>10+ konser etkinliği</p>
                                        <p>5 öğrenci konseri</p>
                                    </td>
                                    <td>
                                        <p>8 tiyatro gösterimi</p>
                                        <p>4 öğrenci tiyatrosu</p>
                                    </td>
                                    <td>
                                        <p>6+ sanat sergisi</p>
                                        <p>2 özel sergi etkinliği</p>
                                    </td>
                                    <td>
                                        <p>4 sosyal sorumluluk projesi</p>
                                        <p>2 çevre etkinliği</p>
                                    </td>
                                    <td>
                                        <p>3 üniversite içi spor turnuvası</p>
                                        <p>1 büyük maraton</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Antalya</strong></td>
                                    <td>
                                        <p>18+ konser etkinliği</p>
                                        <p>7 öğrenci konseri</p>
                                    </td>
                                    <td>
                                        <p>14 tiyatro gösterimi</p>
                                        <p>5 öğrenci tiyatrosu</p>
                                    </td>
                                    <td>
                                        <p>12+ sanat sergisi</p>
                                        <p>4 özel sergi etkinliği</p>
                                    </td>
                                    <td>
                                        <p>6 sosyal sorumluluk projesi</p>
                                        <p>3 çevre etkinliği</p>
                                    </td>
                                    <td>
                                        <p>5 üniversite içi spor turnuvası</p>
                                        <p>2 büyük maraton</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Eskişehir</strong></td>
                                    <td>
                                        <p>10+ konser etkinliği</p>
                                        <p>4 öğrenci konseri</p>
                                    </td>
                                    <td>
                                        <p>7 tiyatro gösterimi</p>
                                        <p>3 öğrenci tiyatrosu</p>
                                    </td>
                                    <td>
                                        <p>5+ sanat sergisi</p>
                                        <p>2 özel sergi etkinliği</p>
                                    </td>
                                    <td>
                                        <p>3 sosyal sorumluluk projesi</p>
                                        <p>2 çevre etkinliği</p>
                                    </td>
                                    <td>
                                        <p>4 üniversite içi spor turnuvası</p>
                                        <p>1 büyük maraton</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Trabzon</strong></td>
                                    <td>
                                        <p>8+ konser etkinliği</p>
                                        <p>4 öğrenci konseri</p>
                                    </td>
                                    <td>
                                        <p>6 tiyatro gösterimi</p>
                                        <p>2 öğrenci tiyatrosu</p>
                                    </td>
                                    <td>
                                        <p>5+ sanat sergisi</p>
                                        <p>1 özel sergi etkinliği</p>
                                    </td>
                                    <td>
                                        <p>2 sosyal sorumluluk projesi</p>
                                        <p>1 çevre etkinliği</p>
                                    </td>
                                    <td>
                                        <p>3 üniversite içi spor turnuvası</p>
                                        <p>1 büyük maraton</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Kayseri</strong></td>
                                    <td>
                                        <p>12+ konser etkinliği</p>
                                        <p>6 öğrenci konseri</p>
                                    </td>
                                    <td>
                                        <p>9 tiyatro gösterimi</p>
                                        <p>3 öğrenci tiyatrosu</p>
                                    </td>
                                    <td>
                                        <p>8+ sanat sergisi</p>
                                        <p>2 özel sergi etkinliği</p>
                                    </td>
                                    <td>
                                        <p>4 sosyal sorumluluk projesi</p>
                                        <p>2 çevre etkinliği</p>
                                    </td>
                                    <td>
                                        <p>5 üniversite içi spor turnuvası</p>
                                        <p>2 büyük maraton</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>   


            </div>

        </div>

    </div>
  
@endsection 

@section('css')
    <style>
        .general-topic-btn{
            font-family: 'Segoe UI', Tahoma, Geneva, sans-serif !important;  
            font-size: 15px !important; 
            font-weight: 500 !important; 
            color: #333 !important; 
            background-color: transparent !important;
            padding: 8px 12px !important; 
            text-align: center !important;
            text-transform: none !important; 
            letter-spacing: 0.3px !important; 
            cursor: pointer;
        }
  
        .avatar{
            display: block;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-top: 2px;
            margin-bottom: 2px;
        }
        .footer-info{
            float: left;
            vertical-align: middle;
            padding: 4px;
            padding-right: 10px;
        }
         .topic {
            padding: 10px 0;
        }
       
        .topic h3 {
            margin: 0;
            font-size: 17px;
            color: #333;
        }
        .topic p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }
        .topic .meta {
            display: flex;
            justify-content: end;
        }
        #subcategories-list .list-group-item{
            border:none !important;
            padding: 7px 0px;
        }
        #subcategories-list .list-group-item:hover{
            border-bottom:1px solid !important;
        }
        .btnCreateGeneral:hover , .btnCreateCity:hover , .btnCreateUniversity:hover{
            border-bottom: 1px groove #000000 !important;
            border-radius: 0px !important;
        }
        .content-title{
            font-size: 20px;
            font-weight: 600;
        }
        .content-area {
            padding: 15px 30px;
            
        }
        .activeCategory {
            border-bottom: 1px solid gray;
            color: #333 !important;
            border-radius: 0px;
        }
        .activeCategory:hover{
            border-bottom: 1px solid gray;
        }
        .universityTag, .cityTag, .subCategoryTag{
            color: #000000 !important;
            font-size: 13px;
            font-weight: 400;
        }
       
        .universityLi:hover , .cityLi:hover{
            background-color: #fafafae0; 
        }

        .swal2-title{
                font-size: 18px !important;
        }

       .swal-custom-popup {
            width: 420px !important; 
        }
        .topic-title{
            font-weight: bold;
            word-wrap: break-word;
            padding-right: 130px;
        }

        .topic-title-sub-category {
            flex: 1;
            word-wrap: break-word; 
            word-break: break-word;
        }

        .count {
            margin-left: auto; 
            display: inline-block;
            margin-left: 15px;
            font-weight: 700;
            color: #001b48;
        }

    </style>

    <style>
         /* card css */
         .card-container {
            position: relative;
            width: auto; 
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
        }

        .card-image img {
            width: 100%;
            height: 150px;
            display: block;
        }

        .card-overlay {
            position: absolute;
            top: 0;
            right: 0;
            /* bottom: 110px; */
            left: 0%;
            background: rgb(255 0 0 / 80%); 
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            height: 60px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
            transition: transform 0.3s ease, box-shadow 0.3s ease; 
        }

        .card-overlay:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .card-content {
            text-align: center;
        }

        .badge img {
            width: 60px;
            height: auto;
            margin-bottom: 10px;
        }

        .card-title {
            font-size: 16px;
            margin: 10px 0px;
        }

        .card-location {
            font-size: 13px;
        }
    </style>

    <style>
      #pagination-container a {
          text-decoration: none; 
          padding: 5px 7px; 
          margin: 0 5px; 
          color: blue; 
          border:none;
      }

      #pagination-container a.active {
          background-color: white !important;
          border-color: #007bff !important;
          /* color: white;  */
      }

      #pagination-container a:hover {
          background-color: #f1f1f1; 
      }

    </style>

    <style>
        .page-title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 10px 0;
            color: white;
            background: #001B48; 
            padding: 10px; 
            border-radius: 5px; 
        }

        .main-content{
            border-left: 1px solid #e0e0e0;
        }

        .real-content {
            display: none;
        }

    </style>

    {{-- mobil --}}
    <style>
        @media (max-width: 768px) {
            .main-content{
                border-top: 1px solid #e0e0e0;
                border-left: none;
            }

            .page-title{
                font-size: 14px;
                font-weight: 400;
            }

            .content-title{
                font-size: 16px;
            }

            .sidebarTitle{
                font-size: 20px;
            }

            .card-container{
                margin-bottom: 15px;
            }

            #toggle-subcategories{
                display:block !important;
            }

            .mobile-hidden-pagination {
                display: none;
            }

            #toggle-subcategories i {
                transition: transform 0.3s ease;
            }

            #toggle-subcategories.collapsed i {
                transform: rotate(180deg);
            }

            .mobile-show{
                display: block !important;
            }

            
            .mobile-hidden{
                display: none !important;
            }
            .custom-offcanvas {
                width: 210px; 
            }
        }

    </style>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script>
        $(document).ready(function () {
            function loadCities(page = 1) {
                $.ajax({
                    url: '/cities/fetch',
                    type: 'GET',
                    data: { page: page },
                    success: function (response) {
                        
                        let citiesHtml = '';
                        $.each(response.cities.data, function (index, item) {
                            const topicCount = response.cities_topics_count[item.id] || 0;
                            citiesHtml += `
                                <li class="list-group-item universityLi">
                                    <a href="/forum/sehir/${item.slug}" class="text-decoration-none universityTag d-flex justify-content-between">
                                        <span class="topic-title-sub-category">${item.title}</span>
                                        <span class="count">${topicCount}</span>
                                    </a>
                                </li>`;
                        });
                        $('#subcategories-list').html(citiesHtml);
                        $('.mobile-cities-list').html(citiesHtml);

                        // Sayfa bağlantılarını güncelle
                        $('#pagination-container').html(response.links);
                        $('.pagination-container').html(response.links);
                    },
                    error: function () {
                        alert('şehirler yüklenirken bir hata oluştu.');
                    }
                });
            }

            // İlk yükleme
            loadCities();

            // Sayfa bağlantılarına tıklama olayı
            $(document).on('click', '#pagination-container a', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                const page = new URL(url).searchParams.get('page');
                loadCities(page);
            });
        });

    </script>
    
    <script>
        $(document).ready(function () {
                $('#toggle-subcategories').on('click', function () {
                    // Toggle the visibility of the list
                    $('.mobile-hidden-pagination').slideToggle();

                    // Rotate the arrow icon
                    $(this).toggleClass('collapsed');
                });
            });

    </script>
    
    <script>
       document.addEventListener("DOMContentLoaded", function () {
            const placeholderContent = document.querySelector(".placeholder-content");
            const realContent = document.querySelector(".real-content");

            // Placeholder'ları göster
            placeholderContent.style.display = "flex";
            realContent.style.display = "none";

            // 3 saniye sonra gerçek içeriği göster
            setTimeout(function () {
                placeholderContent.style.display = "none"; // Placeholder'ları gizle
                realContent.style.display = "block"; // Gerçek içeriği göster
            }, 3000);
        });


    </script>
@endsection
