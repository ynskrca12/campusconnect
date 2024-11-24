@extends('layouts.master') 

@section('content')

    <div class="row">
        <!-- Sol Menü (Alt Başlıklar) -->
        <div class="col-md-3">
            <h4>öne çıkan...</h4>
            <ul id="subcategories-list" class="list-group">
                <!-- Başlangıçta Genel Tartışma Alanı alt başlıkları yüklenecek -->
                {{-- <li class="list-group-item">Eğitim Sistemi Tartışmaları</li>
                <li class="list-group-item">Tercih ve Rehberlik</li>
                <li class="list-group-item">Üniversite Hayatı</li> --}}
            </ul>
        </div>

        <!-- Ana İçerik Alanı -->
        <div class="col-md-7" style="border-left: 1px solid #e0e0e0;">
            <!-- Forum Başlıkları -->
            <div class="d-flex mb-3">
                <button id="general-tab" class="btn btn-primary me-2 activeCategory">tartışalım</button>
                <button id="universities-tab" class="btn btn-outline-primary me-2">üniversiteler hk.</button>
                <button id="cities-tab" class="btn btn-outline-primary me-2">şehirler hk.</button>
            </div>

            <!-- Genel Tartışma Alanı İçerikleri -->
            <div id="general-content" class="content-area">
                <div class="d-flex justify-content-between mb-5">
                    <span class="content-title">Neyi konuşalım...</span>
                   
                     <button class="btn btnCreateGeneral">gündem oluştur</button>
                   
                </div>
                
                {{-- <p class="mb-5">Bu bölümde üniversite eğitimi, rehberlik ve tercihler gibi genel konular hakkında tartışmalar yapabilirsiniz.</p> --}}

                @auth
                    <form  method="POST">
                        @csrf
                        <div id="editor-container-general" style="height: 200px;"></div>
                        <input type="hidden" name="comment" id="comment">
                        <button type="submit" class="btn btn-primary mt-3">Yorum Gönder</button>
                    </form>
                @endauth

                
            </div>

            <!-- Tüm Üniversiteler İçerikleri -->
            <div id="universities-content" class="content-area d-none">
                <div class="d-flex justify-content-between mb-5">
                    <span class="content-title">üniversite halleri</span>
                 
                        <button class="btn btnCreateUniversity">gündem oluştur</button>
                 
                </div>

                @auth
                <form  method="POST">
                    @csrf
                    <div id="editor-container-university" style="height: 200px;"></div>
                    <input type="hidden" name="comment" id="comment">
                    <button type="submit" class="btn btn-primary mt-3">Yorum Gönder</button>
                </form>
            @endauth
            </div>

            <div id="cities-content" class="content-area d-none">
                <div class="d-flex justify-content-between mb-5">
                    <span class="content-title">şehir hayatı</span>
                  
                        <button class="btn btnCreateCity">gündem oluştur</button>
                  
                </div>
                @auth
                <form  method="POST">
                    @csrf
                    <div id="editor-container-city" style="height: 200px;"></div>
                    <input type="hidden" name="comment" id="comment">
                    <button type="submit" class="btn btn-primary mt-3">Yorum Gönder</button>
                </form>
            @endauth
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
        #subcategories-list .list-group-item{
            border:none !important;
            padding: 7px 0px;
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
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            
        }
        .activeCategory {
            background-color: #007bff;
            color: white;
        }
        .universityTag, .cityTag{
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

    </style>
@endsection

@section('js')
    <!-- jQuery 3.6.0 (en güncel ve yaygın olarak kullanılan versiyon) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <!-- SweetAlert2 CDN -->
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
            // Genel Tartışma Alanı konuları
            const generalSubcategories = @json($general_topics->pluck('topic_title'));

            // Üniversiteler ve slug'ları
            const universitiesSubcategories = @json($universities);

            // Şehirler
            const citiesSubcategories = @json($cities);

            // Alt başlıkları yükleyen fonksiyon
            function loadSubcategories(subcategories, type = 'general') {
                $("#subcategories-list").empty();
                subcategories.forEach(function (item) {
                    if (type === 'university') {
                        // Üniversite linki
                        $("#subcategories-list").append(
                            `<li class="list-group-item universityLi">
                                <a href="/forum/universite/${item.slug}" class="text-decoration-none universityTag">${item.universite_ad}</a>
                            </li>`
                        );
                    } else if (type === 'city') {
                        // Şehir linki
                        $("#subcategories-list").append(
                            `<li class="list-group-item cityLi">
                                <a href="/forum/sehir/${item.slug}" class="text-decoration-none cityTag">${item.title}</a>
                            </li>`
                        );
                    } else {
                        // Genel konular
                        $("#subcategories-list").append(`<li class="list-group-item">${item}</li>`);
                    }
                });
            }

            // Tab butonları
            $("#general-tab").on("click", function () {
                $("#general-tab").addClass("activeCategory btn-primary").removeClass("btn-outline-primary");
                $("#universities-tab, #cities-tab").removeClass("activeCategory btn-primary").addClass("btn-outline-primary");
                
                $("#general-content").removeClass("d-none");
                $("#universities-content, #cities-content",).addClass("d-none");

                loadSubcategories(generalSubcategories);
            });

            $("#universities-tab").on("click", function () {
                $("#universities-tab").addClass("activeCategory btn-primary").removeClass("btn-outline-primary");
                $("#general-tab, #cities-tab").removeClass("activeCategory btn-primary").addClass("btn-outline-primary");
                
                $("#universities-content").removeClass("d-none");
                $("#general-content, #cities-content").addClass("d-none");

                loadSubcategories(universitiesSubcategories, 'university');
            });

            $("#cities-tab").on("click", function () {
                $("#cities-tab").addClass("activeCategory btn-primary").removeClass("btn-outline-primary");
                $("#general-tab, #universities-tab").removeClass("activeCategory btn-primary").addClass("btn-outline-primary");
                
                $("#cities-content").removeClass("d-none");
                $("#general-content, #universities-content").addClass("d-none");

                loadSubcategories(citiesSubcategories, 'city');
            });

            // Başlangıç olarak genel tartışma alt başlıklarını yükle
            loadSubcategories(generalSubcategories);
            $("#general-tab").addClass("activeCategory btn-primary").removeClass("btn-outline-primary");
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
            // Kullanıcı giriş yapmışsa burada başka bir işlem yapabilirsin
            // Örneğin, formu gönderebilirsiniz.
        }
    });
});


</script>


@endsection
