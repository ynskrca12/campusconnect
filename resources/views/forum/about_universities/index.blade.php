@extends('layouts.master') 

@section('content')
    <div class="row mb-3" style="margin-top: -36px;">
        <div class="col-12">
            <!-- Sayfa Başlığı -->
            <h1 class="page-title text-center mb-0">
                {{ $university->universite_ad }}  
            </h1>
        </div>
    </div>


    <div class="row mb-3" style="border-bottom: 1px solid;">
        <div class="col-md-1 d-flex align-items-center mobile-hidden">
            <i class="fa-solid fa-circle-left" style="font-size: 25px; cursor: pointer;" onclick="goBack()"></i>
        </div>
        
        <div class="col-md-11 mb-3">
            <ul class="nav nav-tabs d-flex justify-content-center mobile-hidden" id="mainTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="free-zone-tab" data-bs-toggle="tab" href="#free-zone" role="tab" aria-controls="free-zone" aria-selected="true" data-category="free-zone">serbest bölge</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="general-tab" data-bs-toggle="tab" href="#general-info" role="tab" aria-controls="general-info" aria-selected="true" data-category="general-info">genel bilgiler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="departmant-programs-tab" data-bs-toggle="tab" href="#departmant-programs" role="tab" aria-controls="departmant-programs" aria-selected="false" data-category="departmant-programs">bölüm ve prog.</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="campus-life-tab" data-bs-toggle="tab" href="#campus-life" role="tab" aria-controls="campus-life" aria-selected="false" data-category="campus-life">kampüs hayatı</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="question-answer-tab" data-bs-toggle="tab" href="#question-answer" role="tab" aria-controls="question-answer" aria-selected="false" data-category="question-answer">soru cevap</a>
                </li>
            </ul>

            <div class="d-none mobile-show">
                <div class="d-flex justify-content-center">
                <select class="form-select" id="mobileTabs" aria-label="Default select example" 
                    style="font-size: 13px;width: 70%;">
                    <option value="#free-zone" selected>serbest bölge</option>
                    <option value="#general-info">genel bilgiler</option>
                    <option value="#departmant-programs">bölüm ve programlar</option>
                    <option value="#campus-life">kampüs hayatı</option>
                    <option value="#question-answer">soru cevap</option>
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
                    @foreach($univercity_free_zone_topics_count as $topic)
                        {{-- {{dd($topic->count)}} --}}
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
                            @foreach($univercity_free_zone_topics_count as $topic)
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
            <div class="col-md-7" >
                <div class="tab-content">

                    <div class="tab-pane fade show active" id="free-zone" role="tabpanel" aria-labelledby="free-zone-tab">
                        <div class="d-flex justify-content-end">
                            
                           <div> 
                                <button class="btn btnExplain" data-category="free-zone">
                                    <i class="fa-solid fa-envelope"></i>    
                                </button>
                            </div>
                        </div>        
                        <div id="free-zone-topic-list">
                            @foreach ($univercity_free_zone_topics as $topic)
                                <div class="topic">
                                    <h3 class="topic-title mb-3">
                                        <a href="{{ route('university.topic.comments', ['slug' => $topic->topic_title_slug]) }}" class="text-decoration-none text-dark"> 
                                            {{ $topic->topic_title }}
                                        </a>
                                    </h3>
                                    <p>{!! $topic->comment !!}</p>
                                    <div class="like-dislike mt-3">
                                        <div class="like-btn d-inline me-3" data-id="{{ $topic->id }}" style="cursor: pointer; color: #888;">
                                            <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-up"></i> <span class="like-count">{{ $topic->likes }}</span>
                                        </div>
                                        <div class="dislike-btn d-inline" data-id="{{ $topic->id }}" style="cursor: pointer; color: #888;">
                                            <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-down"></i> <span class="dislike-count">{{ $topic->dislikes }}</span>
                                        </div>
                                    </div>
                                    <div class="meta">
                                        <div class="d-flex align-items-center entry-footer-bottom">
                                            <div class="footer-info">
                                                <div style="display: block;padding: 2px;text-align: end;margin: -5px 0px;">
                                                    <p style="display: block;white-space:nowrap;color:#001b48;">{{ $topic->user->username ?? 'Anonim' }}</p>
                                                </div>
        
                                                <div style="display: block;padding: 2px;line-height: 14px;">
                                                    <p style="color: #888;font-size: 12px;">{{ \Carbon\Carbon::parse($topic->created_at)->format('d.m.Y H:i') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="avatar-container">
                                                <a href="">
                                                    <img class="avatar" src="//ekstat.com/img/default-profile-picture-light.svg" data-default="//ekstat.com/img/default-profile-picture-light.svg" alt="usuyensolucan" title="usuyensolucan">
                                                </a>
                                            </div>
                                        </div>                            
                                    </div>
                                </div>
                            @endforeach   
                        </div>
                    </div>

                    <div class="tab-pane fade " id="general-info" role="tabpanel" aria-labelledby="general-tab">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                {{-- <span class="categoryTitle">genel bilgileri</span> --}}
                            </div>
                           <div> 
                                <button class="btn btnExplain" data-category="general-info">
                                    <i class="fa-solid fa-envelope"></i>
                                </button>
                            </div>
                        </div>        
                        <div id="general-info-topic-list">
                            <!-- İçerik buraya gelecek -->
                        </div>
                    </div>

                    <div class="tab-pane fade" id="departmant-programs" role="tabpanel" aria-labelledby="departmant-programs-tab">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                {{-- <span class="categoryTitle">bölüm ve programlar</span> --}}
                            </div>
                           <div> 
                                <button class="btn btnExplain" data-category="departmant-programs">
                                    <i class="fa-solid fa-envelope"></i>
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
                                    <i class="fa-solid fa-envelope"></i>
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
                                    <i class="fa-solid fa-envelope"></i>
                                </button>
                            </div>
                        </div>        
                        <div id="question-answer-topic-list">
                            <!-- İçerik buraya gelecek -->
                        </div>
                    
                    </div>

                </div>
            </div>

        <!-- Sağ Menü (Reklam Alanı) -->
        <div class="col-md-2">
            <div class="advertisement">
                {{-- <p>Reklam Alanı</p> --}}
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
                <button type="submit" class="btn btn-primary">Kaydet</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      
  
@endsection 

@section('css')
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
            width: 16%;
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
    </style>

    <style>
        .page-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
        }
        .topic h3 a{
            margin: 0;
            font-size: 17px;
            color: #333 !important;
            text-decoration: none;
        }
        .topic h3 a:hover{
            color: #424242 !important; 
            text-decoration: underline; 
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
            $(".nav-link").on("click", function () {
                const category = $(this).data("category"); 
                const subcategoriesList = $("#subcategories-list"); 
                const univercityId = @json($university->id);

                const topicListContainer = $("#" + category + "-topic-list");

                if (topicListContainer.length === 0) {
                    console.error("Hedef container bulunamadı.");
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
                        if (response.topics && response.topics.length > 0) {
                            let newContent = "";
                            
                            response.topics.forEach(topic => {
                                newContent += `
                                    <div class="topic">
                                        <h3 class="topic-title mb-3">
                                            <a href="/forum/universite/mevzu/${topic.topic_title_slug}">
                                                ${topic.topic_title}
                                            </a>
                                        </h3>
                                        <p>${topic.comment}</p>
                                        <div class="like-dislike mt-3">
                                            <div class="like-btn d-inline me-3" data-id="${topic.id}" style="cursor: pointer; color: #888;">
                                                <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-up"></i> <span class="like-count">${topic.likes}</span>
                                            </div>
                                            <div class="dislike-btn d-inline" data-id="${topic.id}" style="cursor: pointer; color: #888;">
                                                <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-down"></i> <span class="dislike-count">${topic.dislikes}</span>
                                            </div>
                                        </div>
                                        <div class="meta">
                                            <div class="d-flex align-items-center entry-footer-bottom">
                                                <div class="footer-info">
                                                    <div style="display: block;padding: 2px;text-align: end;margin: -5px 0px;">
                                                        <p style="display: block;white-space:nowrap;color:#001b48;">${topic.username || "Anonim"}</p>
                                                    </div>
                                                    <div style="display: block;padding: 2px;line-height: 14px;">
                                                        <p style="color: #888;font-size: 12px;">${moment(topic.created_at).format("DD.MM.YYYY HH:mm")}</p>
                                                    </div>
                                                </div>
                                                <div class="avatar-container">
                                                    <a href="">
                                                        <img class="avatar" src="//ekstat.com/img/default-profile-picture-light.svg" alt="User Avatar">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                            });

                            topicListContainer.html(newContent); // Yeni içerikleri ekle
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
                        if (response.topics && response.topics.length > 0) {
                            let newContent = "";

                            response.topics.forEach(topic => {
                                newContent += `
                                    <div class="topic">
                                        <h3 class="topic-title mb-3">
                                            <a href="/forum/universite/mevzu/${topic.topic_title_slug}">
                                                ${topic.topic_title}
                                            </a>
                                        </h3>
                                        <p>${topic.comment}</p>
                                        <div class="like-dislike mt-3">
                                            <div class="like-btn d-inline me-3" data-id="${topic.id}" style="cursor: pointer; color: #888;">
                                                <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-up"></i> <span class="like-count">${topic.likes}</span>
                                            </div>
                                            <div class="dislike-btn d-inline" data-id="${topic.id}" style="cursor: pointer; color: #888;">
                                                <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-down"></i> <span class="dislike-count">${topic.dislikes}</span>
                                            </div>
                                        </div>
                                        <div class="meta">
                                            <div class="d-flex align-items-center entry-footer-bottom">
                                                <div class="footer-info">
                                                    <div style="display: block;padding: 2px;text-align: end;margin: -5px 0px;">
                                                        <p style="display: block;white-space:nowrap;color:#001b48;">${topic.username || "Anonim"}</p>
                                                    </div>
                                                    <div style="display: block;padding: 2px;line-height: 14px;">
                                                        <p style="color: #888;font-size: 12px;">${moment(topic.created_at).format("DD.MM.YYYY HH:mm")}</p>
                                                    </div>
                                                </div>
                                                <div class="avatar-container">
                                                    <a href="">
                                                        <img class="avatar" src="//ekstat.com/img/default-profile-picture-light.svg" alt="User Avatar">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                            });

                            topicListContainer.html(newContent); // Yeni içerikleri ekle
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
            console.log('topics' + topicId);
            let userId = '{{ auth()->id() }}'; 

            if (!userId) {
                toastr.error('giriş yapmamışsın hemşerim');
                return; 
            }
            
            let likeCount = $(this).find('.like-count');

            $.ajax({
                url: `/university/topic/${topicId}/like`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    likeCount.text(response.likes);
                }
            });
        });

        $(document).on('click', '.dislike-btn', function () {
            let topicId = $(this).data('id');
            let userId = '{{ auth()->id() }}'; 

            if (!userId) {
                toastr.error('giriş yapmamışsın hemşerim');
                return; 
            }

            let dislikeCount = $(this).find('.dislike-count');

            $.ajax({
                url: `/university/topic/${topicId}/dislike`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    dislikeCount.text(response.dislikes);
                }
            });
        });

    </script>

@endsection
