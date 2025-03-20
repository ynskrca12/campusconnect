@extends('layouts.master')

@section('content')

<div class="card" style="border:none !important;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
    @if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif
    <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <h2 class="introductionHeader">İçeride neler var...</h2>
        <p class="mt-5 introductionText">
         <strong>Üniversite yolculuğuna çıkarken yalnız değilsin!</strong> Platformumuzda, 
          Türkiye'nin dört bir yanından gelen öğrenci yorumlarını okuyabilir, 
          kampüs yaşamı hakkında gerçek bilgiler edinebilirsin. Üniversitelerin sunduğu imkanlar, 
          popüler bölümler ve öğrenci toplulukları gibi konularda 
          detaylı içeriklerle doğru tercihler yapmana yardımcı olacak bilgileri bir araya getirdik. 
          Ayrıca, sadece resmi bilgilere değil, öğrencilerin birebir deneyimlerine de erişebilirsin.
        </p>

        <p class="mt-5 introductionText">
         <strong> Sitemize katılarak sen de deneyimlerini paylaşabilir, merak ettiğin sorulara yanıt bulabilirsin.</strong>
          Forumlar aracılığıyla diğer üniversite adayları ve öğrencilerle fikir alışverişi yapabilir, tecrübelerini aktarabilirsin. 
          Belki de hayalini kurduğun üniversite hakkında daha önce hiç duymadığın bir detayı burada keşfedeceksin. 
          Üniversite hayatını keşfetmek ve doğru tercih yapmak için bize katıl, sen de topluluğumuzun bir parçası ol!
        </p>
      </div>
      <div class="col-md-6" style="padding: 0px 20px;">
        <h2 class="registerh2">Kayıt Ol</h2>
        <div class="mt-3">
        <form  action="{{ route('registerPost') }}" method="POST" novalidate id="registerForm">
            @csrf
            <div class="mb-2">
              <label for="email" class="form-label">Kullanıcı Adı (*)
                <i class="fas fa-question-circle info-icon" onclick="showInfo()"></i>
              </label>
              <input type="text" class="form-control registerInput" id="username" name="username" required>
            </div>
          <div class="mb-2">
            <label for="fullName" class="form-label">Ad Soyad</label>
            <input type="text" class="form-control registerInput" id="name" name="name">
          </div>
      
          <div class="mb-2">
            <label for="email" class="form-label">Email (*)
              <i class="fas fa-question-circle info-icon" onclick="showInfoEmail()"></i>
            </label>
            <input type="email" class="form-control registerInput" id="email" name="email" required>
          </div>
          <div class="mb-2">
            <label for="university" class="form-label">Üniversite</label>
            <select class="form-select registerInput" id="university" name="university" style="line-height: 20px !important">
                <option value="" selected disabled>Üniversite Seçin</option>
                @foreach($universiteler as $universite)
                    <option value="{{ $universite->universite_ad }}">{{ $universite->universite_ad }}</option>
                @endforeach
            </select>
          </div>
        
          <div class="mb-4 position-relative">
            <label for="password" class="form-label">Şifre (*)</label>
            <input type="password" class="form-control registerInput" id="password" name="password" required>
            <span toggle="#password" class="fa fa-fw fa-eye-slash password-toggle-icon"></span>
          </div>
        
          <div class="mb-4 position-relative">
              <label for="password_confirmation" class="form-label">Şifre Tekrar (*)</label>
              <input type="password" class="form-control registerInput" id="password_confirmation" name="password_confirmation" required>
              <span toggle="#password_confirmation" class="fa fa-fw fa-eye-slash password-toggle-icon"></span>
          </div>
          <div id="errorMessages"></div>

            <button type="submit" class="btn btn-primary submitBtn">
              <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
              <span class="btn-text">Kayıt Ol</span>
            </button>
        </form>
        <!-- Hata mesajları burada sabit bir alanda görünecek -->
      </div>
      </div>
      <div class="col-md-3">
        {{-- reklam --}}
      </div>
    </div>
  </div>
  </div>
@endsection

