@extends('layouts.master') 

@section('content')

    <div class="row">
        <!-- Sol Menü (Alt Başlıklar) -->
        <div class="col-md-3">
            <div class="mobile-hidden">
                <h4 class="sidebarTitle">popüler mevzular</h4>
                <ul id="subcategories-list" class="list-group"></ul>
            </div>    
        </div>

        <!-- Ana İçerik Alanı -->
        <div class="col-md-7 position-relative main-content">

            <!-- Genel Tartışma Alanı İçerikleri -->
            <div id="general-content" class="content-area">
                <h3 class="topic-title mb-3">{{ $topicTitle }}</h3>
                
                <div id="topic-list">
                    @foreach ($comments as $comment)
                        <div class="topic mb-3">
                            <p>{!! $comment['comment'] !!}</p>
                            <div class="like-dislike mt-3">
                                <div class="like-btn d-inline me-3" data-id="{{ $comment['id'] }}" style="cursor: pointer; color: #888;">
                                    <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-up"></i> <span class="like-count">{{ $comment['likes'] }}</span>
                                </div>
                                <div class="dislike-btn d-inline" data-id="{{ $comment['id'] }}" style="cursor: pointer; color: #888;">
                                    <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-down"></i> <span class="dislike-count">{{ $comment['dislikes'] }}</span>
                                </div>
                            </div>
                            <div class="meta">
                                <div class="d-flex align-items-center entry-footer-bottom">
                                    <div class="footer-info">
                                        <div style="display: block;padding: 2px;text-align: end;margin: -5px 0px;">
                                            <p style="display: block;white-space:nowrap;color:#001b48;">{{ \App\Models\User::where('id',$comment['user_id'])->value('username') ?? 'Anonim'}}</p>
                                        </div>

                                        <div style="display: block;padding: 2px;line-height: 14px;">
                                            <p style="color: #888;font-size: 12px;">{{ \Carbon\Carbon::parse($comment['created_at'])->format('d.m.Y H:i') }}</p>
                                        </div>
                                    </div>
                                    <div class="avatar-container">
                                        <x-user-avatar :user="$comment->user" />
                                    </div>
                                </div>                            
                            </div>
                        </div>
                    @endforeach   
                </div>

                     <!-- Yorum Alanı -->
                    <div class="col-md-12">
                        <form id="commentForm" action="{{ route('add.university.topic.comment') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <textarea name="comment" id="editor" placeholder="Yorumunuzu buraya yazın..."></textarea>
                            </div>
                            <input type="hidden" name="topic_title_slug" value="{{ $topicTitleSlug }}">
                            <input type="hidden" name="topic_title" value="{{ $topicTitle }}">
                            <input type="hidden" name="university_id" value="{{ $university_id }}">
                            <input type="hidden" name="comment_category" value="{{ $comment_category }}">
                            <button type="submit" class="btn btn-primary">Yorum Yap</button>
                        </form>
                    </div>
                
                <div class="pagination-container" style="position: absolute; bottom: 0; left: 0; width: 100%; text-align: center;">
                    {{ $comments->links('pagination::bootstrap-4') }}
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
  
@endsection 

@section('css')
    <style>
  
        .avatar{
            display: block;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-top: 2px;
            margin-bottom: 2px;
            object-fit: cover;
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
            word-wrap: break-word; /* Eski tarayıcı desteği için */
            overflow-wrap: break-word; /* Yeni standart */
            white-space: pre-wrap;
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
        #subcategories-list .list-group-item, #subcategories-list-mobile .list-group-item{
            border:none !important;
            padding: 7px 0px;
            border-radius: 6px;
            cursor: pointer;
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
        .subCategoryTag{
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
            /* padding-right: 130px; */
            font-size: 20px !important;
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

    {{-- pagination --}}
    <style>
        .pagination {
            justify-content: center;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination .page-link {
            color: #007bff;
            text-decoration: none;
            padding:5px 10px !important;
            border-radius: 50%;
        }

        .pagination .page-link:hover {
            background-color: #f8f9fa;
        }

        .page-item:first-child .page-link{
            border-top-left-radius: 50%;
            border-bottom-left-radius: 50%;
        }

        .page-item:last-child .page-link {
            border-top-right-radius: 50%;
            border-bottom-right-radius: 50%;
        }

    </style>

    <style>
        /* Editörün iç alanı için kenar çizgisi kaldırma */
        .ck-editor__editable_inline {
            height: 300px !important; /* Sabit yükseklik */
        }
        .main-content{
            border-left: 1px solid #e0e0e0;
        }
       
        @media (max-width: 768px) {
            .mobile-show {
                display: block !important;
            }
            .mobile-hidden {
                display: none !important;
            }
            .main-content{
                border-left: none !important;
            }        
            .content-area {
                padding: 0px 10px;
            }
        }
    </style>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                // Ek ayarlar
                height: '300px', 
            })
            .then(editor => {
                const editorElement = editor.ui.getEditableElement();

                // Yüksekliği ve kenarlığı sabit tutma
                const fixHeight = () => {
                    editorElement.style.height = '300px';
                };

                // İlk yüklemede yüksekliği ayarla
                fixHeight();

                // Kullanıcı editöre tıkladığında
                editor.ui.view.editable.element.addEventListener('focus', fixHeight);

                // Kullanıcı içerik düzenlediğinde
                editor.model.document.on('change:data', fixHeight);
            })
            .catch(error => {
                console.error(error);
            });
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
    
    {{-- siderbar change --}}
    <script>
        $(document).ready(function () {            
            const universitySubcategories = @json($universities_topics);          
           
            $("#subcategories-list").empty();
            $("#subcategories-list-mobile").empty();
            universitySubcategories.forEach(function (item) {
                const universitySubCategoriesCount = item.count || 0;                    
                
                $("#subcategories-list").append(
                `<li class="list-group-item mb-1">
                        <a href="/universite-yorumlari/konu/${item.topic_title_slug}" 
                            class="text-decoration-none subCategoryTag d-flex justify-content-between">
                            <span class="topic-title-sub-category">${item.topic_title}</span>
                            <span class="count">${universitySubCategoriesCount}</span>
                        </a>
                    </li>`
                );

                $("#subcategories-list-mobile").append(
                `<li class="list-group-item mb-1">
                        <a href="/universite-yorumlari/konu/${item.topic_title_slug}" class="text-decoration-none subCategoryTag d-flex justify-content-between">
                            <span class="topic-title-sub-category">${item.topic_title}</span>
                            <span class="count">${universitySubCategoriesCount}</span>
                        </a>
                    </li>`
                );                 
            });
        });
    </script>
    
    {{-- add new comment --}}
    <script>
        $(document).ready(function () {
            $("#commentForm").on('submit', function (e) {
                e.preventDefault();

                let commentData = $(this).serialize();

                $.ajax({
                    url: '{{ route('add.university.topic.comment') }}',
                    method: 'POST',
                    data: commentData,
                    success: function (response) {
                        toastr.success(response.message); 
                        setTimeout(function() {
                            location.reload(); 
                        }, 1000); // Wait 1 second
                    },
                    error: function (xhr) {
                        if (xhr.status === 401) {
                            toastr.error('Lütfen giriş yapınız.');
                        } else if (xhr.status === 422 && xhr.responseJSON?.error) {
                            toastr.error('En az 2 karakter yaz bence');
                        } else {
                            toastr.error('Bir hata oluştu. Lütfen tekrar deneyin.');
                        }
                    }
                });
            });
        });

    </script>
@endsection
