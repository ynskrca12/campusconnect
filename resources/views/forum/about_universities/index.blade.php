@extends('layouts.master') 

@section('content')

    <div class="row mb-3" style="border-bottom: 1px solid;margin-top:-36px;">
        <div class="col-md-1 d-flex align-items-center">
            <i class="fa-solid fa-circle-left" style="font-size: 25px; cursor: pointer;" onclick="goBack()"></i>
        </div>
        
        <div class="col-md-11 mb-3">
            <ul class="nav nav-tabs d-flex justify-content-center" id="mainTabs" role="tablist">
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
        </div>
        

       
    </div>

    <div class="row">
        <!-- Sol Menü (Alt Başlıklar) -->
        <div class="col-md-3">
            <h4>öne çıkan</h4>
            <ul id="subcategories-list" class="list-group">
                @foreach($univercity_free_zone_topics as $topic)
                    <li class="list-group-item">
                        <a href="#" class="text-decoration-none text-dark">
                            {{-- <a href="{{ route('topic.detail', ['id' => $topic->id]) }}" class="text-decoration-none text-dark"> --}}
                            {{ $topic->topic_title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!--main content-->
            <div class="col-md-7" >
                <div class="tab-content">

                    <div class="tab-pane fade show active" id="free-zone" role="tabpanel" aria-labelledby="free-zone-tab">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="categoryTitle">{{$university->universite_ad}}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="arrow-icon icon-top" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 1 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                                <span class="categoryTitle">serbest bölge</span>
                            </div>
                           <div> 
                                <button class="btn btnExplain" data-category="free-zone">
                                    <i class="fa-solid fa-envelope"></i>    
                                </button>
                            </div>
                        </div>        
                        <p>Burada serbest bölge İçeriği Yer Alacak.</p>
                    </div>

                    <div class="tab-pane fade " id="general-info" role="tabpanel" aria-labelledby="general-tab">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="categoryTitle">{{$university->universite_ad}}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="arrow-icon icon-top" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 1 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                                <span class="categoryTitle">genel bilgileri</span>
                            </div>
                           <div> 
                                <button class="btn btnExplain" data-category="general-info">
                                    <i class="fa-solid fa-envelope"></i>
                                </button>
                            </div>
                        </div>        
                        <p>Burada Genel Bilgiler İçeriği Yer Alacak.</p>
                    </div>

                    <div class="tab-pane fade" id="departmant-programs" role="tabpanel" aria-labelledby="departmant-programs-tab">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="categoryTitle">{{$university->universite_ad}}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="arrow-icon icon-top" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 1 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                                <span class="categoryTitle">bölüm ve programlar</span>
                            </div>
                           <div> 
                                <button class="btn btnExplain" data-category="departmant-programs">
                                    <i class="fa-solid fa-envelope"></i>
                                </button>
                            </div>
                        </div>
                        <p>Burada bölüm ve prog. İçeriği Yer Alacak.</p>
                    </div>

                    <div class="tab-pane fade" id="campus-life" role="tabpanel" aria-labelledby="campus-life-tab">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="categoryTitle">{{$university->universite_ad}}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="arrow-icon icon-top" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 1 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                                <span class="categoryTitle">kampüs hayatı</span>
                            </div>
                           <div> 
                                <button class="btn btnExplain" data-category="campus-life">
                                    <i class="fa-solid fa-envelope"></i>
                                </button>
                            </div>
                        </div>
                        <p>Burada kampüs hayatı İçeriği Yer Alacak.</p>
                    </div>

                    <div class="tab-pane fade" id="question-answer" role="tabpanel" aria-labelledby="question-answer-tab">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="categoryTitle">{{$university->universite_ad}}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="arrow-icon icon-top" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 1 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                                <span class="categoryTitle">soru cevap</span>
                            </div>
                            <div>
                                <button class="btn btnExplain">
                                    <i class="fa-solid fa-envelope"></i>
                                </button>
                            </div>
                        </div>        
                        <p>Burada soru cevap Yerler İçeriği Yer Alacak.</p>
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

        #subcategories-list .list-group-item{
            border:none !important;
            padding: 7px 0px;
            border-radius: 6px;
            cursor: pointer;
        }
        
        .activeCategory {
            background-color: #373737;
            color: white;
            padding: 7px 10px !important;
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

        .list-group-item.activeCategory {
            background-color: #373737;
            color: white;
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
        $(document).ready(function () {
            // Alt başlık geçişleri
            $('#subcategories-list .list-group-item').on('click', function () {
                $('#subcategories-list .list-group-item').removeClass('activeCategory');
                $(this).addClass('activeCategory');
            });
        });
    </script>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <script>
        $(document).ready(function () {
            $(".nav-link").on("click", function () {
                const category = $(this).data("category"); 
                const subcategoriesList = $("#subcategories-list"); 
                const univercityId = @json($university->id);

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
                                    <a href="/topic/${topic.topic_title_slug}" class="text-decoration-none text-dark">${topic.topic_title}</a>
                                </li>`;
                            subcategoriesList.append(listItem);
                        });
                    },
                    error: function () {
                        alert("Konular yüklenirken bir hata oluştu.");
                    }
                });
            });
        });

    </script>

    <script>
        $(document).ready(function () {
            $('.btnExplain').on('click', function () {
                // Butonun kategorisini al
                const category = $(this).data('category');

                $('#categoryName').val(category); // Modal'daki gizli inputa kategoriyi ata
                $('#topicModal').modal('show'); // Modal'ı aç
            });

            // Form gönderim işlemi
            $('#topicForm').on('submit', function (e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const formData = $(this).serialize(); // Form verilerini al

                $.ajax({
                    url: '/university-topic/add', // Rotanızı buraya yazın
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
                    sessionStorage.removeItem('toastrMessage'); // Mesajı gösterdikten sonra temizle
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

    {{-- <script>
        $(document).ready(function () {
            $('#subcategories-list .list-group-item').on('click', function () {
                // remove activeCategory class from all items
                $('#subcategories-list .list-group-item').removeClass('activeCategory');

                $(this).addClass('activeCategory');

                $('.content-section').addClass('d-none');

                const target = $(this).data('target');
                $('#' + target).removeClass('d-none');
            });
        });
    </script> --}}


@endsection