@section('css')
<style>
    .info-icon {
          cursor: pointer;
          color: #001b48;
          font-size: 16px;
          margin-left: 5px;
      }
    #errorMessages {
      margin-top: -15px;
        color: red;
        margin-bottom: 20px;
    }
    .submitBtn{
        width: 100%;
        border-radius:11px !important;
        font-size: 18px;
        font-weight: 500;
    }

    .submitBtn:hover{
      background-color: white !important;
      color: #001b48 !important;
      border: 1px solid #001b48;
    }
    .position-relative {
        position: relative;
    }

    .password-toggle-icon {
        position: absolute;
        top: 70%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #888;
    }
    .password-toggle-icon:hover {
        color: #000;
    }

    .registerInput{
      line-height: 0px !important;
      border-radius: 11px !important;
    }

    .introductionHeader{
      margin-bottom: 35px;
      font-size:26px;
      text-align: center;
      border-bottom: 7px solid #001b48;
      border-radius: 20px;
      padding: 10px 0px;
    }
    .introductionText{
      font-size: 15px;
      font-weight: 400;
    }
    .col-md-6 {
      display: flex;
      flex-direction: column;
      z-index: 1;
    }

    .form-label {
      font-weight: bold;
      color: black;
      letter-spacing: 1px;
      font-size: 15px;
    }

    .form-control {
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
    }

    .form-select {
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
    }

    .btn-primary {
      background-color: #001b48;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .registerh2{
        margin-bottom: 35px;
        font-size:26px;
        text-align: center;
        border-bottom: 7px solid #001b48;
        border-radius: 20px;
        padding: 10px 0px;
    }
    .col-md-6 h2 {
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 10px;
      color: #333;
    }

    .col-md-6 p {
      font-size: 1rem;
      color: #666;
      line-height: 2;
    }

</style>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
   $(document).ready(function () {
      // Şifre göster/gizle
      $(".password-toggle-icon").on("click", function () {
          const input = $($(this).attr("toggle"));
          if (input.attr("type") === "password") {
              input.attr("type", "text");
              $(this).removeClass("fa-eye-slash").addClass("fa-eye");
          } else {
              input.attr("type", "password");
              $(this).removeClass("fa-eye").addClass("fa-eye-slash");
          }
      });

      // Form doğrulama
      $("#registerForm").on("submit", function (e) {
          e.preventDefault();
          let isValid = true;

          // Hata mesajlarını temizle
          $("#errorMessages").empty();
          $(".error-message").remove();

          // Boş alan kontrolü
          $(this).find("input[required], select[required]").each(function () {
              const input = $(this);
              if (input.val().trim() === "") {
                  isValid = false;
                  const fieldName = input.siblings("label").text() || input.attr("placeholder");

                  // Eğer hata mesajı zaten varsa ekleme
                  if (input.next(".error-message").length === 0) {
                      input.after(`<span class="error-message" style="color: red;">${fieldName} zorunludur.</span>`);
                  }
                  
                  input.focus();
                  return false; // İlk boş alan bulunduğunda döngü sonlanır
              }
          });

          // Şifre ve şifre tekrar kontrolü
          const password = $("#password").val();
          const passwordConfirmation = $("#password_confirmation").val();
          if (password !== passwordConfirmation) {
              isValid = false;
              $("#errorMessages").append(`<div>Şifreler eşleşmiyor.</div>`);
              $("#password_confirmation").focus();
          }

          let submitBtn = $(".submitBtn");
          if (isValid) {
              // Form geçerli, butonu güncelle ve formu gönder
              submitBtn.prop("disabled", true);
              submitBtn.find(".spinner-border").removeClass("d-none");
              submitBtn.find(".btn-text").text("Kayıt Olunuyor...");
              this.submit();
          } else {
              // Form geçersizse butonu eski haline getir
              submitBtn.prop("disabled", false);
              submitBtn.find(".spinner-border").addClass("d-none");
              submitBtn.find(".btn-text").text("Kayıt Ol");
          }
    });
  });


</script>

  <script>
      function showInfo() {
          Swal.fire({
              title: 'Bilgilendirme',
              text: 'Gireceğiniz kullanıcı adı, uygulama içerisinde yapmış olduğunuz yorum ve diğer işlemlerde kullanılacaktır. Adınız ve soyadınızı sadece siz görebileceksiniz.',
              icon: 'info',
              confirmButtonText: 'Tamam'
          });
      }

      function showInfoEmail() {
        
          Swal.fire({
              title: 'Bilgilendirme',
              text: 'Geçerli bir e-posta adresi girmediğiniz takdirde hesabınızı doğrulayamaz ve sisteme giriş yapamazsınız.',
              icon: 'info',
              confirmButtonText: 'Tamam'
          });
      }
  </script>

<!-- Toastr Notification Scripts -->
<script>
  @if(session('success'))
    toastr.success("{{ session('success') }}");
  @endif

  @if(session('error'))
    toastr.error("{{ session('error') }}");
  @endif

  @if($errors->any())
    @foreach($errors->all() as $error)
      toastr.error("{{ $error }}");
    @endforeach
  @endif
</script>

@endsection
