@extends('layouts.master') 

@section('title', $university->universite_ad)
@section('meta_description', $university->universite_ad . ' hakkında detaylı bilgiler, yorumlar, bölümler, fakülteler ve kampüs hayatı. ' . $university->universite_ad . ' ile ilgili tüm sorularınızı buradan öğrenin.')
@section('meta_keywords', $blog->meta_keywords ?? 'blog, haber, yazı')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="university-banner-wrapper">
                <img src="{{ asset( $university->image) }}" alt="{{ $university->universite_ad }}"
                onerror="this.onerror=null; this.src='https:\//campusconnect.com.tr/public/assets/images/university-banner/default.jpg';">
                <div class="university-banner-overlay">
                    <div class="university-banner-title">
                        {{ $university->universite_ad }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row mb-3" style="border-bottom: 1px solid;">
       <div class="col-md-3 d-flex align-items-center justify-content-between mobile-hidden">
        <!-- Geri Tuşu -->
        <i class="fa-solid fa-circle-left" style="font-size: 25px; cursor: pointer;" onclick="goBack()"></i>

        <!-- Sosyal Medya Butonları -->
        <div class="d-flex align-items-center gap-4">
            <!-- Resmi Site -->
            <a href="https://www.universite-adi.edu.tr" target="_blank">
                <i class="fa-solid fa-globe" style="font-size: 20px;color:#555"></i>
            </a>
            <!-- Instagram -->
            <a href="https://www.instagram.com/universiteadi" target="_blank">
                
                <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="20px" width="20px" version="1.1" id="Layer_1" viewBox="0 0 551.034 551.034" xml:space="preserve">
                    <g id="XMLID_13_">                        
                            <linearGradient id="XMLID_2_" gradientUnits="userSpaceOnUse" x1="275.517" y1="4.5714" x2="275.517" y2="549.7202" gradientTransform="matrix(1 0 0 -1 0 554)">
                            <stop offset="0" style="stop-color:#E09B3D"/>
                            <stop offset="0.3" style="stop-color:#C74C4D"/>
                            <stop offset="0.6" style="stop-color:#C21975"/>
                            <stop offset="1" style="stop-color:#7024C4"/>
                        </linearGradient>
                        <path id="XMLID_17_" style="fill:url(#XMLID_2_);" d="M386.878,0H164.156C73.64,0,0,73.64,0,164.156v222.722   c0,90.516,73.64,164.156,164.156,164.156h222.722c90.516,0,164.156-73.64,164.156-164.156V164.156   C551.033,73.64,477.393,0,386.878,0z M495.6,386.878c0,60.045-48.677,108.722-108.722,108.722H164.156   c-60.045,0-108.722-48.677-108.722-108.722V164.156c0-60.046,48.677-108.722,108.722-108.722h222.722   c60.045,0,108.722,48.676,108.722,108.722L495.6,386.878L495.6,386.878z"/>
                        
                            <linearGradient id="XMLID_3_" gradientUnits="userSpaceOnUse" x1="275.517" y1="4.5714" x2="275.517" y2="549.7202" gradientTransform="matrix(1 0 0 -1 0 554)">
                            <stop offset="0" style="stop-color:#E09B3D"/>
                            <stop offset="0.3" style="stop-color:#C74C4D"/>
                            <stop offset="0.6" style="stop-color:#C21975"/>
                            <stop offset="1" style="stop-color:#7024C4"/>
                        </linearGradient>
                        <path id="XMLID_81_" style="fill:url(#XMLID_3_);" d="M275.517,133C196.933,133,133,196.933,133,275.516   s63.933,142.517,142.517,142.517S418.034,354.1,418.034,275.516S354.101,133,275.517,133z M275.517,362.6   c-48.095,0-87.083-38.988-87.083-87.083s38.989-87.083,87.083-87.083c48.095,0,87.083,38.988,87.083,87.083   C362.6,323.611,323.611,362.6,275.517,362.6z"/>
                        
                            <linearGradient id="XMLID_4_" gradientUnits="userSpaceOnUse" x1="418.306" y1="4.5714" x2="418.306" y2="549.7202" gradientTransform="matrix(1 0 0 -1 0 554)">
                            <stop offset="0" style="stop-color:#E09B3D"/>
                            <stop offset="0.3" style="stop-color:#C74C4D"/>
                            <stop offset="0.6" style="stop-color:#C21975"/>
                            <stop offset="1" style="stop-color:#7024C4"/>
                        </linearGradient>
                        <circle id="XMLID_83_" style="fill:url(#XMLID_4_);" cx="418.306" cy="134.072" r="34.149"/>
                    </g>
                </svg>
            </a>
            <!-- Twitter / X -->
            <a href="https://twitter.com/universiteadi" target="_blank" class="text-dark">
                <i class="fa-brands fa-x-twitter" style="font-size: 20px;"></i>
            </a>
            <!-- YouTube -->
            <a href="https://www.youtube.com/@universiteadi" target="_blank" class="text-dark">
                <i class="fa-brands fa-youtube" style="font-size: 20px;color:#ff0000"></i>
            </a>
        </div>
    </div>

        
        <div class="col-md-9 mb-3">
            <ul class="nav nav-tabs d-flex justify-content-between mobile-hidden" id="mainTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="free-zone-tab" data-bs-toggle="tab" href="#free-zone" role="tab" aria-controls="free-zone" aria-selected="true" data-category="free-zone">Serbest Bölge ({{$topicCount['free-zone']}})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="departmant-programs-tab" data-bs-toggle="tab" href="#departmant-programs" role="tab" aria-controls="departmant-programs" aria-selected="false" data-category="departmant-programs">Bölüm ve Prog. ({{$topicCount['departmant-programs']}})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="campus-life-tab" data-bs-toggle="tab" href="#campus-life" role="tab" aria-controls="campus-life" aria-selected="false" data-category="campus-life">Kampüs Hayatı ({{$topicCount['campus-life']}})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="question-answer-tab" data-bs-toggle="tab" href="#question-answer" role="tab" aria-controls="question-answer" aria-selected="false" data-category="question-answer">Soru Cevap ({{$topicCount['question-answer']}})</a>
                </li>
            </ul>

            <div class="d-none mobile-show">
                <div class="d-flex justify-content-center">
                <select class="form-select" id="mobileTabs" aria-label="Default select example" 
                    style="font-size: 13px;width: 70%;">
                    <option value="#free-zone" selected>Serbest Bölge ({{$topicCount['free-zone']}})</option>
                    <option value="#departmant-programs">Bölüm ve Prog. ({{$topicCount['departmant-programs']}})</option>
                    <option value="#campus-life">Kampüs Hayatı ({{$topicCount['campus-life']}})</option>
                    <option value="#question-answer">Soru Cevap ({{$topicCount['question-answer']}})</option>
                </select>
                </div>
            </div>
            
        </div>
        

       
    </div>

    <div class="row">
        <!-- Sol Menü (Alt Başlıklar) -->
        <div class="col-md-3">

            <div class="mobile-hidden d-block">
                <h4>öne çıkan mevzular</h4>

                <ul id="subcategories-list" class="list-group">
                    @foreach($getUnivercityFreeZoneTopics as $topic)
                        <li class="list-group-item">
                            <a href="{{ route('university.topic.comments', ['slug' => $topic->topic_title_slug]) }}" class="text-decoration-none subCategoryTag d-flex justify-content-between">
                                <span class="topic-title-sub-category">{{ $topic->topic_title }}</span>
                                <span class="count">{{ $topic->count }}</span>                                
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mobile-show d-none">
                <a class="btn btn-primary w-100" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                    <i class="bi bi-chat-dots me-2"></i> öne çıkan mevzular
                </a>           

                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">öne çıkan mevzular</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                        <div class="offcanvas-body">
                            
                        <ul id="subcategories-list-mobile" class="list-group mobile-universities-list" >
                            @foreach($getUnivercityFreeZoneTopics as $topic)
                                <li class="list-group-item">
                                    <a href="{{ route('university.topic.comments', ['slug' => $topic->topic_title_slug]) }}" class="text-decoration-none subCategoryTag text-dark">
                                        <span class="topic-title-sub-category">{{ $topic->topic_title }}</span>
                                        <span class="count">{{ $topic->count }}</span>      
                                    </a>
                                </li>
                            @endforeach
                        </ul>
            
                        <div id="pagination-container" class="pagination-container mt-3">
                    
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!--main content-->
            <div class="col-md-9"  style="border-left: 1px solid #e0e0e0;">
                <div class="tab-content">

                    <div class="tab-pane fade show active" id="free-zone" role="tabpanel" aria-labelledby="free-zone-tab">
                        <div class="d-flex justify-content-end">
                            
                           <div> 
                                <button class="btn btnExplain mb-2" data-category="free-zone">
                                    <i class="fa-solid fa-comments me-2"></i>Yorum Yap
                                </button>
                            </div>
                        </div>        
                        <div id="free-zone-topic-list">
                            @foreach ($univercity_free_zone_topics as $topic) 
                                <x-topic-box :topic="$topic" routeName="university.topic.comments" />
                            @endforeach   
                        </div>
                    </div>

                    <div class="tab-pane fade" id="departmant-programs" role="tabpanel" aria-labelledby="departmant-programs-tab">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                {{-- <span class="categoryTitle">bölüm ve programlar</span> --}}
                            </div>
                           <div> 
                                <button class="btn btnExplain" data-category="departmant-programs">
                                    <i class="fa-solid fa-comments me-2"></i>Yorum Yap
                                </button>
                            </div>
                        </div>
                        <div id="departmant-programs-topic-list">
                            <!-- İçerik buraya gelecek -->
                        </div>
                    
                    </div>

                    <div class="tab-pane fade" id="campus-life" role="tabpanel" aria-labelledby="campus-life-tab">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                {{-- <span class="categoryTitle">kampüs hayatı</span> --}}
                            </div>
                           <div> 
                                <button class="btn btnExplain" data-category="campus-life">
                                    <i class="fa-solid fa-comments me-2"></i>Yorum Yap
                                </button>
                            </div>
                        </div>
                        <div id="campus-life-topic-list">
                            <!-- İçerik buraya gelecek -->
                        </div>
                    
                    </div>

                    <div class="tab-pane fade" id="question-answer" role="tabpanel" aria-labelledby="question-answer-tab">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                {{-- <span class="categoryTitle">soru cevap</span> --}}
                            </div>
                            <div>
                                <button class="btn btnExplain" data-category="question-answer">
                                    <i class="fa-solid fa-comments me-2"></i>Yorum Yap
                                </button>
                            </div>
                        </div>        
                        <div id="question-answer-topic-list">
                            <!-- İçerik buraya gelecek -->
                        </div>
                    
                    </div>

                </div>
            </div> 
    </div>

    <div class="modal fade" id="topicModal" tabindex="-1" aria-labelledby="topicModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="topicModalLabel">mevzu nedir </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="topicForm">
                @csrf
                <input type="hidden" name="universityId" value="{{$university->id}}">
                <div class="text-center mb-3">
                  {{-- <label for="topicTitle" class="form-label">Konu Başlığı</label> --}}
                  <input type="text" id="title" name="topic_title" class="form-control" 
                    placeholder="başlık" maxlength="80" 
                    style="border: none;border-bottom: 1px solid #ced4da;border-radius: 0px;">
                    <small id="charCount" class="form-text text-muted">
                        0/80 karakter
                    </small>
                </div>
                <div class="mb-3">
                  {{-- <label for="topicDescription" class="form-label">Açıklama</label> --}}
                  <textarea class="form-control" id="topicDescription" placeholder="açıklamanız" name="comment" rows="3" required></textarea>
                </div>
                <input type="hidden" id="categoryName" name="category">
                <button type="submit" class="btn btn-primary" id="submitTopic">Kaydet</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      
  
@endsection 

@section('css')
<style>
    .university-banner-wrapper {
        position: relative;
        width: 100%;
        height: 250px;
        border-radius: 12px;
        overflow: hidden;
    }

    .university-banner-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
        filter: brightness(90%);
    }

    .university-banner-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.1));
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 1rem;
    }

    .university-banner-title {
        color: #fff;
        font-size: 2.5rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    @media (max-width: 576px) {
        .university-banner-wrapper {
            height: 200px;
        }

        .university-banner-title {
            font-size: 1.5rem;
        }
    }
</style>
    <style>
         .fa-envelope{
            font-size: 22px !important;
        }

        .categoryTitle{
            font-weight: 700;
            font-size: medium;
            margin-right: 5px;
            margin-left: 5px;
        }
        .btnExplain:hover{
            border-bottom: 1px groove #000000 !important;
            border-radius: 0px !important;
        }
        .nav-tabs{
            border-bottom: 0px;
        }
        .nav-tabs .nav-item{
            width: 20%;
            text-align: center;
        }

        .nav-tabs .nav-link {
            color: #373737 !important;
            background-color: white; 
            font-size: 13px;
            border: none;
        }
        .nav-tabs .nav-link.active {
            border-bottom: 1px solid #bdbdbd;
            color: #373737 !important;
        }

        .nav-tabs .nav-link:hover{
            border-color: #373737;
        }
        .btnExplain:hover{
            border-bottom: 1px groove #000000 !important;
            border-radius: 0px !important;
        }

        #subcategories-list .list-group-item, #subcategories-list-mobile .list-group-item{
            border:none !important;
            padding: 7px 0px;
            border-radius: 6px;
            cursor: pointer;
        }

        .content-section {
            display: none;
        }

        .content-section:not(.d-none) {
            display: block;
        }

        .list-group-item {
            cursor: pointer;
        }
    </style>

    <style>
        .page-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
        }
        
        .subCategoryTag{
            color: #000000 !important;
            font-size: 13px;
            font-weight: 400;
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

        @media (max-width: 768px) {
            .page-title{
                font-size: 1rem;
            }
            .mobile-show {
                display: block !important;
            }
            .mobile-hidden {
                display: none !important;
            }
            .tab-content>.active {
                margin-top: 20px;
            }
        }
    </style>
@endsection

@section('js')
    <!-- jQuery 3.6.0 (en güncel ve yaygın olarak kullanılan versiyon) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    
    <script>
        // Mobil Select Elementi
        const mobileTabs = document.getElementById('mobileTabs');
        
        // Mobil seçeneği değiştiğinde ilgili tab içeriğini göster
        mobileTabs.addEventListener('change', function () {
            const selectedTabId = this.value;
        
            // Tüm tab içeriğini gizle
            document.querySelectorAll('.tab-pane').forEach(tab => {
                tab.classList.remove('show', 'active');
            });
        
            // Seçilen tab içeriğini göster
            const selectedTabContent = document.querySelector(selectedTabId);
            if (selectedTabContent) {
                selectedTabContent.classList.add('show', 'active');
            }
        });
    
    </script>

    <script>
        var quill = new Quill('#editor-container-general', {
            theme: 'snow'
        });

            document.querySelector('form').onsubmit = function() {
            document.querySelector('#comment').value = quill.root.innerHTML;
        };
    </script>

    <script>
        var quill = new Quill('#editor-container-university', {
            theme: 'snow'
        });

            document.querySelector('form').onsubmit = function() {
            document.querySelector('#comment').value = quill.root.innerHTML;
        };
    </script>

    <script>
        var quill = new Quill('#editor-container-city', {
            theme: 'snow'
        });

            document.querySelector('form').onsubmit = function() {
            document.querySelector('#comment').value = quill.root.innerHTML;
        };
    </script>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    {{-- change important topics for web and mobile --}}
    <script>
        $(document).ready(function () {
            let isLoading = false;

            $(".nav-link").on("click", function () {
                if(isLoading) return;
                isLoading = true;

                const category = $(this).data("category"); 
                const subcategoriesList = $("#subcategories-list"); 
                const univercityId = @json($university->id);

                const topicListContainer = $("#" + category + "-topic-list");

                if (topicListContainer.length === 0) {
                    console.error("Hedef container bulunamadı.");
                    isLoading = false;
                    return;
                }

                subcategoriesList.empty();

                $.ajax({
                    url: "/get-univercity-category-topics",
                    method: "GET",
                    data: { category: category ,
                        univercityId:univercityId
                    },
                    success: function (response) {
                        // Dönen verilerdeki her bir başlığı listeye ekle
                        response.topics.forEach(topic => {
                            const listItem = `
                                <li class="list-group-item">
                                    <a href="/forum/universite/mevzu/${topic.topic_title_slug}" class="text-decoration-none subCategoryTag d-flex justify-content-between">
                                         <span class="topic-title-sub-category">${topic.topic_title}</span>
                                         <span class="count">${topic.count}</span>
                                    </a>
                                </li>`;
                            subcategoriesList.append(listItem);
                        });
                        isLoading = false;
                    },
                    error: function () {
                        alert("Konular yüklenirken bir hata oluştu.");
                        isLoading = false;
                    }
                });

                $.ajax({
                    url: "/get-univercity-category-topic-content",
                    method: "GET",
                    data: {
                        category: category,
                        univercityId: univercityId,
                    },
                    beforeSend: function () { 
                        topicListContainer.html("<p>İçerik yükleniyor...</p>");
                    },
                    success: function (response) { 
                        if (response.success && response.html) {
                            topicListContainer.html(response.html);
                        } else {
                            topicListContainer.html("<p>Bu kategoriye ait içerik bulunmamaktadır.</p>");
                        }
                    },
                    error: function () {
                        topicListContainer.html("<p>İçerik yüklenirken bir hata oluştu.</p>");
                    },
                });


            });

            // Mobil kategoriler için değişim
            $("#mobileTabs").on("change", function () {
                const category = $(this).val().replace(/^#/, "");
                const subcategoriesListMobile = $("#subcategories-list-mobile");
                const univercityId = @json($university->id);

                const topicListContainer = $("#" + category + "-topic-list");

                if (topicListContainer.length === 0) {
                    console.error("Hedef container bulunamadı.");
                    return;
                }

                subcategoriesListMobile.empty();

                $.ajax({
                    url: "/get-univercity-category-topics",
                    method: "GET",
                    data: { 
                        category: category,
                        univercityId: univercityId
                    },
                    success: function (response) {
                        // Dönen verilerdeki her bir başlığı listeye ekle
                        response.topics.forEach(topic => {
                            const listItem = `
                               <li class="list-group-item">
                                    <a href="/forum/universite/mevzu/${topic.topic_title_slug}" class="text-decoration-none subCategoryTag d-flex justify-content-between">
                                         <span class="topic-title-sub-category">${topic.topic_title}</span>
                                         <span class="count">${topic.count}</span>
                                    </a>
                                </li>`;

                                
                            subcategoriesListMobile.append(listItem);
                        });
                    },
                    error: function () {
                        alert("Konular yüklenirken bir hata oluştu.");
                    }
                });

                $.ajax({
                    url: "/get-univercity-category-topic-content",
                    method: "GET",
                    data: {
                        category: category,
                        univercityId: univercityId,
                    },
                    beforeSend: function () {
                        // Yükleniyor animasyonu eklenebilir
                        topicListContainer.html("<p>İçerik yükleniyor...</p>");
                    },
                    success: function (response) {
                        if (response.success && response.html) {
                            topicListContainer.html(response.html);
                        } else {
                            topicListContainer.html("<p>Bu kategoriye ait içerik bulunmamaktadır.</p>");
                        }
                    },
                    error: function () {
                        topicListContainer.html("<p>İçerik yüklenirken bir hata oluştu.</p>");
                    },
                });
            });
        });

    </script>

    <script>
        $(document).ready(function () {
            $('.btnExplain').on('click', function () {

                var isAuthenticated = @json(auth()->check());

                if (!isAuthenticated) {
                    toastr.warning('Önce giriş yapmalısınız.');
                    return;
                }
                
                const category = $(this).data('category');

                $('#categoryName').val(category); 
                $('#topicModal').modal('show'); 
            });

            $('#topicForm').on('submit', function (e) {
                e.preventDefault();

                
                let $submitTopic = $('#submitTopic');

                $submitTopic.prop('disabled', true);
                $submitTopic.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Gönderiliyor...');
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const formData = $(this).serialize(); 

                $.ajax({
                    url: '/university-topic/add', 
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        
                        sessionStorage.setItem('toastrMessage', 'Konu başarıyla gönderildi!');
                        
                        $('#topicModal').modal('hide');
                        $('#topicForm')[0].reset(); 

                        setTimeout(function () {
                            location.reload();
                        }, 500);

                    },
                    error: function (xhr) {
                        console.error('Hata Detayı:', xhr.responseText); 
                        toastr.error('Konu eklenirken bir hata oluştu. Detayları kontrol edin.');
                    }
                });
            });

            const toastrMessage = sessionStorage.getItem('toastrMessage');
                if (toastrMessage) {
                    toastr.success(toastrMessage);
                    sessionStorage.removeItem('toastrMessage'); 
                }
        });

        $(document).on('input', '#title', function() {
            const length = $(this).val().length;
            $('#charCount').text(`${length}/80 karakter`);
        });

    </script>

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000", // Mesajın görünür kalacağı süre (ms)
        };

        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>

   {{-- like dislike --}}
    <script>
      $(document).on('click', '.like-btn', function () {
            let topicId = $(this).data('id');
            let userId = '{{ auth()->id() }}'; 

            if (!userId) {
                toastr.error('Giriş yapmalısın.');
                return;
            }
            
            let likeCount = $(this).find('.like-count');
            let dislikeBtn = $(this).closest('.like-dislike').find('.dislike-btn');
            let dislikeCount = dislikeBtn.find('.dislike-count');

            $.ajax({
                url: `/university/topic/${topicId}/like`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    likeCount.text(response.likes);
                    dislikeCount.text(response.dislikes);
                    
                    $('.like-btn[data-id="' + topicId + '"]').css("color", "#007bff"); // Mavi renk
                    $('.dislike-btn[data-id="' + topicId + '"]').css("color", "#888"); // Gri renk
                }
            });
        });

        $(document).on('click', '.dislike-btn', function () {
            let topicId = $(this).data('id');
            let userId = '{{ auth()->id() }}'; 

            if (!userId) {
                toastr.error('Giriş yapmalısın.');
                return;
            }

            let dislikeCount = $(this).find('.dislike-count');
            let likeBtn = $(this).closest('.like-dislike').find('.like-btn');
            let likeCount = likeBtn.find('.like-count');

            $.ajax({
                url: `/university/topic/${topicId}/dislike`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    likeCount.text(response.likes);
                    dislikeCount.text(response.dislikes);

                    $('.dislike-btn[data-id="' + topicId + '"]').css("color", "#dc3545"); // Kırmızı renk
                    $('.like-btn[data-id="' + topicId + '"]').css("color", "#888"); // Gri renk
                }
            });
        });

    </script>

@endsection
