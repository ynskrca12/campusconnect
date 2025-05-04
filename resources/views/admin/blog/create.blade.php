@extends('admin.master')

@section('title', 'Blog Ekle | CampusConnect')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        .sidebar {
            background: white !important;
            border: 2px solid #004D49;
            padding: 10px 10px;
            border-left: none;
            border-radius: 0px;
            border-top: none;
            border-bottom: none;
            height: 100vh;
            position: sticky;
            top: 0;
        }

        .sidebar .nav-link {
            font-size: 1.1rem;
            padding: 12px;
            color: #004D49;
        }

        .sidebar .nav-link.active {
            background-color: #004D49;
            color: white;
            border-radius: 10px;
        }

        .card {
            border-radius: 8px;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .card-text {
            font-size: 1.5rem;
        }

        .list-group-item {
            font-size: 1.1rem;
            border: 1px solid #ddd;
        }

        .container-fluid {
            padding-top: 20px;
        }

        .ck-editor__editable {
            min-height: 300px;
        }

        #applicationForm{
            margin-top: 30px;
        }

        .border{
            border: 1px solid #838383  !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Main content -->
            <main class="col-md-9 col-lg-9 px-4">
                <h1 class="h2 mb-4">Blog Yazısı Ekle</h1>

                <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" id="blogCreateForm">
                    @csrf
                    <div class="row mb-4">
                        <div class="mb-3 col-md-6">
                            <label for="cover_image" class="form-label">Kapak Görseli</label>
                            <input type="file" class="form-control border" id="cover_image" name="cover_image">
                        </div>
    
                        <div class="mb-3 col-md-6">
                            <label for="content_image" class="form-label">Ana Görseli</label>
                            <input type="file" class="form-control border" id="content_image" name="content_image">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="title" class="form-label">Blog Başlığı</label>
                        <input type="text" class="form-control border" id="title" name="title">
                    </div>

                    <div class="mb-4">
                        <label for="title" class="form-label">Blog Kategorisi</label>
                        <select name="category" class="form-control border" id="category">
                            <option value="">Seçiniz</option>
                            @foreach($blogCategories as $category)
                                <option class="form-control" value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="job_description" class="form-label">Blog İçeriği</label>
                        <textarea class="form-control border" id="blog_content" name="blog_content" rows="5"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="job_description" class="form-label">Blog Özeti (Blog Sayfasında Görünecek)</label>
                        <textarea class="form-control border" id="blog_summary" name="blog_summary" rows="5"></textarea>
                    </div>

                    <hr>

                    <h5>SEO Ayarları</h5>
                
                    <div class="mb-4">
                        <label for="seo_title" class="form-label">SEO Başlık</label>
                        <input type="text" class="form-control border" id="seo_title" name="seo_title">
                    </div>
                
                    <div class="mb-4">
                        <label for="seo_description" class="form-label">SEO Açıklama</label>
                        <textarea class="form-control border" id="seo_description" name="seo_description" rows="3"></textarea>
                    </div>
                
                    <div class="mb-4">
                        <label for="meta_keywords" class="form-label">Meta Anahtar Kelimeler</label>
                        <input type="text" class="form-control border" id="meta_keywords" name="meta_keywords" placeholder="virgül ile ayırın">
                    </div>


                    <button type="submit" class="btn btn-primary">Başvuruyu Kaydet</button>
                </form>

            </main>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            ClassicEditor
                .create(document.querySelector('#blog_content'))
                .catch(error => {
                    console.error('CKEditor yüklenirken hata:', error);
                });
        });
    </script>
    

    <script>
        toastr.options = {
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };
    
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif
    </script>


   
@endsection
