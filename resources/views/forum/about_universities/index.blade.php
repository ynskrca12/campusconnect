@extends('layouts.master') 

@section('content')

    <div class="row mb-3" style="border-bottom: 1px solid;margin-top:-36px;">
        <div class="col-md-1 d-flex align-items-center">
            <i class="fa-solid fa-circle-left" style="font-size: 25px; cursor: pointer;" onclick="goBack()"></i>
        </div>
        
        <div class="col-md-11 mb-3">
            <ul class="nav nav-tabs d-flex justify-content-center" id="mainTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="free-zone-tab" data-bs-toggle="tab" href="#free-zone" role="tab" aria-controls="free-zone" aria-selected="true">serbest bölge</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="general-tab" data-bs-toggle="tab" href="#general-info" role="tab" aria-controls="general-info" aria-selected="true">genel bilgiler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="departmant-programs-tab" data-bs-toggle="tab" href="#departmant-programs" role="tab" aria-controls="departmant-programs" aria-selected="false">bölüm ve prog.</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="campus-life-tab" data-bs-toggle="tab" href="#campus-life" role="tab" aria-controls="campus-life" aria-selected="false">kampüs hayatı</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="question-answer-tab" data-bs-toggle="tab" href="#question-answer" role="tab" aria-controls="question-answer" aria-selected="false">soru cevap</a>
                </li>
            </ul>
        </div>

       
    </div>

    <div class="row">
        <!-- Sol Menü (Alt Başlıklar) -->
        <div class="col-md-3">
            <h4>öne çıkan</h4>
            <ul id="subcategories-list" class="list-group">
                <li class="list-group-item ">Alt başlık 1</li>
                <li class="list-group-item">Alt başlık 2</li>
                <li class="list-group-item">Alt başlık 3</li>
            </ul>
        </div>

        <!--main content-->
            <div class="col-md-7" >
                <div class="tab-content">

                    <div class="tab-pane fade show active" id="free-zone" role="tabpanel" aria-labelledby="free-zone-tab">
                        <div class="d-flex justify-content-between">
                            <h4 class="categoryTitle">serbest bölge</h4>
                            <button class="btn btnExplain">konuşabilirsin</button>
                        </div>        
                        <p>Burada serbest bölge İçeriği Yer Alacak.</p>
                    </div>

                    <div class="tab-pane fade " id="general-info" role="tabpanel" aria-labelledby="general-tab">
                        <div class="d-flex justify-content-between">
                            <h4 class="categoryTitle">genel bilgiler</h4>
                            <button class="btn btnExplain">konuşabilirsin</button>
                        </div>        
                        <p>Burada Genel Bilgiler İçeriği Yer Alacak.</p>
                    </div>

                    <div class="tab-pane fade" id="departmant-programs" role="tabpanel" aria-labelledby="departmant-programs-tab">
                        <div class="d-flex justify-content-between">
                            <h4 class="categoryTitle">bölüm ve programlar</h4>
                            <button class="btn btnExplain">konuşabilirsin</button>
                        </div>
                        <p>Burada bölüm ve prog. İçeriği Yer Alacak.</p>
                    </div>

                    <div class="tab-pane fade" id="campus-life" role="tabpanel" aria-labelledby="campus-life-tab">
                        <div class="d-flex justify-content-between">
                            <h4 class="categoryTitle">kampüs hayatı</h4>
                            <button class="btn btnExplain">konuşabilirsin</button>
                        </div>
                        <p>Burada kampüs hayatı İçeriği Yer Alacak.</p>
                    </div>

                    <div class="tab-pane fade" id="question-answer" role="tabpanel" aria-labelledby="question-answer-tab">
                        <div class="d-flex justify-content-between">
                            <h4 class="categoryTitle"> soru cevap</h4>
                            <button class="btn btnExplain">konuşabilirsin</button>
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
  
@endsection 

@section('css')
    <style>
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
