@extends('layouts.master') 

@section('content')

    <div class="row" style="margin-top: -25px;">
        <!-- Sol Menü (Alt Başlıklar) -->
        <div class="col-md-3 mb-3">
            <div class="mobile-hidden d-block">

                    <div class="d-flex justify-content-between">
                        <h4 class="sidebarTitle">üniversiteler</h4>

                        {{-- <button id="toggle-subcategories" class="btn btn-sm d-none" >
                            <i class="fa-solid fa-chevron-down"></i>
                        </button> --}}

                    </div>
            
                {{-- <div class="mobile-hidden-pagination"> --}}

                        <ul id="subcategories-list" class="list-group" >
                        
                        </ul>
            
                        <div id="pagination-container" class="pagination-container mt-3">
                        
                        </div>
                {{-- </div>  --}}
            </div>

            <div class="mobile-show d-none">
                <a class="btn btn-primary w-100" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                    <i class="bi bi-chat-dots me-2"></i> üniversiteni yorumla
                </a>
           

                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">üniversiteler</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                        <div class="offcanvas-body">
                            
                        <ul id="subcategories-list" class="list-group mobile-universities-list" >
                        
                        </ul>
            
                        <div id="pagination-container" class="pagination-container mt-3">
                    
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- Ana İçerik Alanı -->
        <div class="col-md-9 main-content">          
            <h2 class="page-title">Türkiye'nin Lider Üniversiteleri</h2>
            <div id="universities-content" class="content-area">

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


                    <div class="col-md-4">
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
                    <div class="col-md-4">
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
                    <div class="col-md-4">
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
                {{-- köklü üniversiteler --}}
                    <div class="d-flex justify-content-between mb-3">
                        <span class="content-title">Köklü Üniversiteler</span>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('well-established universities/bogazici-universitesi.jpg') }}" alt="bogazici-universitesi">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-content">
                                        <h3 class="card-title">Boğaziçi Üniversitesi</h3>
                                        <h4 class="card-location">İstanbul</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('well-established universities/odtu.jpg') }}" alt="bogazici-universitesi">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-content">
                                        <h3 class="card-title">Orta Doğu Teknik Üniversitesi</h3>
                                        <h4 class="card-location">Ankara</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('well-established universities/itu.jpeg') }}" alt="bogazici-universitesi">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-content">
                                        <h3 class="card-title">İstanbul Teknik Üniversitesi</h3>
                                        <h4 class="card-location">İstanbul</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    {{-- En çok Tercih Edilen Üniversiteler --}}
                    <div class="d-flex justify-content-between mb-3 mt-5">
                        <span class="content-title">En çok Tercih Edilen Üniversiteler</span>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('well-established universities/odtu.jpg') }}" alt="bogazici-universitesi">
                                </div>
                                <div class="card-overlay" style="background: rgba(0, 54, 133, 0.8);">
                                    <div class="card-content">
                                        <h3 class="card-title">1. Orta Doğu Teknik Üniversitesi</h3>
                                        <h4 class="card-location">Ankara</h4>
                                    </div>
                                </div>
                            </div>                        
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('well-established universities/bogazici-universitesi.jpg') }}" alt="bogazici-universitesi">
                                </div>
                                <div class="card-overlay" style="background: rgba(0, 54, 133, 0.8);">
                                    <div class="card-content">
                                        <h3 class="card-title">2. Boğaziçi Üniversitesi</h3>
                                        <h4 class="card-location">İstanbul</h4>
                                    </div>
                                </div>
                            </div>                        
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('well-established universities/hacettepe-uni.jpg') }}" alt="bogazici-universitesi">
                                </div>
                                <div class="card-overlay" style="background: rgba(0, 54, 133, 0.8);">
                                    <div class="card-content">
                                        <h3 class="card-title">3. Hacettepe Üniversitesi</h3>
                                        <h4 class="card-location">Ankara</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    {{-- En çok bilimsel yayın üreten üniversiteler  --}}
                    <div class="d-flex justify-content-between mb-3 mt-5">
                        <span class="content-title">En çok bilimsel yayın üreten üniversiteler</span>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('universite/istanbul-uni.jpeg') }}" alt="istanbul-universitesi">
                                </div>
                                <div class="card-overlay" style="background: rgba(0, 54, 133, 0.8);">
                                    <div class="card-content">
                                        <h3 class="card-title">1. İstanbul Üniversitesi</h3>
                                        <h4 class="card-location">14.069 bilimsel yayın</h4>
                                    </div>
                                </div>
                            </div>                        
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('universite/hacettepe-uni.jpg') }}" alt="hacettepe-universitesi">
                                </div>
                                <div class="card-overlay" style="background: rgba(0, 54, 133, 0.8);">
                                    <div class="card-content">
                                        <h3 class="card-title">2. Hacettepe Üniversitesi</h3>
                                        <h4 class="card-location">13.457 bilimsel yayın</h4>
                                    </div>
                                </div>
                            </div>                        
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('universite/ankara-uni.jpg') }}" alt="ankara-universitesi">
                                </div>
                                <div class="card-overlay" style="background: rgba(0, 54, 133, 0.8);">
                                    <div class="card-content">
                                        <h3 class="card-title">3. Ankara Üniversitesi</h3>
                                        <h4 class="card-location">11.485 bilimsel yayın</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    {{-- Sanayi ile iş birliği yapan teknoparklara sahip üniversiteler --}}
                    <div class="d-flex justify-content-between mb-3 mt-5">
                        <span class="content-title">Sanayi ile iş birliği yapan teknoparklara sahip üniversiteler</span>
                    </div>
                    {{-- ODTÜ Teknokent: 400+ firma
                    İTÜ ARI Teknokent: 300+ firma
                    Bilkent Cyberpark: 250+ firma
                    Yıldız Teknopark: 350+ firma
                    Hacettepe Teknokent: 200+ firma --}}

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('universite/odtu-teknokent.jpg') }}" alt="odtu-teknokent">
                                </div>
                                <div class="card-overlay"  style="background: rgba(109, 175, 108, 0.8);">
                                    <div class="card-content">
                                        <h3 class="card-title">1. ODTÜ Teknokent</h3>
                                        <h4 class="card-location">400+ firma</h4>
                                    </div>
                                </div>
                            </div>                        
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('universite/itu-ari-teknokent.jpg') }}" alt="itu-ari-teknokent">
                                </div>
                                <div class="card-overlay"  style="background: rgba(109, 175, 108, 0.8);">
                                    <div class="card-content">
                                        <h3 class="card-title">2. İTÜ ARI Teknokent</h3>
                                        <h4 class="card-location"> 300+ firma</h4>
                                    </div>
                                </div>
                            </div>                        
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('universite/bilkent-cyberpark.jpg') }}" alt="bilkent-cyberpark">
                                </div>
                                <div class="card-overlay"  style="background: rgba(109, 175, 108, 0.8);">
                                    <div class="card-content">
                                        <h3 class="card-title">3. Bilkent Cyberpark</h3>
                                        <h4 class="card-location"> 250+ firma</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
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
            height: auto;
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
                width: 310px; 
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
            function loadUniversities(page = 1) {
                $.ajax({
                    url: '/universities/fetch',
                    type: 'GET',
                    data: { page: page },
                    success: function (response) {
                        // Üniversite listesini güncelle
                        let universitiesHtml = '';
                        $.each(response.universities.data, function (index, item) {
                            const topicCount = response.universities_topics_count[item.id] || 0;
                            universitiesHtml += `
                                <li class="list-group-item universityLi">
                                    <a href="/forum/universite/${item.slug}" class="text-decoration-none universityTag d-flex justify-content-between">
                                        <span class="topic-title-sub-category">${item.universite_ad}</span>
                                        <span class="count">${topicCount}</span>
                                    </a>
                                </li>`;
                        });
                        $('#subcategories-list').html(universitiesHtml);
                        $('.mobile-universities-list').html(universitiesHtml);

                        // Sayfa bağlantılarını güncelle
                        $('#pagination-container').html(response.links);
                        $('.pagination-container').html(response.links);
                    },
                    error: function () {
                        alert('Üniversiteler yüklenirken bir hata oluştu.');
                    }
                });
            }

            // İlk yükleme
            loadUniversities();

            // Sayfa bağlantılarına tıklama olayı
            $(document).on('click', '#pagination-container a', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                const page = new URL(url).searchParams.get('page');
                loadUniversities(page);
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
