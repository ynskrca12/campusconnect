@extends('layouts.master')
@section('content')

    <div class="hero-section mb-5">
        <div class="container">
            <h1 class="hero-title">Üniversiteni Bul, Deneyimini Paylaş</h1>
            
            {{-- Direkt Arama --}}
            <div class="hero-search-wrapper position-relative">
                <input type="text" id="hero-search" 
                    class="hero-search-input" 
                    placeholder="🔍 Üniversiteni ara ve hemen yorum yap..."
                    autocomplete="off">
                <div id="hero-search-dropdown" class="hero-search-dropdown"></div>
            </div>
            
            {{-- Hızlı Erişim Butonları --}}
            <div class="quick-access-tags mt-4">
                <span class="me-2 text-dark fw-bold">Popüler:</span>
                @foreach($topUniversities as $uni)
                    <a href="/universite-yorumlari/{{$uni->slug}}" 
                    class="quick-tag">{{Str::limit($uni->universite_ad, 25)}}</a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row my-5">
        <div class="col-12">
            <div class="university-slider-wrapper">
                <div class="university-slider">
                    <div class="logos">
                        @foreach (File::glob(public_path('university logos') . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE) as $image)
                            <div class="logo-item">
                                <img src="{{ asset('/university logos/' . basename($image)) }}" class="img-fluid"
                                    alt="Üniversite Logosu">
                            </div>
                        @endforeach
                        @foreach (File::glob(public_path('university logos') . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE) as $image)
                            <div class="logo-item">
                                <img src="{{ asset('/university logos/' . basename($image)) }}" class="img-fluid"
                                    alt="Üniversite Logosu">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5 mt-2">
        <h1 class="topic-title mb-4 h4 text-center">Son Paylaşılan Üniversite Yorumları</h1>
        <div id="university-topics-container" class="row justify-content-center">
            @foreach ($latestUniversityTopics as $topic)
                <div class="col-md-6 mb-3">
                    <div class="h-100 d-flex flex-column justify-content-between">
                        <x-topic-box :topic="$topic" routeName="university.topic.comments" type="university"
                            isHome="true" />
                    </div>
                </div>
            @endforeach
        </div>


        <div class="text-center">
            <button id="load-more-university-topics" class="btn custom-btn px-3" data-offset="10">Daha Fazlasını
                Gör</button>
        </div>
    </div>

     <section class="mb-5">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('/assets/images/home-img.jpg') }}" alt="Üniversite Platformu" class="img-fluid rounded">
                </div>
                <div class="col-lg-6">
                    <div class="row d-flex justify-content-center">
                        <h3 class="fw-bold " style="color: #001b48;">Türkiye'nin En Kapsamlı Üniversite Platformu</h3>
                        <p class="lead mt-3 mb-4 ">
                            Öğrenciler ne düşünüyor? Üniversite yorumları, kampüs yaşamı, bölümler, yurtlar, sosyal hayat ve
                            daha fazlası bu sayfada.
                        </p>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Tüm üniversiteler
                                ve bölümler tek çatı altında</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Öğrencilerden
                                gerçek yorumlar ve deneyimler</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Kampüs ve şehir
                                yaşamı hakkında bilgiler</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Topluluk desteği ve
                                etkileşimli içerikler</li>
                        </ul>
                        <a href="{{ route('universities') }}" class="btn px-4 py-2 rounded-pill"
                            style="background-color: #001b48; color: #fff;">
                            Üniversiteleri Keşfet
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="row mb-5 mt-2">
        <h3 class="topic-title mb-4">Son bloglar</h3>
        @if (!empty($blogs))
            @foreach ($blogs as $blog)
                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="blog-item h-100 d-flex flex-column">
                        <a href="{{ route('blog.single', ['slug' => $blog->slug]) }}">
                            <img src="{{ asset($blog->cover_image) }}" loading="lazy" alt="blog yazısı" class="img-fluid">
                        </a>

                        <div class="blog-item-content px-5 px-md-4 py-4">
                            <div class="blog-item-meta  py-1 px-2">
                                <span class="text-muted text-capitalize mr-3"><i class="fa-solid fa-feather me-2"></i>
                                    {{ $blog->blogCategory->name }}</span>
                            </div>

                            <h3 class="mt-3 mb-3"><a
                                    href="{{ route('blog.single', ['slug' => $blog->slug]) }}">{{ $blog->title }}</a></h3>
                            <p class="mb-4 mt-1 fs-6">{{ $blog->summary }}</p>

                            <a href="{{ route('blog.single', ['slug' => $blog->slug]) }}"
                                class="btn btn-small btn-main btn-round-full px-4">Daha Fazla</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="my-5">
        <h4 class="text-center mb-4" style="color:#001b48;margin-top: 80px;">Bizi Sosyal Medyadan Takip Edin</h4>
        <div class="row justify-content-center text-center">
            <div class="col-md-4 mb-4">
                <a href="https://mail.google.com/mail/?view=cm&to=campusconnectiletisim@gmail.com.tr" target="_blank"
                    style="text-decoration: none;">
                    <div class="feature-card p-3 h-100 shadow-sm rounded">
                        <img src="{{ asset('/assets/images/icons/mail-icon.png') }}" class="font-icon mb-2"
                            alt="campusconnect mail" style="width: 40px;">
                        <p class="feature-desc mb-0" style="color:#001b48;">campusconnectiletisim@gmail.com</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="https://x.com/campusconline?t=DCZqePG9GVkGI0o6ukRSog&s=08" target="_blank"
                    style="text-decoration: none;">
                    <div class="feature-card p-3 h-100 shadow-sm rounded">
                        <img src="{{ asset('/assets/images/icons/twitter.png') }}" class="font-icon mb-2"
                            alt="campusconnect twitter" style="width: 40px;">
                        <p class="feature-desc mb-0" style="color:#001b48;">@campusconline</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="https://www.instagram.com/campusconnectonline?utm_source=qr&igsh=M2poMDM1bHJuNmVo" target="_blank"
                    style="text-decoration: none;">
                    <div class="feature-card p-3 h-100 shadow-sm rounded">
                        <img src="{{ asset('/assets/images/icons/instagram.png') }}" class="font-icon mb-2"
                            alt="campusconnect instagram" style="width: 40px;">
                        <p class="feature-desc mb-0" style="color:#001b48;">@campusconnectonline</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <style>
        /* Hero Section */
        .hero-section {
            padding: 30px 20px;
            text-align: center;
        }

        .hero-title {
            color: #001b48;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .hero-search-wrapper {
            max-width: 600px;
            margin: 0 auto;
        }

        .hero-search-input {
            width: 100%;
            padding: 16px 22px;
            font-size: 16px;
            border: 1px solid #dcdcdc;
            border-radius: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transition: all 0.3s;
        }

        .hero-search-input:focus {
            outline: none;
            box-shadow: 0 10px 40px rgba(35, 173, 228, 0.4);
            transform: translateY(-2px);
        }

        /* Arama Dropdown */
        .hero-search-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.2);
            max-height: 400px;
            overflow-y: auto;
            margin-top: 10px;
            display: none;
            z-index: 1000;
        }

        .hero-search-dropdown.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .search-result-item {
            padding: 15px 20px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.2s;
        }

        .search-result-item:hover {
            background: #f8f9fa;
        }

        .search-result-item:last-child {
            border-bottom: none;
        }

        .search-result-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .search-result-info {
            flex: 1;
        }

        .search-result-name {
            font-weight: 600;
            color: #001b48;
            font-size: 15px;
            margin-bottom: 2px;
        }

        .search-result-stats {
            font-size: 12px;
            color: #888;
        }

        .search-result-btn {
            background: #23ade4;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .search-result-btn:hover {
            background: #001b48;
            transform: scale(1.05);
        }

        /* Hızlı Erişim Tagları */
        .quick-access-tags {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .quick-tag {
            display: inline-block;
            padding: 8px 16px;
            backdrop-filter: blur(10px);
            color: #001b48;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.2s;
            border: 1px solid #dcdcdc;
        }

        .quick-tag:hover {
            background: white;
            color: #001b48;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* Mobil Responsive */
        @media (max-width: 768px) {
            .hero-section {
                padding: 20px 0px;
            }
            
            .hero-title {
                font-size: 21px;
            }
            .hero-search-input {
                padding: 15px 20px;
                font-size: 14px;
            }
            
            .quick-tag {
                font-size: 12px;
                padding: 6px 12px;
            }
        }
    </style>
    {{-- blog css --}}
    <style>
        .blog-item {
            display: flex;
            flex-direction: column;
            border: 1px solid #dcdcdc !important;
            border-radius: 17px;
            overflow: hidden;
        }

        .blog-item-content {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .blog-item-content .btn {
            margin-top: auto;
        }

        .blog-item-content h3 {
            font-size: 20px;
            font-weight: 600;
            color: #222;
            transition: color 0.3s;
        }

        .blog-item-content h3 a {
            text-decoration: none;
            color: inherit;
        }

        .blog-item-content h3:hover {
            color: #007bff;
        }

        .blog-item-content p {
            font-size: 15px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .blog-item-content .btn-main {
            background-color: #001b48;
            color: #fff;
            font-size: 14px;
            font-weight: 500;
            padding: 10px 18px;
            border-radius: 30px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .blog-item-content .btn-main:hover {
            background-color: #fff !important;
            color: #001b48 !important;
            border: 1px solid #001b48 !important;
        }
    </style>
    <style>
        .custom-btn {
            flex: 1;
            padding: 10px 0px;
            font-weight: bold;
            border: none;
            background: #fff;
            color: #001b48;
            text-align: center;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.3s ease;
        }
    </style>
    <style>
        .custom-card {
            padding: 10px 40px 0px 40px !important;
            border-radius: 17px !important;
            border: 1px solid #dcdcdc !important;
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
            padding: 0 21px;
            text-align: center;
            font-weight: 600;
        }

        .font-icon {
            width: 15%;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .info-section {
                padding: 10px;
            }

            .custom-btn {
                font-size: 14px;
                padding: 10px 0;
            }

            .feature-desc {
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
        .avatar {
            display: block;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-top: -2px;
            margin-bottom: 2px;
            object-fit: cover;
        }

        .footer-info {
            float: left;
            vertical-align: middle;
            padding: 4px;
            padding-right: 10px;
        }

        .topic {
            padding: 10px 0;
        }

        .topic h3 a {
            margin: 0;
            font-size: 17px;
            color: #333 !important;
            text-decoration: none;
        }

        .topic h3 a:hover {
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

        .topic-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
    </style>
    <style>
        .navbar.fixed-top+.page-body-wrapper {
            padding: 63px 0px 0px 0px !important;
        }

        .content-wrapper {
            padding: 0px !important;
        }
    </style>

    <style>
        .university-slider-wrapper {
            width: 100vw;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            background: #fff;
        }

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
            animation: slide 60s linear infinite;
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
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }
    </style>

    <style>
        .info-section {
            position: relative;
            width: 100%;
            height: 250px;
            background: linear-gradient(to right, #1e3c72, #2a5298);
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            overflow: hidden;
            border-radius: 17px;
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

            .navbar.fixed-top+.page-body-wrapper {
                padding: 56px 0px 0px 0px !important;
            }

            .custom-card {
                padding: 10px 20px 0px 20px !important;
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

    <script>
        $(document).ready(function() {
            let searchTimeout;
            
            // Hero Arama
            $('#hero-search').on('input', function() {
                clearTimeout(searchTimeout);
                const query = $(this).val().trim();
                
                if(query.length >= 2) {
                    searchTimeout = setTimeout(function() {
                        searchUniversities(query);
                    }, 300);
                } else {
                    $('#hero-search-dropdown').removeClass('show').html('');
                }
            });
            
            // Dışarı tıklandığında dropdown'u kapat
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.hero-search-wrapper').length) {
                    $('#hero-search-dropdown').removeClass('show');
                }
            });
            
            // Enter tuşuna basıldığında ilk sonuca git
            $('#hero-search').on('keypress', function(e) {
                if(e.which === 13) {
                    e.preventDefault();
                    const firstResult = $('.search-result-item').first();
                    if(firstResult.length) {
                        window.location.href = firstResult.data('url');
                    }
                }
            });
        });

        // Arama fonksiyonu - Mevcut route'u kullanıyor
        function searchUniversities(query) {
            $.ajax({
                url: '/universities/fetch',
                type: 'GET',
                data: { search: query },
                success: function(response) {
                    const universities = response.universities.data;
                    const topicsCount = response.universities_topics_count;
                    
                    if(universities.length > 0) {
                        let html = '';
                        universities.forEach(function(uni) {
                            const topicCount = topicsCount[uni.id] || 0;
                            html += `
                                <div class="search-result-item" data-url="/universite-yorumlari/${uni.slug}">
                                    <img src="${uni.logo ? uni.logo : '/default-logo.png'}" 
                                        class="search-result-logo"
                                        onerror="this.src='/default-logo.png'">
                                    <div class="search-result-info">
                                        <div class="search-result-name">${uni.universite_ad}</div>
                                        <div class="search-result-stats">${topicCount} yorum</div>
                                    </div>
                                    <button class="search-result-btn" onclick="goToUniversity('${uni.slug}', event)">
                                        <i class="bi bi-chat-dots-fill me-1"></i> <span>Yorum Yap</span>
                                    </button>
                                </div>
                            `;
                        });
                        $('#hero-search-dropdown').html(html).addClass('show');
                    } else {
                        $('#hero-search-dropdown').html(`
                            <div class="search-result-item">
                                <span class="text-muted"><i class="bi bi-search"></i> "${query}" için sonuç bulunamadı</span>
                            </div>
                        `).addClass('show');
                    }
                },
                error: function() {
                    toastr.error('Arama sırasında bir hata oluştu');
                }
            });
        }

        // Üniversite sayfasına yönlendir
        function goToUniversity(slug, event) {
            if(event) event.stopPropagation();
            window.location.href = `/universite-yorumlari/${slug}`;
        }

        // Tüm search-result-item'lere tıklanabilirlik ekle
        $(document).on('click', '.search-result-item', function() {
            window.location.href = $(this).data('url');
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#load-more-university-topics').click(function() {
                var button = $(this);
                var offset = button.data('offset');
                $.ajax({
                    url: "{{ route('load.more.university.topics') }}",
                    type: "POST",
                    data: {
                        offset: offset,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.trim() == '') {
                            button.text('Daha Fazlası Yok').prop('disabled', true);
                        } else {
                            var topics = $(data).filter('.topic');

                        topics.each(function() {
                            var wrapper = $('<div class="col-md-6 mb-3"><div class="h-100 d-flex flex-column justify-content-between"></div></div>');
                            wrapper.find('.h-100').append($(this));
                            $('#university-topics-container').append(wrapper);
                        });

                        button.data('offset', offset + 10);
                        }
                    }
                });
            });
        });
    </script>



    {{-- general like dislike --}}
    <script>
        $(document).on('click', '.like-btn', function() {
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
                success: function(response) {
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

        $(document).on('click', '.dislike-btn', function() {
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
                success: function(response) {
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
        $(document).on('click', '.university-like-btn', function() {
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
                success: function(response) {
                    likeCount.text(response.likes);
                    dislikeCount.text(response.dislikes);

                    $('.university-like-btn[data-id="' + topicId + '"]').css("color",
                    "#007bff"); // Mavi renk
                    $('.university-dislike-btn[data-id="' + topicId + '"]').css("color",
                    "#888"); // Gri renk
                }
            });
        });

        $(document).on('click', '.university-dislike-btn', function() {
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
                success: function(response) {
                    likeCount.text(response.likes);
                    dislikeCount.text(response.dislikes);

                    $('.university-dislike-btn[data-id="' + topicId + '"]').css("color",
                    "#dc3545"); // Kırmızı renk
                    $('.university-like-btn[data-id="' + topicId + '"]').css("color",
                    "#888"); // Gri renk
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
