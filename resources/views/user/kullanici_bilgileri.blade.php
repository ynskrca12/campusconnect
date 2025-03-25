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
          <div class="card border-0 shadow-sm">
              <div class="card-body p-0">
                  <div class="row g-0">
                      <!-- Sidebar -->
                      <div class="col-lg-3 border-end text-center">
                        <div class="position-relative d-inline-block">
                          <img src="{{ asset('assets/images/user.png') }}" class="rounded-circle profile-pic" alt="Profile Picture" style="width: 70px;">
                          <button class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle">
                              <i class="fas fa-camera"></i>
                          </button>
                      </div>
                      <h5 class="mt-3 mb-1 userName">{{ Auth::user()->name }}</h5>
                          <div class="p-4">
                              <div class="nav flex-column nav-pills">
                                  <a class="nav-link nav-link-profile active" id="bilgilerim-tab" href="#" data-target="#bilgilerim"><i class="fas fa-user me-2"></i>Bilgilerim</a>
                                  <a class="nav-link nav-link-profile" id="istatistiklerim-tab" href="#" data-target="#istatistiklerim"><i class="fas fa-chart-line me-2"></i>İstatistiklerim</a>
                                  <a class="nav-link nav-link-profile" id="my-likes-tab" href="#" data-target="#myLikes"><i class="fa-solid fa-thumbs-up me-2"></i>Beğendiklerim</a>
                              </div>
                          </div>
                      </div>

                      <!-- Content Area -->
                      <div class="col-lg-9">
                          <div class="p-4">
                              <div id="bilgilerim" class="content-section">
                                  <h5 class="mb-4">Bilgilerim</h5>
                                  <div class="row g-3">
                                      <div class="col-md-6">
                                          <label class="form-label">Kullanıcı Adı</label>
                                          <div class="position-relative">
                                            <input type="text" class="form-control" name="username" value="{{$user->username}}" readonly>
                                            <i class="fas fa-edit edit-icon" data-bs-toggle="modal" data-bs-target="#editUsernameModal"></i>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <label class="form-label">Ad Soyad</label>
                                          <div class="position-relative">
                                            <input type="text" class="form-control" name="name" value="{{$user->name}}" readonly>
                                            <i class="fas fa-edit edit-icon" data-bs-toggle="modal" data-bs-target="#editNameModal"></i>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                          <label class="form-label">E-Posta</label>
                                          <div class="position-relative">
                                            <input type="email" class="form-control" name="email" value="{{$user->email}}" readonly>
                                            <i class="fas fa-edit edit-icon" data-bs-toggle="modal" data-bs-target="#editEmailModal"></i>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <label class="form-label">Üniversite</label>
                                          <div class="position-relative">
                                            <input type="text" class="form-control" name="university" value="{{$user->university}}" readonly>
                                            <i class="fas fa-edit edit-icon" data-bs-toggle="modal" data-bs-target="#editUniversityModal"></i>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              
                              <div id="istatistiklerim" class="content-section d-none">
                                  <h5 class="mb-4">İstatistiklerim</h5>
                                  {{-- <ul class="list-group">
                                      <li class="list-group-item">Beğendiğim yorumlar: <span id="liked-comments-count">15</span></li>
                                      <li class="list-group-item">Toplam yaptığım yorumlar: <span id="total-comments-count">30</span></li>
                                      <li class="list-group-item">Yorumlarımın aldığı beğeni sayısı: <span id="my-comments-likes">45</span></li>
                                      <li class="list-group-item">Yorumlarıma yapılan yanıt sayısı: <span id="my-comments-replies">10</span></li>
                                  </ul> --}}

                                  <div class="d-flex flex-column align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-spinner fa-spin fa-3x text-primary mb-3"></i>
                                    <p class="text-muted">Yakında tüm istatistikler burada olacak...</p>
                                </div>
                              </div>

                              <div id="myLikes" class="content-section d-none">
                                <div class="col-md-10">
                                    @if (count($liked_topics) == 0)
                                        <h5 class="mb-4">Henüz hiçbir yorum beğenmediniz.</h5>
                                    @else    
                                        <h5 class="mb-4">Toplam {{ count($liked_topics) }} favori yorumunuz var.</h5>
                                        @foreach ($liked_topics as $item)   
                                            <div class="topic mb-3">
                                                <h3 class="topic-title mb-3">
                                                    <a href="{{ route('topic.comments', ['slug' => $item->topic->topic_title_slug]) }}">
                                                        {{ $item->topic->topic_title }}
                                                    </a>
                                                </h3>
                                                
                                                <p>{{ $item->topic->comment }}</p>
                                                <div class="like-dislike mt-3">
                                                    <div class="like-btn d-inline me-3" data-id="{{ $item->topic->id }}" style="cursor: pointer; color: #888;">
                                                        <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-up"></i> <span class="like-count">{{ $item->topic->likes }}</span>
                                                    </div>
                                                    <div class="dislike-btn d-inline" data-id="{{ $item->topic->id }}" style="cursor: pointer; color: #888;">
                                                        <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-down"></i> <span class="dislike-count">{{ $item->topic->dislikes }}</span>
                                                    </div>
                                                </div>
                                                <div class="meta">
                                                    <div class="d-flex align-items-center entry-footer-bottom">
                                                        <div class="footer-info">
                                                            <div style="display: block;padding:0px 2px;text-align: end;margin: -5px 0px;">
                                                                <p style="display: block;white-space:nowrap;color:#001b48;">{{ $item->user->username ?? 'Anonim' }}</p>
                                                            </div>
                    
                                                            <div style="display: block;padding:1px 2px;line-height: 14px;">
                                                                <p style="color: #888;font-size: 12px;">{{ $item->topic->created_at->format('d.m.Y H:i') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="avatar-container">
                                                            <a href="">
                                                                <img class="avatar" 
                                                                style="background-color: {{$item->user->user_image == 'man.png' ? '#95bdff' : ($item->user->user_image == 'woman.png' ? '#ffbdd3' : 'transparent')}};"
                                                                src="{{ asset('assets/images/icons/' . ($item->user->user_image ?? '//ekstat.com/img/default-profile-picture-light.svg')) }}"
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

    <!-- Modals -->
    @php
        $fields = [
            'Username' => 'Kullanıcı Adı',
            'Name' => 'Ad Soyad',
            'Email' => 'E-Posta',
            'University' => 'Üniversite'
        ];
    @endphp

    @foreach($fields as $field => $label)
    <div class="modal fade" id="edit{{$field}}Modal" tabindex="-1" aria-labelledby="edit{{$field}}ModalLabel" data-current-value="{{$user->{strtolower($field)} }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit{{$field}}ModalLabel">{{ $label }} Güncelle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="edit-modal-form" data-field="{{ strtolower($field) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Yeni {{ $label }}</label>
                            <div class="position-relative">
                                @if($field === 'University')
                                    <select class="form-control value-input" name="value">
                                        <option value="">Seçiniz</option>
                                        @foreach($universities as $university)
                                            <option value="{{ $university->universite_ad }}" {{ $user->university === $university->universite_ad ? 'selected' : '' }}>
                                                {{ $university->universite_ad }}
                                            </option>
                                        @endforeach
                                    </select>
                                @elseif ($field === 'Email')
                                    <input type="email" class="form-control value-input" name="value" value="{{ $user->email }}" required>
                                    <i class="fas fa-check-circle text-success" style="display: none; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);" id="email-check-icon"></i>
                                    <i class="fas fa-times-circle text-danger" style="display: none; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);" id="email-error-icon"></i>
                                @else
                                    <input type="text" class="form-control value-input" name="value" value="{{ $user->{strtolower($field)} }}">
                                @endif
                                <i class="fas fa-check-circle text-success" style="display: none; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);" id="username-check-icon"></i>
                                <i class="fas fa-times-circle text-danger" style="display: none; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);" id="username-error-icon"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach


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

    .edit-icon {
      margin-left: -25px;
      cursor: pointer;
      color: #001b48;
      font-size: 18px;
    }

    .edit-icon:hover {
        color: #0056b3;
    }

    @media (max-width: 768px) {
      .content-wrapper {
          padding: 0px !important;
      }
    }

</style>

<style>
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

    {{-- update user info --}}
    <script>
        $(document).ready(function () {
            $(".edit-modal-form").submit(function (e) {
                e.preventDefault();

                let form = $(this);
                let field = form.data("field");
                console.log('field:'+field)
                let value = form.find(".value-input").val(); 
                let modal = form.closest(".modal");

                if (field === 'email') {
                    $.ajax({
                        url: "{{ route('user.profile.update.email') }}",  
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            field: field,
                            value: value
                        },
                        success: function (response) {
                            if (response.status === "success") {
                                toastr.success(response.message);
                                console.log(response.value)
                                // E-posta başarıyla güncellenirse
                                // $(`input[name="${field}"]`).val(response.value);
                                modal.modal("hide");
                            }
                        },
                        error: function (xhr) {
                            toastr.error("Güncelleme başarısız! Lütfen tekrar deneyin.");
                        }
                    });
                }
                else{
                    $.ajax({
                        url: "{{ route('user.updateProfile') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            field: field,
                            value: value
                        },
                        success: function (response) {
                            if (response.status === "success") {
                                toastr.success(response.message);
                                console.log(response.value)
                                $(`input[name="${field}"]`).val(response.value);
                                if(field == 'name'){
                                    $('.userName').text(response.value);
                                }
                                modal.modal("hide");
                            }
                        },
                        error: function (xhr) {
                            toastr.error("Güncelleme başarısız! Lütfen tekrar deneyin.");
                        }
                    });
                }
            });
        });


    </script>

    {{-- check username --}}
    <script>
        $(document).ready(function () {
            $(".value-input").on("input", function () {
                let usernameInput = $(this);
                let username = usernameInput.val();
                let checkIcon = $("#username-check-icon");
                let errorIcon = $("#username-error-icon");

                if (username) {
                    $.ajax({
                        url: "{{ route('user.checkUsername') }}", 
                        type: "GET",
                        data: {
                            username: username
                        },
                        success: function (response) {
                            if (response.exists) {
                                
                                errorIcon.show();
                                checkIcon.hide();
                            } else {
                                checkIcon.show();
                                errorIcon.hide();
                            }
                        },
                        error: function () {
                            errorIcon.hide();
                            checkIcon.hide();
                        }
                    });
                } else {
                    checkIcon.hide();
                    errorIcon.hide();
                }
            });
        });


    </script>

    {{-- check user email --}}
    <script>
       
        $('input[name="value"]').on('input', function() {
            const email = $(this).val();
            const checkIcon = $('#email-check-icon');
            const errorIcon = $('#email-error-icon');
            const errorMessage = $('#email-error-message');

            $.ajax({
                url: '/profile/check-email',
                method: 'GET',
                data: { email: email },
                success: function(data) {
                    if (data.available) {
                        checkIcon.show(); 
                        errorIcon.hide();
                        errorMessage.hide();
                    } else {
                        checkIcon.hide();
                        errorIcon.show();  
                        errorMessage.show();
                    }
                },
                error: function() {
                    errorIcon.hide();
                    errorMessage.hide();
                    checkIcon.hide();
                }
            });
        });

    </script>
@endsection