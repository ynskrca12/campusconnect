@extends('layouts.master')
@section('content')
    <div class="info-section mb-4">
        <div class="overlay"></div>
        <div class="info-content">
            <h2 class="animated-title display-4">Üniversite hayatına dair  <span style="color: #87ceeb;">her şey burada!</span></h2>
            <p class="animated-text">Üniversite ve şehir hayatını keşfet, yorumları oku, deneyimlerini paylaş.
            </p>
            {{-- <a href="{{ route('forum') }}" class="btn  btn-animated">Keşfetmeye Başla</a> --}}
        </div>
    </div>

    <div class="row mb-5 mt-2">
        <div class="col-md-6 mb-3">
            <div class="card custom-card h-100 d-flex flex-column justify-content-between">
                    <div class="topic">
                        <h3 class="topic-title mb-3">
                            <a href="{{ route('university.topic.comments', ['slug' => $mostLikedTopicUniversity->topic_title_slug]) }}">
                                {{ $mostLikedTopicUniversity->topic_title }}
                            </a>
                        </h3>
                        
                        <p>{!! Str::length($mostLikedTopicUniversity->comment) > 360 ? Str::limit($mostLikedTopicUniversity->comment, 360, '... <a style="color: #001b48;font-size: 13px;font-weight: 700" href="' . route('topic.comments', ['slug' => $mostLikedTopicUniversity->topic_title_slug]) . '">devamını oku</a>') : e($mostLikedTopicUniversity->comment) !!}</p>

                        <div class="university-like-dislike mt-3">
                            <div class="university-like-btn d-inline me-3" data-id="{{ $mostLikedTopicUniversity->id }}" style="cursor: pointer; color: #888;">
                                <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-up"></i> <span class="university-like-count">{{ $mostLikedTopicUniversity->likes }}</span>
                            </div>
                            <div class="university-dislike-btn d-inline" data-id="{{ $mostLikedTopicUniversity->id }}" style="cursor: pointer; color: #888;">
                                <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-down"></i> <span class="university-dislike-count">{{ $mostLikedTopicUniversity->dislikes }}</span>
                            </div>
                            <div class="d-inline ms-3">
                                <a href="{{ route('university.topic.comments', ['slug' => $mostLikedTopicUniversity->topic_title_slug]) }}"
                                    title="Yanıtla"
                                    style="color: #555;">
                                    <i class="fa-solid fa-reply"></i>
                                </a>
                            </div>
                        </div>
                        <div class="meta">
                            <div class="d-flex align-items-center entry-footer-bottom">
                                <div class="footer-info">
                                    <div style="display: block;padding:0px 2px;text-align: end;margin: -5px 0px;">
                                        <p style="display: block;white-space:nowrap;color:#001b48;">{{ $mostLikedTopicUniversity->user->username ?? 'Anonim' }}</p>
                                    </div>

                                    <div style="display: block;padding:1px 2px;line-height: 14px;">
                                        <p style="color: #888;font-size: 12px;">{{ $mostLikedTopicUniversity->created_at->format('d.m.Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="avatar-container">
                                    <a href="">
                                        <img class="avatar" 
                                        style="background-color: {{$mostLikedTopicUniversity->user->user_image == 'man.png' ? '#95bdff' : ($mostLikedTopicUniversity->user->user_image == 'woman.png' ? '#ffbdd3' : 'transparent')}};"
                                        src="{{ asset('assets/images/icons/' . ($mostLikedTopicUniversity->user->user_image ?? '//ekstat.com/img/default-profile-picture-light.svg')) }}"
                                        data-default="{{ asset('img/default-profile-picture-light.svg') }}" 
                                        alt="usuyensolucan" title="usuyensolucan">
                                    </a>
                                </div>
                            </div>                            
                        </div>
                    </div>
            </div>

        </div>
        <div class="col-md-6 mb-3">
            <div class="card custom-card h-100 d-flex flex-column justify-content-between">
                    <div class="topic">
                        <h3 class="topic-title mb-3">
                            <a href="{{ route('topic.comments', ['slug' => $mostLikedTopicGeneral->topic_title_slug]) }}">
                                {{ $mostLikedTopicGeneral->topic_title }}
                            </a>
                        </h3>
                        
                        <p>{!! Str::length($mostLikedTopicGeneral->comment) > 360 ? Str::limit($mostLikedTopicGeneral->comment, 360, '... <a style="color: #001b48;font-size: 13px;font-weight: 700" href="' . route('topic.comments', ['slug' => $mostLikedTopicGeneral->topic_title_slug]) . '">devamını oku</a>') : e($mostLikedTopicGeneral->comment) !!}</p>

                        <div class="like-dislike mt-3">
                            <div class="like-btn d-inline me-3" data-id="{{ $mostLikedTopicGeneral->id }}" style="cursor: pointer; color: #888;">
                                <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-up"></i> <span class="like-count">{{ $mostLikedTopicGeneral->likes }}</span>
                            </div>
                            <div class="dislike-btn d-inline" data-id="{{ $mostLikedTopicGeneral->id }}" style="cursor: pointer; color: #888;">
                                <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-down"></i> <span class="dislike-count">{{ $mostLikedTopicGeneral->dislikes }}</span>
                            </div>
                            <div class="d-inline ms-3">
                                <a href="{{ route('topic.comments', ['slug' => $mostLikedTopicGeneral->topic_title_slug]) }}"
                                    title="Yanıtla"
                                    style="color: #555;">
                                    <i class="fa-solid fa-reply"></i>
                                </a>
                            </div>
                        </div>
                        <div class="meta">
                            <div class="d-flex align-items-center entry-footer-bottom">
                                <div class="footer-info">
                                    <div style="display: block;padding:0px 2px;text-align: end;margin: -5px 0px;">
                                        <p style="display: block;white-space:nowrap;color:#001b48;">{{ $mostLikedTopicGeneral->user->username ?? 'Anonim' }}</p>
                                    </div>

                                    <div style="display: block;padding:1px 2px;line-height: 14px;">
                                        <p style="color: #888;font-size: 12px;">{{ $mostLikedTopicGeneral->created_at->format('d.m.Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="avatar-container">
                                    <a href="">
                                        <img class="avatar" 
                                        style="background-color: {{$mostLikedTopicGeneral->user->user_image == 'man.png' ? '#95bdff' : ($mostLikedTopicGeneral->user->user_image == 'woman.png' ? '#ffbdd3' : 'transparent')}};"
                                        src="{{ asset('assets/images/icons/' . ($mostLikedTopicGeneral->user->user_image ?? '//ekstat.com/img/default-profile-picture-light.svg')) }}"
                                        data-default="{{ asset('img/default-profile-picture-light.svg') }}" 
                                        alt="usuyensolucan" title="usuyensolucan">
                                    </a>
                                </div>
                            </div>                            
                        </div>
                    </div>
            </div>

        </div>
    </div>

    <div class="container my-5">
        <h4 class="text-center mb-4" style="color:#001b48;margin-top: 80px;">Bizi Sosyal Medyadan Takip Edin</h4>
        <div class="row justify-content-center text-center">
            <div class="col-md-4 mb-4">
                <a href="https://mail.google.com/mail/?view=cm&to=info@erapan.com.tr" target="_blank" style="text-decoration: none;">
                    <div class="feature-card p-3 h-100 shadow-sm rounded">
                        <img src="{{ asset('/assets/images/icons/mail-icon.png') }}" class="font-icon mb-2" alt="campusconnect mail" style="width: 40px;">
                        <p class="feature-desc mb-0" style="color:#001b48;">campusconnectiletisim@gmail.com</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="https://x.com/campusconline?t=DCZqePG9GVkGI0o6ukRSog&s=08" target="_blank" style="text-decoration: none;">
                    <div class="feature-card p-3 h-100 shadow-sm rounded">
                        <img src="{{ asset('/assets/images/icons/twitter.png') }}" class="font-icon mb-2" alt="campusconnect twitter" style="width: 40px;">
                        <p class="feature-desc mb-0" style="color:#001b48;">@campusconline</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="https://www.instagram.com/campusconnectonline?utm_source=qr&igsh=M2poMDM1bHJuNmVo" target="_blank" style="text-decoration: none;">
                    <div class="feature-card p-3 h-100 shadow-sm rounded">
                        <img src="{{ asset('/assets/images/icons/instagram.png') }}" class="font-icon mb-2" alt="campusconnect instagram" style="width: 40px;">
                        <p class="feature-desc mb-0" style="color:#001b48;">@campusconnectonline</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    
    <div class="2">       
        <div class="row mb-4 mt-4" style="margin-top: 40px !important;">
          
            <div class="col-12">
                <div class="university-slider">
                    <div class="logos">
                        @foreach (File::glob(public_path('university logos') . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE) as $image)
                            <div class="logo-item">
                                <img src="{{ asset('university logos/' . basename($image)) }}" class="img-fluid" alt="Üniversite Logosu">
                            </div>
                        @endforeach
                        @foreach (File::glob(public_path('university logos') . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE) as $image)
                            <div class="logo-item">
                                <img src="{{ asset('university logos/' . basename($image)) }}" class="img-fluid" alt="Üniversite Logosu">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
       
    </div>
@endsection

@section('css')
<style>
    .custom-card{
        padding: 10px 40px 0px 40px !important;
        margin: 10px 40px 0px 40px !important;
        border-radius: 17px !important;
        /* box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px !important; */
        box-shadow: rgba(0, 0, 0, 0.6) 0px 4px 7px, rgba(0, 0, 0, 0.22) 0px 11px 12px !important
    }
    .feature-card {
         background: #fff;
         backdrop-filter: blur(10px);
         padding: 30px 0px 20px 0px !important;
         margin: 10px;
         transition: transform 0.3s ease, box-shadow 0.3s ease;
         display: flex;
         flex-direction: column;
         height: 100% !important;
         align-items: center;
         border-bottom:1px solid #969696;
         border-radius: 17px !important;
         box-shadow: none !important;
     }
 
    .feature-card:hover {
         transform: translateY(-10px) !important;
         box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3) !important;
    } 
    .feature-desc {
         font-size: 16px;
         color: #333;
         padding:0 21px;
        text-align: center;
        font-weight: 600;
     }
      
     .font-icon {
        width: 15%;
        margin-bottom: 20px;
     }
     @media (max-width: 768px) {
         
 
         .feature-desc{
             text-align: center;
             font-size: 11px;
         }
 
     }

     @media (min-width: 768px) and (max-width: 820px) {
        .feature-desc {
            font-size: 13px;
        }
    }
</style>
<style>
    .avatar{
            display: block;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-top: -2px;
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

        .topic p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }
        .topic .meta {
            display: flex;
            justify-content: end;
        }
</style>
<style>  
    /* .container-scroller, .page-body-wrapper, .content-wrapper {
        background-image: url('{{ asset('home_img/background.jpg') }}');
        background-position: center;
        background-size: cover;
    } */

    .navbar.fixed-top + .page-body-wrapper {
    padding: 63px 0px 0px 0px !important;
}
.content-wrapper {
    padding: 0px !important;
}

</style>

<style>
    .university-slider {
        overflow: hidden;
        position: relative;
        width: 100%;
        background: rgba(255, 255, 255, 0.8);
        padding: 10px;
        border-radius: 10px;
    }
    
    .logos {
        display: flex;
        width: max-content;
        animation: slide 20s linear infinite;
    }
    
    .logo-item {
        flex: 0 0 auto;
        width: 120px;
        margin-right: 20px;
    }
    
    .logo-item img {
        width: 100%;
        max-height: 100px;
        object-fit: contain;
        border-radius: 10px;
    }

    @keyframes slide {
        from { transform: translateX(0); }
        to { transform: translateX(-50%); } 
    }

  
</style>

<style>
     .info-section {
        position: relative;
        width: 100%;
        height: 250px;
        /* background-image: url('https://source.unsplash.com/1600x900/?university,students'); */
        background: linear-gradient(to right, #1e3c72, #2a5298);
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 20px;
        overflow: hidden;
        /* border-radius: 17px; */
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #001b48;
    }

    .info-content {
        position: relative;
        color: #fff;
        z-index: 2;
        max-width: 800px;
        animation: fadeIn 1.5s ease-in-out;
    }

    .info-content h2 {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 15px;
        animation: slideInDown 1s ease-in-out;
    }

    .info-content p {
        font-size: 16px;
        margin-bottom: 20px;
        animation: slideInUp 1s ease-in-out;
    }

    .btn-animated {
        font-size: 18px;
        padding: 10px 20px;
        background: #87ceeb;
        border: none;
        color: #001b48;
        text-decoration: none;
        transition: transform 0.3s ease-in-out, background 0.3s ease-in-out;
    }

    .btn-animated:hover {
        transform: scale(1.1);
        background: #4682b4;
        color: #fff;
    }
    @media (max-width: 768px) {
        .info-content h2 {
            font-size: 18px !important; 
        }
        .info-content p {
            font-size: 14px !important;
        }

        .navbar.fixed-top + .page-body-wrapper {
            padding: 56px 0px 0px 0px !important;
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

 {{-- general like dislike --}}
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

 {{-- university like dislike --}}
   <script>
        $(document).on('click', '.university-like-btn', function () {
            let topicId = $(this).data('id');
            let userId = '{{ auth()->id() }}'; 

            if (!userId) {
                toastr.error('Giriş yapmalısın.');
                return;
            }
            
            let likeCount = $(this).find('.university-like-count');
            let dislikeBtn = $(this).closest('.university-like-dislike').find('.university-dislike-btn');
            let dislikeCount = dislikeBtn.find('.university-dislike-count');

            $.ajax({
                url: `/university/topic/${topicId}/like`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    likeCount.text(response.likes);
                    dislikeCount.text(response.dislikes);
                    
                    $('.university-like-btn[data-id="' + topicId + '"]').css("color", "#007bff"); // Mavi renk
                    $('.university-dislike-btn[data-id="' + topicId + '"]').css("color", "#888"); // Gri renk
                }
            });
        });

        $(document).on('click', '.university-dislike-btn', function () {
            let topicId = $(this).data('id');
            let userId = '{{ auth()->id() }}'; 

            if (!userId) {
                toastr.error('Giriş yapmalısın.');
                return;
            }

            let dislikeCount = $(this).find('.university-dislike-count');
            let likeBtn = $(this).closest('.university-like-dislike').find('.university-like-btn');
            let likeCount = likeBtn.find('.university-like-count');

            $.ajax({
                url: `/university/topic/${topicId}/dislike`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    likeCount.text(response.likes);
                    dislikeCount.text(response.dislikes);

                    $('.university-dislike-btn[data-id="' + topicId + '"]').css("color", "#dc3545"); // Kırmızı renk
                    $('.university-like-btn[data-id="' + topicId + '"]').css("color", "#888"); // Gri renk
                }
            });
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

@endsection