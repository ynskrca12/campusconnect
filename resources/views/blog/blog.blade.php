@extends('layouts.master') 

@section('title', $blog->seo_title ?? $blog->title)
@section('meta_description', $blog->seo_description ?? Str::limit(strip_tags($blog->content), 150))
@section('meta_keywords', $blog->meta_keywords ?? 'blog, haber, yazı')

@section('content') 
<section class="section blog-wrap bg-gray">
    <div class="container-fluid">
        <div class="row px-md-5">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-blog-item">
                            <img src="{{ asset( $blog->content_image) }}" loading="lazy" alt="Üniversite Blog Yazısı" class="img-fluid rounded">

                            <div class="blog-item-content bg-white p-md-5">
                                <div class="blog-item-meta bg-gray py-1 px-2">
                                    <span class="text-muted text-capitalize me-3"><i class="fa-solid fa-feather me-2"></i>{{$blog->blogCategory->name}}</span>
                                    <span class="text-black text-capitalize"><i class="fa-regular fa-clock me-2"></i>{{$blog->created_at->format('d M Y')}}</span>
                                </div> 

                                <h2 class="mt-3 mb-4">{{$blog->title}}</h2>
                                 <div class="blog-content">
                                    {!!$blog->content!!}
                                 </div>

                                <div class="tag-option mt-5 clearfix">        

                                    <ul class="float-right list-inline">
                                        <li class="list-inline-item"> Paylaş: </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank">
                                                <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}" target="_blank">
                                                <i class="fab fa-twitter" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar-wrap px-xxl-4">                                    
                    <div class="sidebar-widget latest-post card border-0 px-xxl-4 mb-3">
                        <h5>En Son Bloglar</h5>
                
                        @foreach ($blogs as $item)
                            <div class="media border-bottom py-3">
                                <a href="{{route('blog.single', ['slug' => $item->slug])}}"><img class="mr-4" src="{{ asset($item->cover_image) }}" alt=""></a>
                                <div class="media-body">
                                    <h6 class="my-2"><a href="{{route('blog.single', ['slug' => $item->slug])}}">{{$item->title}}</a></h6>
                                    <span class="text-sm text-muted">{{date('d M Y', strtotime($item->created_at))}}</span>
                                </div>
                            </div>
                        @endforeach
                
                      
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="px-md-0">
                    <h4 class="mb-4 px-5">Yorumlar</h4>
                    <div id="comments-wrapper"></div>
                </div>

                <!-- Yorum Yap Formu -->
                <form class="contact-form bg-white  p-md-5 mt-5 mb-5" id="comment-form" method="POST" action="{{ route('add.blog.comment', ['id' => $blog->id]) }}">
                    @csrf
                    <input type="hidden" name="blog_id" value="{{ $blog->id }}" id="blog_id">
                    <h4 class="mb-4">Yorum Yap</h4>

                    <textarea class="form-control mb-3" name="comment" id="comment" rows="5" placeholder="Yorumunuz..."></textarea>

                    <button class="btn btn-comment px-5 py-2 mt-3" type="submit">Yorum Yap</button>
                </form>
            </div>  
        </div>
    </div>
</section>
@endsection 

