@extends('layouts.master') 

@section('content')

    <div class="row">
        <!-- Sol Menü (Alt Başlıklar) -->
        <div class="col-md-3">
            <h4>öne çıkan</h4>
            <ul id="subcategories-list" class="list-group">
                <li class="list-group-item general-info activeCategory" data-target="general-info">genel bilgiler</li>
                <li class="list-group-item program" data-target="program">bölüm ve programlar</li>
                <li class="list-group-item campus-life" data-target="campus-life">kampüs yaşamı</li>
                <li class="list-group-item question-answer" data-target="question-answer">soru-cevap</li>
            </ul>
        </div>

        <!--main content-->
        <div class="col-md-7" style="border-left: 1px solid #373737;">
            
            <div id="general-info" class="content-section">
                <div class="d-flex justify-content-between">
                    <h4 class="categoryTitle">genel bilgiler</h4>
                    <button class="btn btnTalk">konuşabilirsin</button>
                </div>
            </div>
    
            <div id="program" class="content-section d-none">
                <div class="d-flex justify-content-between">
                    <h4 class="categoryTitle">bölüm ve programlar</h4>
                    <button class="btn btnTalk">konuşabilirsin</button>
                </div>
            </div>
    
            <div id="campus-life" class="content-section d-none">
                <div class="d-flex justify-content-between">
                    <h4 class="categoryTitle">kampüs hayatı</h4>
                    <button class="btn btnTalk">konuşabilirsin</button>
                </div>    
            </div>    
            
            <div id="question-answer" class="content-section d-none">
                <div class="d-flex justify-content-between">
                    <h4 class="categoryTitle">soru cevap</h4>
                    <button class="btn btnTalk">konuşabilirsin</button>
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
        .btnTalk:hover{
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

    <script>
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
    </script>


@endsection
