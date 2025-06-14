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
          <div class="card border-0 shadow-sm">
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
                            src="{{ $imagePath }}"
                            class="rounded-circle profile-pic" alt="Profile Picture" >
                          {{-- <button class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle">
                              <i class="fas fa-camera"></i>
                          </button> --}}
                      </div>
                      <h5 class="mt-3 mb-1 userName">{{ Auth::user()->name }}</h5>
                          <div class="p-4">
                              <div class="nav flex-column nav-pills">
                                  <a class="nav-link nav-link-profile active" id="my-comments-tab" href="#" data-target="#myComments"><i class="fa-solid fa-comments me-2"></i>Yorumlarım ({{ count($my_comments) }})</a>
                              </div>
                          </div>
                      </div>

                      <!-- Content Area -->
                      <div class="col-lg-9">
                          <div class="p-4">
                              
                              <div id="myComments" class="content-section">
                                <div class="col-md-10">
                                    @if (count($my_comments) == 0)
                                        <h5 class="mb-4">Henüz hiçbir yorum yapmadınız @if (Auth::user()->gender == 'male')
                                                beyefendi
                                            @elseif(Auth::user()->gender == 'female')
                                                hanımefendi
                                            @endif
                                        </h5>
                                    @else    
                                        @foreach ($my_comments as $item)   
                                            @php
                                                switch ($item->type) {
                                                    case 'city':
                                                        $route = route('city.topic.comments', ['slug' => $item->topic_title_slug]);
                                                        break;
                                                    case 'university':
                                                        $route = route('university.topic.comments', ['slug' => $item->topic_title_slug]);
                                                        break;
                                                    default:
                                                        $route = route('topic.comments', ['slug' => $item->topic_title_slug]);
                                                }
                                            @endphp
                                            <div class="topic mb-3">
                                                <h3 class="topic-title mb-3">
                                                    <a href="{{ $route }}">
                                                        {{ $item->topic_title }}
                                                    </a>
                                                </h3>
                                                
                                                <p>{{ $item->comment }}</p>
                                                <div class="like-dislike mt-3">
                                                    <div class="like-btn d-inline me-3" data-id="{{ $item->id }}" style="cursor: pointer; color: #888;">
                                                        <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-up"></i> <span class="like-count">{{ $item->likes }}</span>
                                                    </div>
                                                    <div class="dislike-btn d-inline" data-id="{{ $item->id }}" style="cursor: pointer; color: #888;">
                                                        <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-down"></i> <span class="dislike-count">{{ $item->dislikes }}</span>
                                                    </div>
                                                </div>
                                                <div class="meta">
                                                    <div class="d-flex align-items-center entry-footer-bottom">
                                                        <div class="footer-info">
                                                            <div style="display: block;padding:0px 2px;text-align: end;margin: -5px 0px;">
                                                                <p style="display: block;white-space:nowrap;color:#001b48;">{{ $item->user->username ?? 'Anonim' }}</p>
                                                            </div>
                    
                                                            <div style="display: block;padding:1px 2px;line-height: 14px;">
                                                                <p style="color: #888;font-size: 12px;">{{ $item->created_at->format('d.m.Y H:i') }}</p>
                                                            </div>
                                                        </div>
                                                        @php 
                                                            $imageName = $item->user->user_image;
                                                            
                                                            $imagePath = $imageName
                                                                ? asset('storage/profile_images/' . $imageName)
                                                                : asset('assets/images/icons/user.png');
                                                            
                                                            $bgColor = match ($imageName) {
                                                                'man.png' => '#95bdff',
                                                                'woman.png' => '#ffbdd3',
                                                                default => 'transparent',
                                                            };
                                                        @endphp  
                                                        <div class="avatar-container">
                                                            <a href="">
                                                                <img class="avatar" 
                                                                style="background-color: {{ $bgColor }};"
                                                                src="{{ $imagePath }}"
                                                                data-default="{{ asset('img/default-profile-picture-light.svg') }}" 
                                                                alt="usuyensolucan" title="usuyensolucan">
                                                            </a>
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
        box-shadow: rgba(0, 0, 0, 0.6) 0px 4px 7px, rgba(0, 0, 0, 0.22) 0px 11px 12px !important;
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