@extends('layouts.master') 

@section('title', $blog->seo_title ?? $blog->title)
@section('meta_description', $blog->seo_description ?? Str::limit(strip_tags($blog->content), 150))
@section('meta_keywords', $blog->meta_keywords ?? 'blog, haber, yazı')

@section('content') 
 
<section class="section blog-wrap bg-gray">
    <div class="container-fluid">
        <div class="row px-md-5">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12 mb-5">
                        <div class="single-blog-item">
                            <img src="{{ asset( $blog->content_image) }}" loading="lazy" alt="Üniversite Blog Yazısı" class="img-fluid rounded">

                            <div class="blog-item-content bg-white p-5">
                                <div class="blog-item-meta bg-gray py-1 px-2">
                                    <span class="text-muted text-capitalize me-3"><i class="fa-solid fa-feather me-2"></i>{{$blog->blogCategory->name}}</span>
                                    <span class="text-black text-capitalize"><i class="fa-regular fa-clock me-2"></i>{{$blog->created_at->format('d M Y')}}</span>
                                </div> 

                                <h2 class="mt-3 mb-4">{{$blog->title}}</h2>
                                 <div class="blog-content">
                                    {!!$blog->content!!}
                                 </div>

                                <div class="tag-option mt-5 clearfix">        

                                    <ul class="float-right list-inline">
                                        <li class="list-inline-item"> Paylaş: </li>
                                        <li class="list-inline-item">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank">
                                                <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}" target="_blank">
                                                <i class="fab fa-twitter" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar-wrap px-xxl-4">                                    
                    <div class="sidebar-widget latest-post card border-0 px-xxl-4 mb-3">
                        <h5>En Son Bloglar</h5>
                
                        @foreach ($blogs as $blog)
                            <div class="media border-bottom py-3">
                                <a href="{{route('blog.single', ['slug' => $blog->slug])}}"><img class="mr-4" src="{{ asset($blog->cover_image) }}" alt=""></a>
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
        /* Blog item */
        .single-blog-item {
            border-radius: 8px;
            overflow: hidden;
        }

        .single-blog-item img {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: contain;
        }

        .blog-item-content p{
            font-size: 16px !important;
        }

        .blog-item-meta {
            font-size: 14px;
            color: #888;
        }

        .blog-item-meta i {
            font-size: 14px;
        }

        h2 a {
            text-decoration: none;
            color: #333;
        }

        h2 a:hover {
            color: #007bff;
        }

        p.lead {
            font-size: 18px;
            color: #555;
        }

        .quote {
            font-size: 18px;
            font-style: italic;
            color: #333;
            margin: 20px 0;
        }


        /* Sidebar */
        .sidebar-widget {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            background-color: #fff;
        }

        .sidebar-widget .media {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .sidebar-widget .media img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
        }

        .sidebar-widget .media-body h6 {
            font-size: 16px;
            font-weight: bold;
        }

        .sidebar-widget .media-body span {
            font-size: 14px;
            color: #888;
        }

        /* Responsive için */
        @media (max-width: 992px) {
            .single-blog-item {
                margin-bottom: 30px;
            }

            .sidebar-widget {
                margin-top: 30px;
            }

            .blog-item-content {
                padding: 20px;
            }
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
