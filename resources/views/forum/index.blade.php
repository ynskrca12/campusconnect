@extends('layouts.master') 

@section('content')

    <div class="row" style="margin-top: -25px;">
        <!-- Sol Menü (Alt Başlıklar) -->
        <div class="col-md-3">
            <h4 class="sidebarTitle">popüler mevzular</h4>
            <ul id="subcategories-list" class="list-group">
                
            </ul>
        </div>

        <!-- Ana İçerik Alanı -->
        <div class="col-md-7" style="border-left: 1px solid #e0e0e0;">
            <!-- Forum Başlıkları -->
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <button id="general-tab" class="btn me-2 activeCategory general-topic-btn">tartışalım</button>
                    <button id="cities-tab" class="btn me-2 general-topic-btn">şehirler hk.</button>
                </div>
                <div>
                    <button class="btn btnCreateGeneral">gündem oluştur</button>
                </div>
            </div>

            <!-- Genel Tartışma Alanı İçerikleri -->
            <div id="general-content" class="content-area">
                <div class="d-flex justify-content-end">
                    <i class="fa-solid fa-rotate" id="refresh-icon" style="cursor: pointer;" 
                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Yenile"></i>
                </div>
                <div id="topic-list">
                    @foreach ($randomTopics as $topic)
                        <div class="topic">
                            <h3 class="topic-title mb-3">{{ $topic->topic_title }}</h3>
                            <p>{{ $topic->comment }}</p>
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
                                            <p style="color: #888;font-size: 12px;">{{ $topic->created_at->format('d.m.Y H:i') }}</p>
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

            <div id="cities-content" class="content-area d-none">
                <div class="d-flex justify-content-between mb-5">
                    <span class="content-title">şehir hayatı</span>
                </div>
            </div>

        </div>

        <!-- Sağ Menü (Reklam Alanı) -->
        <div class="col-md-2">
            <div class="advertisement">
               
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
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

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
                url: `/general/topic/${topicId}/like`,
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
                url: `/general/topic/${topicId}/dislike`,
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
    
    {{-- siderbar change --}}
    <script>
        $(document).ready(function () {
            // general subcategories
            const generalSubcategories = @json($general_topics);
             
            //universities
            const universitiesSubcategories = @json($universities);

            // cities
            const citiesSubcategories = @json($cities);

            const universitiesTopicsCount = @json($universities_topics_count);
            const citiesTopicsCount = @json($cities_topics_count);

            function loadSubcategories(subcategories, type = 'general') {
                $("#subcategories-list").empty();
                subcategories.forEach(function (item) {

                    const generalSubCategoriesCount = item.count || 0;

                    if (type === 'university') {

                         const topicCount = universitiesTopicsCount[item.id] || 0;

                        $("#subcategories-list").append(
                            `<li class="list-group-item universityLi">
                                <a href="/forum/universite/${item.slug}" class="text-decoration-none universityTag d-flex justify-content-between">
                                    <span class="topic-title-sub-category">${item.universite_ad}</span>
                                    <span class="count">${topicCount}</span>
                                    </a>
                            </li>`
                        );
                    } else if (type === 'city') {
                       
                        const topicCount = citiesTopicsCount[item.id] || 0;

                        $("#subcategories-list").append(
                            `<li class="list-group-item cityLi">
                                <a href="/forum/sehir/${item.slug}" class="text-decoration-none cityTag d-flex justify-content-between">
                                    <span class="topic-title-sub-category">${item.title}</span>
                                    <span class="count">${topicCount}</span>
                                </a>
                            </li>`
                        );
                    } else {
                        // general topics
                        $("#subcategories-list").append(
                        `<li class="list-group-item mb-1">
                                <a href="/forum/mevzu/${item.topic_title_slug}" class="text-decoration-none subCategoryTag d-flex justify-content-between">
                                    <span class="topic-title-sub-category">${item.topic_title}</span>
                                    <span class="count">${generalSubCategoriesCount}</span>
                                </a>
                            </li>`
                        );
                    }
                });
            }

            // Tab butonları
            $("#general-tab").on("click", function () {
                $("#general-tab").addClass("activeCategory");
                $("#cities-tab").removeClass("activeCategory");
                
                $("#general-content").removeClass("d-none");
                $("#universities-content, #cities-content",).addClass("d-none");

                $('.btnCreateGeneral').removeClass('d-none');
                $('.sidebarTitle').text('popüler mevzular');

                loadSubcategories(generalSubcategories);
            });

           

            $("#cities-tab").on("click", function () {
                $("#cities-tab").addClass("activeCategory");
                $("#general-tab").removeClass("activeCategory");
                
                $("#cities-content").removeClass("d-none");
                $("#general-content, #universities-content").addClass("d-none");
                $('.sidebarTitle').text('şehirler');

                $('.btnCreateGeneral').addClass('d-none');
                loadSubcategories(citiesSubcategories, 'city');
            });

            // Başlangıç olarak genel tartışma alt başlıklarını yükle
            loadSubcategories(generalSubcategories);
            $("#general-tab").addClass("activeCategory");
        });
    </script>
    
    {{-- add new topic --}}
    <script>
        // Laravel'den gelen oturum bilgisi
        var isAuthenticated = @json(auth()->check());

        $(document).ready(function() {
        // Gündem oluştur butonlarına tıklama olayını dinle
            $('.btnCreateGeneral, .btnCreateUniversity, .btnCreateCity').on('click', function(e) {
                e.preventDefault(); // Butonun varsayılan davranışını engelle

                // Eğer kullanıcı giriş yapmamışsa (isAuthenticated false ise)
                if (!isAuthenticated) {
                    Swal.fire({
                        title: 'önce bi giriş mi yapsan...',
                        // text: 'Gündem oluşturmak istiyorsan, önce giriş yapmalısın.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'giriş yap',
                        cancelButtonText: 'kapet',
                        reverseButtons: true,
                        customClass: {
                            popup: 'swal-custom-popup' 
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('login') }}"; 
                        }
                    });
                } else {
                    // Kullanıcı giriş yapmışsa SweetAlert popup aç
                    Swal.fire({
                        title: 'mevzu nedir ',
                        html: `
                            <form id="createAgendaForm">
                                <div class="form-group">
                                    <input type="text" id="title" name="title" class="form-control" 
                                        placeholder="başlık" maxlength="80" 
                                        style="border: none;border-bottom: 1px solid #ced4da;border-radius: 0px;">
                                    <small id="charCount" class="form-text text-muted">
                                        0/80 karakter
                                    </small>
                                </div>
                                <div class="form-group mt-3">
                                    <textarea id="content" name="content" class="form-control" 
                                            rows="4" placeholder="açıklamanız"></textarea>
                                </div>
                            </form>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'postala',
                        cancelButtonText: 'kapet',
                        reverseButtons: true,
                        preConfirm: () => {
                            // Form verilerini al
                            const title = $('#title').val();
                            const content = $('#content').val();

                            if (!title || !content) {
                                Swal.showValidationMessage('sadece 2 tane kutu var , doldurur musun lütfen');
                                return false;
                            }

                            if (title.length > 80) {
                                Swal.showValidationMessage('Başlık en fazla 80 karakter olabilir.');
                                return false;
                            }
                            return { title, content };
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const data = result.value;
                            
                            // send form datas with AJAX
                            $.ajax({
                                url: "{{ route('create.topic.general.forum') }}",
                                type: 'POST',
                                data: {
                                    _token: "{{ csrf_token() }}", // CSRF token
                                    title: data.title,
                                    content: data.content,
                                },
                                success: (response) => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Gündem oluşturuldu!',
                                        text: 'Gündem başarıyla oluşturuldu.',
                                    }).then(() => {
                                        location.reload(); // Sayfayı yenile
                                    });
                                },
                                error: (error) => {
                                    if (error.status === 400 && error.responseJSON.message === 'Bu başlık altında zaten bir konu oluşturmuşsunuz.') {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Hata!',
                                            text: 'Bu mevzuyu daha önce konuşmuşuz, bence onun altına yaz düşüncelerini.',
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Hata!',
                                            text: 'Bir şeyler ters gitti, var bi fırıldak. Tekrar dene bakalım',
                                        });
                                    }
                                },
                            });
                        }
                    });
                }
            });
        });

        $(document).on('input', '#title', function() {
            const length = $(this).val().length;
            $('#charCount').text(`${length}/80 karakter`);
        });
    </script>

    {{-- get random topics with ajax --}}
    <script>
        $(document).on('click', '#refresh-icon', function () {
            // İkon dönerken bir loading efekti göstermek isterseniz
            $(this).addClass('fa-spin');
    
            $.ajax({
                url: '{{ route("topics.random") }}',
                method: 'GET',
                success: function (response) {
                    let content = '';
                    response.data.forEach(topic => {
                        content += `
                            <div class="topic">
                                <h3 class="topic-title mb-3">${topic.topic_title}</h3>
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
                                                <p style="display: block;white-space:nowrap;color:#001b48;">
                                                    ${topic.user ? topic.user.username : 'Anonim'}
                                                </p>
                                            </div>
                                            <div style="display: block;padding: 2px;line-height: 14px;">
                                                <p style="color: #888;font-size: 12px;">
                                                    ${new Date(topic.created_at).toLocaleString('tr-TR')}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="avatar-container">
                                            <a href="">
                                                <img class="avatar" src="//ekstat.com/img/default-profile-picture-light.svg" 
                                                    alt="${topic.user ? topic.user.username : 'Anonim'}" 
                                                    title="${topic.user ? topic.user.username : 'Anonim'}">
                                            </a>
                                        </div>
                                    </div>                            
                                </div>
                            </div>
                        `;
                    });
    
                    $('#topic-list').html(content);
    
                    $('#refresh-icon').removeClass('fa-spin');
                },
                error: function () {
                    alert('Bir hata oluştu. Lütfen tekrar deneyin.');
                    $('#refresh-icon').removeClass('fa-spin');
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

    </script>
    
@endsection
