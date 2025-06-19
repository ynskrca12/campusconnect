@extends('layouts.master') 

@section('content')
    <section class="page-title mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center">
                        <h1 class="text-capitalize text-white mb-4 text-lg text-clear">Okumak En Büyük Zevkimiz</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
    <section class="section blog-wrap mt-5">
            <div class="container-fluid px-0">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="row">
                                @if (!empty($blogs))
                                    @foreach ($blogs as $blog)
                                        <div class="col-lg-4 col-md-6 mb-5">
                                            <div class="blog-item h-100 d-flex flex-column">
                                                <a href="{{route('blog.single', ['slug' => $blog->slug])}}">
                                                    <img src="{{ asset( $blog->cover_image) }}" loading="lazy" alt="blog yazısı" class="img-fluid">
                                                </a>
                                    
                                                <div class="blog-item-content px-5 px-md-4 py-5">
                                                    <div class="blog-item-meta  py-1 px-2">
                                                        <span class="text-muted text-capitalize mr-3"><i class="fa-solid fa-feather me-2"></i> {{$blog->blogCategory->name}}</span>
                                                    </div> 
                                    
                                                    <h3 class="mt-3 mb-3"><a href="{{route('blog.single', ['slug' => $blog->slug])}}">{{$blog->title}}</a></h3>
                                                    <p class="mb-4 mt-1 fs-6">{{$blog->summary}}</p>
                                    
                                                    <a href="{{route('blog.single', ['slug' => $blog->slug])}}" class="btn btn-small btn-main btn-round-full px-4">Daha Fazla</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    
                                @endif
                                                                
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="sidebar-wrap">                                    
                                <div class="sidebar-widget latest-post card border-0 mb-3">
                                    <h5>En Son Bloglar</h5>
                                    @foreach ($blogs as $blog)
                                        <div class="media border-bottom py-3">
                                            <a href="{{route('blog.single', ['slug' => $blog->slug])}}"><img class="mr-4" src="{{ asset( $blog->cover_image) }}" alt=""></a>
                                            <div class="media-body">
                                                <h6 class="my-2"><a href="{{route('blog.single', ['slug' => $blog->slug])}}">{{$blog->title}}</a></h6>
                                                <span class="text-sm text-muted">{{date('d M Y', strtotime($blog->created_at))}}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                            
                                </div>
                            </div>
                        </div>   
                    </div>
            </div>
    </section>
  
@endsection 

@section('css')
    <style>
        .page-title {
            background-image: url('{{ asset('assets/images/blog_img/home-2.jpg') }}'); 
            background-repeat: no-repeat; 
            background-position: 50% 50%; 
            background-size: cover; 
            padding: 200px 0;
            background-attachment: fixed;
            border-radius: 17px;
        }
        .page-body-wrapper {
            padding: 0;
        }

        .content-wrapper {
            padding: 0;
            margin-top: -10px;
        }

        .blog-item {
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
            border-radius: 17px;
            overflow: hidden;
        }

        .blog-item-content h3 {
            font-size: 20px;
            font-weight: 600;
            color: #222; /* koyu gri */
            transition: color 0.3s;
        }

        .blog-item-content h3 a {
            text-decoration: none;
            color: inherit;
        }

        .blog-item-content h3:hover {
            color: #007bff; /* mavi ton – değiştirilebilir */
        }

        .blog-item-content p {
            font-size: 15px;
            color: #555; /* daha açık gri */
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .blog-item-content .btn-main {
            background-color: #007bff; /* mavi ton */
            color: #fff;
            font-size: 14px;
            font-weight: 500;
            padding: 10px 18px;
            border-radius: 30px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .blog-item-content .btn-main:hover {
            background-color: #0056b3;
            color: #fff;
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

    

@endsection
