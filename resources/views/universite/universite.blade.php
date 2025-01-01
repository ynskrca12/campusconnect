@extends('layouts.master') 

@section('content')

    <div class="row" style="margin-top: -25px;">
        <!-- Sol Menü (Alt Başlıklar) -->
        <div class="col-md-3">
            <h4 class="sidebarTitle">üniversiteler</h4>
            {{-- <ul id="subcategories-list" class="list-group">
                @foreach ($universities as $item)
                  <li class="list-group-item universityLi">
                      <a href="/forum/universite/{{$item->slug}}" class="text-decoration-none universityTag d-flex justify-content-between">
                          <span class="topic-title-sub-category">{{ $item->universite_ad }}</span>
                          <span class="count">{{ $universities_topics_count[$item->id] ?? 0 }}</span>
                          </a>
                  </li>
                @endforeach
            </ul> --}}
            <ul id="subcategories-list" class="list-group">
                <!-- Üniversite listesi buraya dinamik olarak yüklenecek -->
            </ul>
            <div id="pagination-container" class="pagination-container mt-3">
                <!-- Sayfa numaraları buraya yüklenecek -->
            </div>
        </div>

        <!-- Ana İçerik Alanı -->
        <div class="col-md-9" style="border-left: 1px solid #e0e0e0;">          

            <div id="universities-content" class="content-area">

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
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

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

                // Sayfa bağlantılarını güncelle
                $('#pagination-container').html(response.links);
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
    
@endsection