@section('css')
    <style>
        /* CKEditor dış kutusu */
    .ck-editor__editable_inline {
        min-height: 200px;
        font-size: 16px;        /* Yazı boyutu */
        line-height: 1.6;       /* Satır aralığı */
        padding: 1rem;
        font-family: 'Arial', sans-serif;
        background-color: #fff;
    }

    /* CKEditor container'ı tam genişlik olsun */
    .ck-editor__editable {
        width: 100%;
    }

    /* CKEditor araç çubuğu (opsiyonel görsel iyileştirme) */
    .ck-toolbar {
        border-radius: 6px 6px 0 0;
        padding: 0.5rem;
    }

    /* CKEditor içerik alanı kenarlık ayarı */
    .ck-editor__editable_inline {
        border: 1px solid #ced4da;
        border-radius: 0 0 6px 6px;
    }

    </style>
    <style>
        /* Blog item */
        .single-blog-item {
            border-radius: 8px;
            overflow: hidden;
        }

        .single-blog-item img {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: contain;
        }

        .blog-item-content p{
            font-size: 16px !important;
        }

        .blog-item-meta {
            font-size: 14px;
            color: #888;
        }

        .blog-item-meta i {
            font-size: 14px;
        }

        h2 a {
            text-decoration: none;
            color: #333;
        }

        h2 a:hover {
            color: #007bff;
        }

        p.lead {
            font-size: 18px;
            color: #555;
        }

        .quote {
            font-size: 18px;
            font-style: italic;
            color: #333;
            margin: 20px 0;
        }

        .btn-comment {
            background-color: #001b48;
            color: #fff;
            border: none;
            border-radius: 10px;
            border: 1px solid #001b48;
        }

        .btn-comment:hover {
            background-color: #fff;
            color: #001b48;
            border: 1px solid #001b48;
        }


        /* Sidebar */
        .sidebar-widget {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            background-color: #fff;
        }

        .sidebar-widget .media {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .sidebar-widget .media img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
        }

        .sidebar-widget .media-body h6 {
            font-size: 16px;
            font-weight: bold;
        }

        .sidebar-widget .media-body span {
            font-size: 14px;
            color: #888;
        }

        /* Responsive için */
        @media (max-width: 992px) {
            .blog-item-content {
                padding: 20px;
            }

            .page-body-wrapper {
                padding: 0;
            }

            .content-wrapper {
                padding: 0;
                margin-top: -10px;
            }
        }

        .media {
            display: flex;
            align-items: center; 
        }

        .media img {
            width: 80px; 
            height: 80px;
            object-fit: cover;
        }

        .media-body {
            margin-left: 15px; 
        }

        .media-body h6 {
            font-size: 16px;
            font-weight: 600;
            color: #222; 
            margin: 0; 
            transition: color 0.3s ease;
        }

        .media-body h6 a {
            text-decoration: none;
            color: inherit;
        }

        .media-body h6 a:hover {
            color: #007bff;
        }

        .media-body .text-sm {
            font-size: 12px;
            color: #777; 
        }


    </style>     

    {{-- mobil --}}
    <style>
        @media (max-width: 768px) {
            .page-title {
                padding: 120px 0;
            }
        }

    </style>
@endsection

