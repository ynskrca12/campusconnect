@extends('layouts.master') 

@section('content')

    <div class="row">
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
                    <button id="universities-tab" class="btn me-2 general-topic-btn">üniversiteler hk.</button>
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
                            <div class="meta">
                                <div class="d-flex align-items-center entry-footer-bottom">
                                    <div class="footer-info">
                                        <div style="display: block;padding: 2px;float: right;margin: -5px 0px;">
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

            <!-- Tüm Üniversiteler İçerikleri -->
            <div id="universities-content" class="content-area d-none">
                <div class="d-flex justify-content-between mb-5">
                    <span class="content-title">üniversite halleri</span>
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
                {{-- <p>Reklam Alanı</p> --}}
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
            font-size: 18px;
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
        }
    </style>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

            function loadSubcategories(subcategories, type = 'general') {
                $("#subcategories-list").empty();
                subcategories.forEach(function (item) {

                    const generalSubCategoriesCount = item.count || 0;

                    if (type === 'university') {
                        // university limk
                        $("#subcategories-list").append(
                            `<li class="list-group-item universityLi">
                                <a href="/forum/universite/${item.slug}" class="text-decoration-none universityTag">${item.universite_ad}</a>
                            </li>`
                        );
                    } else if (type === 'city') {
                        // city link
                        $("#subcategories-list").append(
                            `<li class="list-group-item cityLi">
                                <a href="/forum/sehir/${item.slug}" class="text-decoration-none cityTag">${item.title}</a>
                            </li>`
                        );
                    } else {
                        // general topics
                        $("#subcategories-list").append(
                        `<li class="list-group-item">
                                <a href="/forum/mevzu/${item.topic_title_slug}" class="text-decoration-none subCategoryTag d-flex justify-content-between">
                                    <span class="topic-title-sub-category">${item.topic_title}</span>
                                    <span class="count">(${generalSubCategoriesCount})</span>
                                </a>
                            </li>`
                        );
                    }
                });
            }

            // Tab butonları
            $("#general-tab").on("click", function () {
                $("#general-tab").addClass("activeCategory");
                $("#universities-tab, #cities-tab").removeClass("activeCategory");
                
                $("#general-content").removeClass("d-none");
                $("#universities-content, #cities-content",).addClass("d-none");

                $('.btnCreateGeneral').removeClass('d-none');

                loadSubcategories(generalSubcategories);
            });

            $("#universities-tab").on("click", function () {
                $("#universities-tab").addClass("activeCategory");
                $("#general-tab, #cities-tab").removeClass("activeCategory");
                
                $("#universities-content").removeClass("d-none");
                $("#general-content, #cities-content").addClass("d-none");

                $('.btnCreateGeneral').addClass('d-none');
                //$('.sidebarTitle').text('en çok konuşulanlar');
                loadSubcategories(universitiesSubcategories, 'university');
            });

            $("#cities-tab").on("click", function () {
                $("#cities-tab").addClass("activeCategory");
                $("#general-tab, #universities-tab").removeClass("activeCategory");
                
                $("#cities-content").removeClass("d-none");
                $("#general-content, #universities-content").addClass("d-none");

                $('.btnCreateGeneral').addClass('d-none');
                loadSubcategories(citiesSubcategories, 'city');
            });

            // Başlangıç olarak genel tartışma alt başlıklarını yükle
            loadSubcategories(generalSubcategories);
            $("#general-tab").addClass("activeCategory");
        });
    </script>
    
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
                            popup: 'swal-custom-popup' // Bu sınıfı kullanarak genişliği ayarlayacağız
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Giriş yap butonuna tıklanırsa yönlendirme yapılır
                            window.location.href = "{{ route('login') }}";  // Giriş sayfasına yönlendir
                        }
                    });
                } else {
                    // Kullanıcı giriş yapmışsa SweetAlert popup aç
                    Swal.fire({
                        title: 'mevzu nedir ',
                        html: `
                            <form id="createAgendaForm">
                                <div class="form-group">
                                    <input type="text" id="title" name="title" class="form-control" placeholder="başlık" style="border: none;border-bottom: 1px solid #ced4da;border-radius: 0px;">
                                </div>
                                <div class="form-group mt-3">
                                    <textarea id="content" name="content" class="form-control" rows="4" placeholder="açıklamanız"></textarea>
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
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Hata!',
                                        text: 'Bir şeyler ters gitti, lütfen tekrar deneyin.',
                                    });
                                },
                            });
                        }
                    });
                }
            });
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
                                <div class="meta">
                                    <div class="d-flex align-items-center entry-footer-bottom">
                                        <div class="footer-info">
                                            <div style="display: block;padding: 2px;float: right;margin: -5px 0px;">
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
