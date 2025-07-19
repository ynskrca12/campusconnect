@extends('layouts.master')

@section('content')
  @if(session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
  @endif

  <div class="row">
      <!-- Main Content -->
      <div class="col-12">
          <div class="card border-0 mt-0 mt-md-5">
              <div class="card-body p-0">
                  <div class="row g-0">
                      <!-- Sidebar -->
                      <div class="col-lg-3 text-center mb-4 pe-0 pe-md-4">
                        <div class="position-relative d-inline-block">
                            @php 
                                $imageName = $user->user_image;
                                
                                $imagePath = $imageName
                                    ? asset('storage/profile_images/' . $imageName)
                                    : asset('assets/images/icons/user.png');
                                
                                $bgColor = match ($imageName) {
                                    'man.png' => '#95bdff',
                                    'woman.png' => '#ffbdd3',
                                    default => 'transparent',
                                };
                            @endphp    
                          <img 
                            style="background-color: {{ $bgColor }};width: 70px;height: 70px;object-fit: cover;"
                            src="{{ $imagePath }}"
                            class="rounded-circle profile-pic" alt="Profile Picture">
                          {{-- <button class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle">
                              <i class="fas fa-camera"></i>
                          </button> --}}
                      </div>
                      <h5 class="mt-3 mb-1 userName">{{ Auth::user()->name }}</h5>
                              <div class="nav flex-column nav-pills">
                                  <a class="nav-link nav-link-profile active" id="my-likes-tab" href="#" data-target="#myLikes"><i class="fa-solid fa-thumbs-up me-2"></i>Beğendiklerim ({{ count($liked_topics) }})</a>
                              </div>
                      </div>

                      <!-- Content Area -->
                      <div class="col-lg-9 ps-0 ps-md-4">
                              <div id="myLikes" class="content-section">
                                <div class="col-md-12">
                                    @if (count($liked_topics) == 0)
                                        <h5 class="mb-4">Henüz hiçbir yorum beğenmediniz.</h5>
                                    @else    
                                        @foreach ($liked_topics as $item)
                                            @php
                                                switch ($item->type) {
                                                    case 'city':
                                                        $route = route('city.topic.comments', ['slug' => $item->topic->topic_title_slug]);
                                                        $routeName = 'city.topic.comments';
                                                        break;
                                                    case 'university':
                                                        $route = route('university.topic.comments', ['slug' => $item->topic->topic_title_slug]);
                                                        $routeName = 'university.topic.comments';
                                                        break;
                                                    default:
                                                        $route = route('topic.comments', ['slug' => $item->topic->topic_title_slug]);
                                                        $routeName = 'topic.comments';
                                                }
                                            @endphp
                                            <div class="topic mb-3">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <h3 class="topic-title mb-3">
                                                        <a href="{{ $route }}" class="text-decoration-none text-dark">
                                                            {{ $item->topic->topic_title }}
                                                        </a>
                                                    </h3>
                                                    <div class="dropdown me-3">
                                                        <i class="fa-solid fa-ellipsis cursor-pointer text-muted fs-6 mt-3" role="button"
                                                        id="dropdownMenu{{ $item->topic->id }}" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $item->topic->id }}">
                                                            <li>
                                                                <a class="dropdown-item copy-link text-dark" href="#" data-link="{{ $route }}">
                                                                    <i class="fa-solid fa-link me-2"></i> Linki Kopyala
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item text-dark"
                                                                href="https://twitter.com/intent/tweet?text={{ urlencode($item->topic->topic_title . ' - ' . $route) }}"
                                                                target="_blank">
                                                                    <i class="fa-brands fa-twitter me-2"></i> Twitter’da Paylaş
                                                                </a>
                                                            </li>
                                                            @if (auth()->check() && auth()->user()->id === $item->topic->user_id)
                                                                <li><a class="dropdown-item delete-topic text-dark" href="#" data-id="{{ $item->topic->id }}" data-type="{{ $item->type }}"><i class="fa-solid fa-trash me-3"></i>Sil</a></li>                    
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>

                                                <p>{!! $item->topic->comment !!}</p>

                                                <div class="d-flex justify-content-between mt-2">
                                                    <div class="like-dislike mt-3">
                                                        <div class="like-btn d-inline me-2"
                                                            data-id="{{ $item->topic->id }}"
                                                            data-type="{{ $item->type }}"
                                                            style="cursor: pointer; color: #888;">
                                                            <i class="fa-solid fa-thumbs-up"></i>
                                                            <span class="like-count">{{ $item->topic->likes }}</span>
                                                        </div>
                                                        <div class="dislike-btn d-inline me-2"
                                                            data-id="{{ $item->topic->id }}"
                                                            data-type="{{ $item->type }}"
                                                            style="cursor: pointer; color: #888;">
                                                            <i class="fa-solid fa-thumbs-down"></i>
                                                            <span class="dislike-count">{{ $item->topic->dislikes }}</span>
                                                        </div>
                                                        <div class="d-inline">
                                                            <a href="{{ $route }}" title="Yanıtla" style="color: #555;">
                                                                <i class="fa-solid fa-reply"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="meta">
                                                        <div class="d-flex align-items-center entry-footer-bottom">
                                                            <div class="footer-info">
                                                                <div style="text-align: end;margin: -5px 0px;">
                                                                    <p style="color:#001b48;">{{ $item->topic->user->username ?? 'Anonim' }}</p>
                                                                </div>
                                                                <div style="line-height: 14px;">
                                                                    <p style="color: #888;font-size: 12px;">{{ $item->topic->created_at->format('d.m.Y H:i') }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="avatar-container">
                                                                <x-user-avatar :user="$item->topic->user" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach  
                                    @endif
                                </div>
                              </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>


@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    
    .nav-pills .nav-link {
        color: #6c757d !important;
        border-radius: 10px;
        padding: 12px 20px;
        margin: 4px 0;
        text-align: left;
        transition: all 0.3s ease;
    }

    .nav-pills .nav-link:hover {
        background-color: #f8f9fa;
    }

    .nav-pills .nav-link.active {
        background-color: #fff;
        color: #001B48 !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .form-label{
      font-weight: 600;
      font-family: monospace;
      font-size: 16px;
    }

    .dropdown-menu[data-bs-popper]{
      left: -55px;
      top: 55px;
    }

    .position-relative {
        display: flex;
        align-items: center;
    }

    @media (max-width: 768px) {
      .content-wrapper {
          padding: 0px !important;
      }
    }

</style>

<style>
     .topic {
        border: 1px solid #dcdcdc !important;
        border-radius: 17px;
        padding: 10px 20px;
        }
       
        .topic h3 a{
            margin: 0;
            font-size: 17px;
            color: #333 !important;
            text-decoration: none;
        }

        .topic h3 a:hover{
            color: #424242 !important; 
            text-decoration: underline; 
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

        .avatar{
            display: block;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-top: -2px;
            margin-bottom: 2px;
            object-fit: cover;
        }
        .footer-info{
            float: left;
            vertical-align: middle;
            padding: 4px;
            padding-right: 10px;
        }
</style>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    function getTopicUrl(type, topicId, action) {
        switch (type) {
            case 'city':
                return `/city/topic/${topicId}/${action}`;
            case 'university':
                return `/university/topic/${topicId}/${action}`;
            default:
                return `/general/topic/${topicId}/${action}`;
        }
    }

    $(document).on('click', '.like-btn', function () {
        const $this = $(this);
        const topicId = $(this).data('id');
        const type = $(this).data('type');
        const userId = '{{ auth()->id() }}';

        if (!userId) {
            toastr.error('Giriş yapmalısın.');
            return;
        }

        const likeCount = $(this).find('.like-count');
        const dislikeBtn = $(this).closest('.like-dislike').find('.dislike-btn');
        const dislikeCount = dislikeBtn.find('.dislike-count');

        $.ajax({
            url: getTopicUrl(type, topicId, 'like'),
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                likeCount.text(response.likes);
                dislikeCount.text(response.dislikes);

                if (response.removedFromLikes) {
                    $this.closest('.topic').slideUp(300, function () {
                        $(this).remove();

                        if ($('.topic').length === 0) {
                            $('.liked-topics-container').html('<h5 class="mb-4">Henüz hiçbir yorum beğenmediniz.</h5>');
                        }
                    });
                }
            }
        });
    });

    $(document).on('click', '.dislike-btn', function () {
        const $this = $(this);
        const topicId = $(this).data('id');
        const type = $(this).data('type');
        const userId = '{{ auth()->id() }}';

        if (!userId) {
            toastr.error('Giriş yapmalısın.');
            return;
        }

        const dislikeCount = $(this).find('.dislike-count');
        const likeBtn = $(this).closest('.like-dislike').find('.like-btn');
        const likeCount = likeBtn.find('.like-count');

        $.ajax({
            url: getTopicUrl(type, topicId, 'dislike'),
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                likeCount.text(response.likes);
                dislikeCount.text(response.dislikes);

                if (response.removedFromLikes) {
                    $this.closest('.topic').slideUp(300, function () {
                        $(this).remove();

                        if ($('.topic').length === 0) {
                            $('.liked-topics-container').html('<h5 class="mb-4">Henüz hiçbir yorum beğenmediniz.</h5>');
                        }
                    });
                }
            }
        });
    });
</script>


    <script>
        $(document).ready(function () {
            $(".nav-link-profile").click(function (e) {
                e.preventDefault();
                $(".nav-link-profile").removeClass("active");
                $(this).addClass("active");
                
                $(".content-section").addClass("d-none");
                let target = $(this).data("target");
                $(target).removeClass("d-none");
            });
        });
    </script>
@endsection