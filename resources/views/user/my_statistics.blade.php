@extends('layouts.master')

@section('content')
  @if(session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
  @endif

  <div class="row">
      <!-- Profile Header -->
      {{-- <div class="col-12 mb-4 text-center">
         
      </div> --}}

      <!-- Main Content -->
      <div class="col-12">
          <div class="card border-0">
              <div class="card-body p-0">
                  <div class="row g-0">
                      <!-- Sidebar -->
                      <div class="col-lg-3 border-end text-center">
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
                            src="{{ $imagePath }}" class="rounded-circle profile-pic" alt="Profile Picture">
                          {{-- <button class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle">
                              <i class="fas fa-camera"></i>
                          </button> --}}
                      </div>
                      <h5 class="mt-3 mb-1 userName">{{ Auth::user()->name }}</h5>
                          <div class="p-4">
                              <div class="nav flex-column nav-pills">
                                  <a class="nav-link nav-link-profile active" id="istatistiklerim-tab" href="#" data-target="#istatistiklerim"><i class="fa-solid fa-chart-simple me-2"></i>İstatistiklerim</a>
                              </div>
                          </div>
                      </div>

                        <!-- Content Area -->
                        <div class="col-lg-9">
                            <div class="p-4">
                              <div id="istatistiklerim" class="content-section">

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <h5 class="comment-title">Etkileşim İstatistiklerim</h5>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-4 mb-3">
                                        <div class="card border-0">
                                            <div class="card-body px-1 py-2">
                                                <div class="d-flex  align-items-center ps-4">
                                                    <h5 class="m-0 fs-6">
                                                        <i class="fa-solid fa-thumbs-up me-2"></i>
                                                        Beğeni Sayısı: <span class="counter" data-target="{{ $statistics['myLikesCount'] }}">0</span>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="card border-0 ">
                                            <div class="card-body px-1 py-2">
                                                <div class="d-flex align-items-center ps-4">
                                                    <h5 class="m-0 fs-6">
                                                        <i class="fa-solid fa-comments me-2"></i>
                                                        Yorum Sayısı: <span class="counter" data-target="{{ $statistics['myCommentsCount'] }}">0</span>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-4 mb-3">
                                        <div class="card border-0">
                                            <div class="card-body px-1 py-2">
                                                <div class="d-flex  align-items-center ps-4">
                                                    <h5 class="m-0 fs-6">
                                                        <i class="fa-solid fa-thumbs-up me-2"></i>
                                                        Yorumlarımın Beğeni Sayısı: <span class="counter" data-target="{{ $statistics['myCommentsLikesCount'] }}">0</span>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Most Liked Topics --}}
                                @if ($statistics['mostLikedTopicCity'] != null || $statistics['mostLikedTopicUniversity'] != null || $statistics['mostLikedTopicGeneral'] != null)
                                <div class="row mt-5 mb-3">
                                    <div class="col-md-12">
                                        <h5 class="comment-title">En Beğenilen Yorumlarım</h5>
                                    </div>
                                </div>
                                @endif
                                {{-- mostLikedTopicCity --}}
                                @if ($statistics['mostLikedTopicCity'] != null)
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="topic mb-3 comment-section">
                                                <h3 class="topic-title mb-3">
                                                    <a href="{{ route('city.topic.comments', ['slug' => $statistics['mostLikedTopicCity']->topic_title_slug]) }}">
                                                        {{ $statistics['mostLikedTopicCity']->topic_title }}
                                                    </a>
                                                </h3>
                                                
                                                <p>{{ $statistics['mostLikedTopicCity']->comment }}</p>
                                                <div class="like-dislike mt-3">
                                                    <div class="like-btn d-inline me-3" data-id="{{ $statistics['mostLikedTopicCity']->id }}" style="cursor: pointer; color: #888;">
                                                        <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-up"></i> <span class="like-count">{{ $statistics['mostLikedTopicCity']->likes }}</span>
                                                    </div>
                                                    <div class="dislike-btn d-inline" data-id="{{ $statistics['mostLikedTopicCity']->id }}" style="cursor: pointer; color: #888;">
                                                        <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-down"></i> <span class="dislike-count">{{ $statistics['mostLikedTopicCity']->dislikes }}</span>
                                                    </div>
                                                </div>
                                                <div class="meta">
                                                    <div class="d-flex align-items-center entry-footer-bottom">
                                                        <div class="footer-info">
                                                            <div style="display: block;padding:0px 2px;text-align: end;margin: -5px 0px;">
                                                                <p style="display: block;white-space:nowrap;color:#001b48;">{{ $statistics['mostLikedTopicCity']->user->username ?? 'Anonim' }}</p>
                                                            </div>
                    
                                                            <div style="display: block;padding:1px 2px;line-height: 14px;">
                                                                <p style="color: #888;font-size: 12px;">{{ $statistics['mostLikedTopicCity']->created_at->format('d.m.Y H:i') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="avatar-container">
                                                            <x-user-avatar :user="$user" />
                                                        </div>
                                                    </div>                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                               
                                {{-- mostLikedTopicUniversity --}}
                                @if ($statistics['mostLikedTopicUniversity'] != null)
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="topic mb-3 comment-section">
                                                <h3 class="topic-title mb-3">
                                                    <a href="{{ route('university.topic.comments', ['slug' => $statistics['mostLikedTopicUniversity']->topic_title_slug]) }}">
                                                        {{ $statistics['mostLikedTopicUniversity']->topic_title }}
                                                    </a>
                                                </h3>
                                                
                                                <p>{{ $statistics['mostLikedTopicUniversity']->comment }}</p>
                                                <div class="like-dislike mt-3">
                                                    <div class="like-btn d-inline me-3" data-id="{{ $statistics['mostLikedTopicUniversity']->id }}" style="cursor: pointer; color: #888;">
                                                        <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-up"></i> <span class="like-count">{{ $statistics['mostLikedTopicUniversity']->likes }}</span>
                                                    </div>
                                                    <div class="dislike-btn d-inline" data-id="{{ $statistics['mostLikedTopicUniversity']->id }}" style="cursor: pointer; color: #888;">
                                                        <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-down"></i> <span class="dislike-count">{{ $statistics['mostLikedTopicUniversity']->dislikes }}</span>
                                                    </div>
                                                </div>
                                                <div class="meta">
                                                    <div class="d-flex align-items-center entry-footer-bottom">
                                                        <div class="footer-info">
                                                            <div style="display: block;padding:0px 2px;text-align: end;margin: -5px 0px;">
                                                                <p style="display: block;white-space:nowrap;color:#001b48;">{{ $statistics['mostLikedTopicUniversity']->user->username ?? 'Anonim' }}</p>
                                                            </div>
                    
                                                            <div style="display: block;padding:1px 2px;line-height: 14px;">
                                                                <p style="color: #888;font-size: 12px;">{{ $statistics['mostLikedTopicUniversity']->created_at->format('d.m.Y H:i') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="avatar-container">
                                                            <x-user-avatar :user="$user" />
                                                        </div>
                                                    </div>                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- mostLikedTopicGeneral --}}
                                @if ($statistics['mostLikedTopicGeneral'] != null)
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="topic mb-3 comment-section">
                                                <h3 class="topic-title mb-3">
                                                    <a href="{{ route('topic.comments', ['slug' => $statistics['mostLikedTopicGeneral']->topic_title_slug]) }}">
                                                        {{ $statistics['mostLikedTopicGeneral']->topic_title }}
                                                    </a>
                                                </h3>
                                                
                                                <p>{{ $statistics['mostLikedTopicGeneral']->comment }}</p>
                                                <div class="like-dislike mt-3">
                                                    <div class="like-btn d-inline me-3" data-id="{{ $statistics['mostLikedTopicGeneral']->id }}" style="cursor: pointer; color: #888;">
                                                        <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-up"></i> <span class="like-count">{{ $statistics['mostLikedTopicGeneral']->likes }}</span>
                                                    </div>
                                                    <div class="dislike-btn d-inline" data-id="{{ $statistics['mostLikedTopicGeneral']->id }}" style="cursor: pointer; color: #888;">
                                                        <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-down"></i> <span class="dislike-count">{{ $statistics['mostLikedTopicGeneral']->dislikes }}</span>
                                                    </div>
                                                </div>
                                                <div class="meta">
                                                    <div class="d-flex align-items-center entry-footer-bottom">
                                                        <div class="footer-info">
                                                            <div style="display: block;padding:0px 2px;text-align: end;margin: -5px 0px;">
                                                                <p style="display: block;white-space:nowrap;color:#001b48;">{{ $statistics['mostLikedTopicGeneral']->user->username ?? 'Anonim' }}</p>
                                                            </div>
                    
                                                            <div style="display: block;padding:1px 2px;line-height: 14px;">
                                                                <p style="color: #888;font-size: 12px;">{{ $statistics['mostLikedTopicGeneral']->created_at->format('d.m.Y H:i') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="avatar-container">
                                                            <x-user-avatar :user="$user" />
                                                        </div>
                                                    </div>                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
     .comment-title {
        font-size: 18px;
        font-weight: 600;
        color: #001B48;
        margin-bottom: 0px;
        margin-left: 4px;
    }
    .comment-section {
        box-shadow: rgba(0, 0, 0, 0.6) 0px 4px 7px, rgba(0, 0, 0, 0.22) 0px 11px 12px !important;
        padding: 10px 20px !important;
        border-radius: 17px;
    }
    .topic {
        padding: 10px 0;
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

<script>
    $(document).ready(function() {
        $('.counter').each(function() {
            var $this = $(this),
                target = parseInt($this.attr('data-target')),
                count = 0,
                speed = 50, // Sayma hızını ayarlar
                step = Math.ceil(target / 50); // Adım büyüklüğü (50 adımda tamamlanır)

            function updateCount() {
                count += step;
                if (count >= target) {
                    count = target;
                    clearInterval(timer);
                }
                $this.text(count);
            }

            var timer = setInterval(updateCount, speed);
        });
    });
</script>

@endsection