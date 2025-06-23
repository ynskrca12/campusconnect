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
                    <div class="col-lg-3 text-center">
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

        <img src="{{ $imagePath }}" 
             class="rounded-circle profile-pic" 
             alt="Profile Picture"
             style="background-color: {{ $bgColor }}; width: 70px; height: 70px; object-fit: cover;">

        <button class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle" data-bs-toggle="modal" data-bs-target="#profileImageModal">
            <i class="fas fa-camera"></i>
        </button>
    </div>

    <h5 class="mt-3 mb-1 userName">{{ $user->name }}</h5>

    <div class="p-4">
        <div class="nav flex-column nav-pills">
            <a class="nav-link nav-link-profile active" id="bilgilerim-tab" href="#" data-target="#bilgilerim"><i class="fas fa-user me-2"></i>Bilgilerim</a>
        </div>
    </div>
</div>

<!-- Profil Resim Güncelleme Modal -->
<div class="modal fade" id="profileImageModal" tabindex="-1" aria-labelledby="profileImageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('profile.image.update') }}" method="POST" enctype="multipart/form-data" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="profileImageModalLabel">Profil Resmini Güncelle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
      </div>
      <div class="modal-body">
        <input type="file" name="user_image" accept="image/*" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
      </div>
    </form>
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