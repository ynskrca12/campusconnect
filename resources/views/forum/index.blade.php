@extends('layouts.master') 

@section('content')

    <div class="row mt-5">
        <!-- Sol Menü (Alt Başlıklar) -->
        <div class="col-md-3">
            <div class="mobile-hidden">
                <h4 class="sidebarTitle">öne çıkan mevzular</h4>
                <ul id="subcategories-list" class="list-group"></ul>
            </div>
            
            <div class="mobile-show d-none mb-4">
                <a class="btn btn-primary w-100" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                    <i class="bi bi-chat-dots me-2"></i> öne çıkan mevzular
                </a>           

                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">öne çıkan mevzular</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                        <div class="offcanvas-body">
                            
                        <ul id="subcategories-list-mobile" class="list-group" ></ul>
            
                        <div id="pagination-container" class="pagination-container mt-3">
                    
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- Ana İçerik Alanı -->
        <div class="col-md-9 main-content">
            <!-- Forum Başlıkları -->
            <div class="d-flex justify-content-between mb-5 px-3">
                <div>
                    <button id="general-tab" class="btn me-2 activeCategory general-topic-btn">tartışalım</button>
                </div>
                <div>
                    <button class="btn btnCreateGeneral">gündem oluştur</button>
                </div>
            </div>

            <!-- Genel Tartışma Alanı İçerikleri -->
            <div id="general-content" class="content-area">
                {{-- <div class="d-flex justify-content-end">
                    <i class="fa-solid fa-rotate mb-4" id="refresh-icon" style="cursor: pointer;" 
                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Yenile"></i>
                </div> --}}
                <div id="topic-list">
                    @foreach ($randomTopics as $topic)
                         <x-topic-box :topic="$topic" />
                    @endforeach   
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
        #subcategories-list .list-group-item{
            border:none !important;
            padding: 7px 0px;
        }
        #subcategories-list .list-group-item:hover{
            border-bottom:1px solid !important;
        }
        .btnCreateGeneral:hover  {
            border-bottom: 1px groove #000000 !important;
            border-radius: 0px !important;
        }
        .content-title{
            font-size: 20px;
            font-weight: 600;
        }
        .content-area {
            padding: 0px 10px;
            
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
        @media (max-width: 768px) {
            .mobile-show {
                display: block !important;
            }
            .mobile-hidden {
                display: none !important;
            }
            .topic-title{
                padding-right: 0px !important;
            }
            .main-content{
                border-left: none !important;
            }
            .content-area {
                padding: 0px 10px;
            }
        }

        #subcategories-list .list-group-item, #subcategories-list-mobile .list-group-item{
            border:none !important;
            padding: 7px 0px;
            border-radius: 6px;
            cursor: pointer;
        }
        .main-content{
            border-left: 1px solid #e0e0e0;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    {{-- like dislike --}}
    <script>
        $(document).on('click', '.like-btn', function () {
            let topicId = $(this).data('id');
            let userId = '{{ auth()->id() }}'; 

            if (!userId) {
                toastr.error('giriş yapmamışsın hemşerim');
                return; 
            }
            
            let likeBtn = $(this);
            let dislikeBtn = likeBtn.siblings('.dislike-btn');
            let likeCount = likeBtn.find('.like-count');
            let dislikeCount = dislikeBtn.find('.dislike-count');

            $.ajax({
                url: `/general/topic/${topicId}/like`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    likeCount.text(response.likes);
                    dislikeCount.text(response.dislikes);

                    if (response.liked) {
                        likeBtn.css('color', '#007bff');
                        dislikeBtn.css('color', '#888'); 
                    } else {
                        likeBtn.css('color', '#888');
                    }
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

            let dislikeBtn = $(this);
            let likeBtn = dislikeBtn.siblings('.like-btn');
            let dislikeCount = dislikeBtn.find('.dislike-count');
            let likeCount = likeBtn.find('.like-count');

            $.ajax({
                url: `/general/topic/${topicId}/dislike`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    dislikeCount.text(response.dislikes);
                    likeCount.text(response.likes);

                    if (response.disliked) {
                        dislikeBtn.css('color', '#ff0000');
                        likeBtn.css('color', '#888');
                    } else {
                        dislikeBtn.css('color', '#888'); 
                    }
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
          
            function loadSubcategories(subcategories, type = 'general') {
                $("#subcategories-list").empty();
                subcategories.forEach(function (item) {

                    const generalSubCategoriesCount = item.count || 0;

                        // general topics
                        $("#subcategories-list").append(
                        `<li class="list-group-item mb-1">
                                <a href="/forum/mevzu/${item.topic_title_slug}" class="text-decoration-none subCategoryTag d-flex justify-content-between">
                                    <span class="topic-title-sub-category">${item.topic_title}</span>
                                    <span class="count">${generalSubCategoriesCount}</span>
                                </a>
                            </li>`
                        ); 

                        $("#subcategories-list-mobile").append(
                        `<li class="list-group-item mb-1">
                                <a href="/forum/mevzu/${item.topic_title_slug}" class="text-decoration-none subCategoryTag d-flex justify-content-between">
                                    <span class="topic-title-sub-category">${item.topic_title}</span>
                                    <span class="count">${generalSubCategoriesCount}</span>
                                </a>
                            </li>`
                        );                    
                });
            }
            
            loadSubcategories(generalSubcategories);
            $("#general-tab").addClass("activeCategory");
        });
    </script>
    
    {{-- add new topic --}}
    <script>
        var isAuthenticated = @json(auth()->check());

        $(document).ready(function() {
            $('.btnCreateGeneral').on('click', function(e) {
                e.preventDefault(); 

                if (!isAuthenticated) {
                    Swal.fire({
                        title: 'önce bi giriş mi yapsan...',
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
                                    _token: "{{ csrf_token() }}",
                                    title: data.title,
                                    content: data.content,
                                },
                                success: (response) => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Gündem oluşturuldu!',
                                        text: 'Gündem başarıyla oluşturuldu.',
                                    }).then(() => {
                                            sessionStorage.setItem('toastrMessage', 'Konu başarıyla gönderildi!');

                                        
                                            setTimeout(function () {
                                                location.reload();
                                            }, 500);
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

        const toastrMessage = sessionStorage.getItem('toastrMessage');
                if (toastrMessage) {
                    toastr.success(toastrMessage);
                    sessionStorage.removeItem('toastrMessage'); 
                }

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

    {{-- get random topics with ajax --}}
    <script>
        $(document).on('click', '#refresh-icon', function () {
            $(this).addClass('fa-spin');
    
            $.ajax({
                url: '{{ route("topics.random") }}',
                method: 'GET',
                success: function (response) {
                    if (response.success) {
                        $('#topic-list').html(response.html);
                    } else {
                        $('#topic-list').html('<p class="text-danger">Veri getirilemedi.</p>');
                    }
    
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
