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

            <!-- Genel Tartışma Alanı İçerikleri -->
            <div id="general-content" class="content-area">
                <h3 class="topic-title mb-3">{{ $topicTitle }}</h3>
                
                <div id="topic-list">
                    @foreach ($comments as $comment)
                        <div class="topic">
                            <p>{{ $comment['comment'] }}</p>
                            <div class="like-dislike mt-3">
                                <div class="like-btn d-inline me-3" data-id="{{ $comment['id'] }}" style="cursor: pointer; color: #888;">
                                    <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-up"></i> <span class="like-count">{{ $comment['likes'] }}</span>
                                </div>
                                <div class="dislike-btn d-inline" data-id="{{ $comment['id'] }}" style="cursor: pointer; color: #888;">
                                    <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-down"></i> <span class="dislike-count">{{ $comment['dislikes'] }}</span>
                                </div>
                            </div>
                            <div class="meta">
                                <div class="d-flex align-items-center entry-footer-bottom">
                                    <div class="footer-info">
                                        <div style="display: block;padding: 2px;text-align: end;margin: -5px 0px;">
                                            <p style="display: block;white-space:nowrap;color:#001b48;">{{ \App\Models\User::where('id',$comment['user_id'])->value('username') ?? 'Anonim'}}</p>
                                        </div>

                                        <div style="display: block;padding: 2px;line-height: 14px;">
                                            <p style="color: #888;font-size: 12px;">{{ \Carbon\Carbon::parse($comment['created_at'])->format('d.m.Y H:i') }}</p>
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
            font-size: 17px;
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
            word-wrap: break-word;
            padding-right: 130px;
            font-size: 20px !important;
        }

        .topic-title-sub-category {
            flex: 1;
            word-wrap: break-word; 
            word-break: break-word;
        }

        .count {
            margin-left: auto; 
            display: inline-block;
            margin-left: 15px;
            font-weight: 700;
            color: #001b48;
        }

    </style>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    {{-- like dislike --}}
    <script>
        $(document).on('click', '.like-btn', function () {
            let topicId = $(this).data('id');
            console.log('topics' + topicId);
            let userId = '{{ auth()->id() }}'; 

            if (!userId) {
                toastr.error('giriş yapmamışsın hemşerim');
                return; 
            }
            
            let likeCount = $(this).find('.like-count');

            $.ajax({
                url: `/general/topic/${topicId}/like`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    likeCount.text(response.likes);
                }
            });
        });

        $(document).on('click', '.dislike-btn', function () {
            let topicId = $(this).data('id');
            let userId = '{{ auth()->id() }}'; 

            if (!userId) {
                toastr.error('giriş yapmamışsın hemşerim');
                return; 
            }

            let dislikeCount = $(this).find('.dislike-count');

            $.ajax({
                url: `/general/topic/${topicId}/dislike`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    dislikeCount.text(response.dislikes);
                }
            });
        });

    </script>
    
    {{-- siderbar change --}}
    <script>
        $(document).ready(function () {
            // general subcategories
            const generalSubcategories = @json($general_topics);          

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
                        `<li class="list-group-item mb-1">
                                <a href="/forum/mevzu/${item.topic_title_slug}" class="text-decoration-none subCategoryTag d-flex justify-content-between">
                                    <span class="topic-title-sub-category">${item.topic_title}</span>
                                    <span class="count">${generalSubCategoriesCount}</span>
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

            // Başlangıç olarak genel tartışma alt başlıklarını yükle
            loadSubcategories(generalSubcategories);
            $("#general-tab").addClass("activeCategory");
        });
    </script>
    
    
@endsection
