@extends('admin.master')

@section('title', 'Blog Ve Makaleler | CampusConenct')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"  />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        .sidebar {
            background: white !important;
            border: 2px solid #001b48;
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
            background-color: #001b48;
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
        .blog-cover-img{
            width: 100px;
        }
        .btn-modern {
            background-color: #007bff;
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 50px;
            border: 2px solid transparent;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4);
            transition: all 0.3s ease-in-out;
        }

        .btn-modern:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.6);
            color: white;
        }

        .btn-modern:focus {
            outline: none;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.5);
        }

        .btn-detay {
            background-color: #f55a00d8;
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 50px;
            border: 2px solid transparent;
            box-shadow: 0 4px 10px rgb(238, 140, 13);
            transition: all 0.3s ease-in-out;
        }

        .btn-detay:hover {
            background-color: #f55a00d8;
            border-color: #f55a00d8;
            box-shadow: 0 6px 15px rgba(238, 140, 13, 0.6);
            color: white;
        }

        .btn-detay:focus {
            outline: none;
            box-shadow: 0 0 0 0.25rem rgba(04, 238, 13, 0.5);
        }

        .btn-danger {
            background-color: #f72929d8;
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 50px;
            border: 2px solid transparent;
            box-shadow: 0 4px 10px rgb(238, 140, 13);
            transition: all 0.3s ease-in-out;
        }

        .btn-danger:hover {
            background-color: #f72929d8;
            border-color: #f72929d8;
            box-shadow: 0 6px 15px rgba(238, 140, 13, 0.6);
            color: white;
        }

        .btn-danger:focus {
            outline: none;
            box-shadow: 0 0 0 0.25rem rgba(04, 238, 13, 0.5);
        }


    </style>

    <style>
         .btn-modern {
             background-color: #007bff;
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 50px;
            border: 2px solid transparent;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4);
            transition: all 0.3s ease-in-out;
        }

        .btn-modern:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.6);
            color: white;
        }

        .btn-modern:focus {
            outline: none;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.5);
        }
    </style>

    {{-- table css --}}
    <style>
       
        .table-container {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1; 
        }
        .table tbody{
            border: 1px solid #dee2e6;
        }

        .table{
            color: #001b48;
            border-color: #001b48;  
            text-align: center;
        }

        .btn-outline-primary {
            color: #007bff;
            border-color: #007bff;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
        }

        .badge.bg-success {
            background-color: #28a745;
        }

        .badge.bg-danger {
            background-color: #dc3545;
        }

        .btn-sm {
            border-radius: 20px;
        }

        .table th {
            border-top: 2px solid #001b48;
        }

        .table td, .table th {
            padding: 1rem;
        }

        .shadow-sm {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .table-hover tbody tr:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .bg-erapan{
            background-color: #001b48;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Main content -->
            <main class="col-md-12 col-lg-12 px-4">
                <h1 class="h2 mb-4 text-center">Blog ve Makaleler</h1>
                    <div class="row">
                        <div class="col-12">
                           <a href="{{route('admin.blog.create')}}" class="btn btn-moder">Blog Oluştur</a>     
                        </div> 
                    </div> 
                    <div class="row mt-3 mb-4">
                        <div class="col-12">
                            <div class="table-container">
                                <div class="table-responsive" style="border-radius: 11px;">
                                    <table class="table table-striped table-hover table-bordered shadow-sm rounded">
                                        <thead class="bg-erapan text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Kapak Görseli</th>
                                                <th>Yazar</th>
                                                <th>Başlık</th>
                                                <th>Kategori</th>
                                                <th>İçerik Özeti</th>
                                                <th>Görüntülenme</th>
                                                <th>Like/Dislike Sayısı</th>
                                                <th>Tarih</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($blogs->isEmpty())
                                                <tr>
                                                    <td colspan="12" class="text-center">Veri bulunamadı.</td>
                                                </tr>

                                            @else
                                                @foreach ($blogs as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <img src="{{asset('assets/images/blog_img/default_blog_img.webp')}}" alt="Kapak Gorseli" style="width: 100px; height: 100px; object-fit: cover;">
                                                        </td>
                                                        <td>{{ $item->user->name }}</td>
                                                        <td>{{ $item->title }}</td>
                                                        <td>{{ $item->blogCategory->name }}</td>
                                                        <td>{{ $item->summary }}</td>
                                                        <td>{{ $item->view_count }}</td>
                                                        <td>{{ $item->likes }} / {{ $item->dislikes }}</td>
                                                       
                                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </main>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