@section('js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- CKEditor 5 Classic CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr.js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        function fetchComments() {
            $.ajax({
                url: '{{ route('get.blog.comments', $blog->id) }}',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    let html = '';

                    if (response.comments.length === 0) {
                        html = `<p class="text-muted px-5">Bu blog için yorum henüz yorum yapılmamış.</p>`;
                    } else {

                        response.comments.forEach(function (comment) {
                            html += `
                                <div class="card mb-0 border-0">
                                    <div class="card-body py-4 px-3 px-md-5">
                                        <div class="d-flex align-items-start mb-2">
                                            <img src="${comment.user_image}" 
                                            style="background-color: ${comment.bg_color };"    
                                            class="rounded-circle me-3 user-avatar-component" width="50" height="50" data-userid="${comment.user_id}">
                                            <div>
                                                <h6 class="mb-0">${comment.username}</h6>
                                                <small class="text-muted">${comment.created_at}</small>
                                            </div>
                                        </div>
                                        <p class="mt-3 mb-3">${comment.comment}</p>
                                        <button class="btn btn-comment reply-toggle float-end mt-3 mb-2" data-id="${comment.id}">Yanıtla</button>
                                        <div class="reply-form mt-3 d-none" id="reply-form-${comment.id}">
                                            <textarea class="form-control mb-2 reply-textarea" rows="3" placeholder="Yanıtınız..."></textarea>
                                            <button class="btn btn-comment submit-reply" data-parent="${comment.id}" data-blog="{{ $blog->id }}">Gönder</button>
                                        </div>
                                    </div>
                                </div>
                            `;

                            if (comment.replies.length > 0) {
                                comment.replies.forEach(function (reply) {
                                    html += `
                                        <div class="card ms-5 mb-3 bg-light border-0">
                                            <div class="card-body py-3">
                                                <div class="d-flex align-items-start mb-2">
                                                    <img src="${reply.user_image}" 
                                                    style="background-color: ${reply.bg_color };"    
                                                    class="rounded-circle me-3 user-avatar-component" width="40" height="40" data-userid="${reply.user_id}">
                                                    <div>
                                                        <h6 class="mb-0">${reply.username}</h6>
                                                        <small class="text-muted">${reply.created_at}</small>
                                                        <span class="badge bg-secondary ms-2">Yanıt</span>
                                                    </div>
                                                </div>
                                                <p class="mb-0">${reply.comment}</p>
                                            </div>
                                        </div>
                                    `;
                                });
                            }
                        });
                    }

                    $('#comments-wrapper').html(html);
                }
            });
        }

        // İlk yüklemede çek
        fetchComments();

         // Dinamik olarak eklenen reply-toggle butonlarına event bağla
        $(document).on('click', '.reply-toggle', function () {
            const id = $(this).data('id');
            $('#reply-form-' + id).toggleClass('d-none');
        });
    </script>

    <script>
        let editor;

        ClassicEditor
            .create(document.querySelector('#comment'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'strikethrough', '|',
                        'link', 'bulletedList', 'numberedList', '|',
                        'blockQuote', 'insertTable', 'uploadImage', 'mediaEmbed', '|',
                        'undo', 'redo', '|',
                        'alignment', 'fontColor', 'fontSize', 'fontFamily'
                    ]
                },
                simpleUpload: {
                    uploadUrl: '/upload/image',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            })
            .then(newEditor => {
                editor = newEditor;
            })
            .catch(error => {
                console.error('CKEditor error:', error);
            });

            

        $('#comment-form').on('submit', function (e) {
            e.preventDefault();

            const comment = editor.getData().trim();
            if (comment === '') {
                toastr.error('Lütfen yorumunuzu yazınız.');
                return;
            }

            const formData = {
                comment: comment,
                blog_id: $('#blog_id').val(),
                arent_id: $('#parent_id').val() || null,
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#comment').val('');
                        editor.setData('');
                        fetchComments();
                    } else {
                        toastr.error(response.message || 'Bir hata oluştu.');
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 401) {
                        toastr.error('Madem yorum yapacan niye giriş yapmıyon gardaş');
                    } else if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        for (let key in errors) {
                            toastr.error(errors[key][0]);
                        }
                    } else {
                        toastr.error('Sunucu hatası. Lütfen tekrar deneyin.');
                    }
                }
            });
        });

        $(document).on('click', '.submit-reply', function () {
            const parent_id = $(this).data('parent');
            const blog_id = $(this).data('blog');
            const textarea = $('#reply-form-' + parent_id).find('.reply-textarea');
            const comment = textarea.val();

            if (comment.trim() === '') {
                toastr.error('Yanıt boş olamaz.');
                return;
            }

            $.ajax({
                url: '{{ route('add.blog.comment.reply') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    blog_id: blog_id,
                    parent_id: parent_id,
                    blog_comment: comment
                },
                success: function (response) {
                    textarea.val('');
                    $('#reply-form-' + parent_id).addClass('d-none');
                    
                    fetchComments();
                    toastr.success(response.message);
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            toastr.error(value[0]);
                        });
                    } else if (xhr.status === 401) {
                        toastr.error('Lütfen giriş yapın.');
                    } else {
                        toastr.error('Bir hata oluştu. Lütfen tekrar deneyin.');
                    }
                }
            });
        });

    </script>

@endsection
