@extends('layouts.master')

@section('content')
<div class="container" style="display: flex;justify-content: center;">
  <form class="root-login-form mt-2 mb-3" action="{{route('admin.login.post')}}" method="POST" id="loginForm">
    @csrf
    <div class="login-inner-div">
      <h1 class="mt-4">Giriş Yap</h1>
      <div class="input-divs">
        <input type="text"  placeholder="Kullanıcı Adı veya E-mail" name="admin_email" id="admin_email" required/>
      </div>

      <div class="input-divs position-relative">
        <input type="password" name="password" placeholder="Şifre" id="password"/>
        <!-- Göz ikonu -->
        <span toggle="#password" class="fa fa-fw fa-eye-slash password-toggle-icon"></span>
      </div> 


      <button type="submit" class="login-btn">
        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
        <span class="btn-text">Giriş Yap</span>
      </button>
    </div>
  </form>
</div>


@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
   .primary-color {
        color: #001b48;
    }
    .secondary-color {
        color: #87ceeb;
    }
   .navbar.fixed-top + .page-body-wrapper {
        padding: 60px 0px 0px 0px !important;
    }
    .content-wrapper {
        padding: 0px !important;
    }
  .password-toggle-icon {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
  }

  .root-login-form {
    width: 100%;
    max-width: 700px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .login-inner-div {
    background-color: #ffffff;
    padding: 2em;
    display: flex;
    flex-direction: column;
    gap: 1em;
    text-align: center;
    width: 80%;
  }

  .login-inner-div h1 {
    font-size: 1.8em;
    margin-bottom: 0.5em;
    color: #333;
  }

  .login-inner-div input {
    padding: 12px 20px;
    border: 1px solid #ccc;
    border-radius: 0.4em;
    margin: 0.5em 0;
    width: 100%;
    transition: border-color 0.3s;
  }

  .login-inner-div input:focus {
    outline: none;
    border-color: #001b48;
  }

  .lost-password {
    font-size: 0.9em;
    color: #001b48;
    text-decoration: none;
    margin-top: 0;
    align-self: flex-end;
    cursor: pointer;
  }

  .lost-password:hover {
    color: #4565ab;
  }

  .login-btn {
    margin: 1em 0;
    border-radius: 0.5em;
    padding: 0.8em 2em;
    background-color: #001b48;
    color: #fff;
    font-weight: 600;
    letter-spacing: 2px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .login-btn:hover {
    background-color: #002d6e;
  }

  .is-member-div {
    margin-top: 1em;
    font-size: 0.9em;
    color: #333;
  }

  .to-join {
    color: #001b48;
    font-weight: 600;
    text-decoration: underline;
    margin-left: 0.5em;
    transition: color 0.3s;
  }

  .to-join:hover {
    color: #002d6e;
  }

      @media (max-width: 900px) {
        .container-scroller, .page-body-wrapper, .content-wrapper{
          background-position: center;
          background-size: cover;
      }
      .login-inner-div {
        padding: 2em 0em;
      }
  }  
</style>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
    $(document).ready(function () {
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.warning("{{ $error }}");
            @endforeach
        @endif

    });
</script>
 <script>
  $(document).ready(function() {
    // Göz ikonuna tıklandığında şifreyi görünür yapma
    $(".password-toggle-icon").click(function() {
      // Şifre inputu
      var passwordField = $("#password");

      // Eğer şifre gizli ise, görünür yap
      if (passwordField.attr("type") === "password") {
        passwordField.attr("type", "text");
        $(this).removeClass("fa-eye-slash").addClass("fa-eye");  // Göz ikonunu değiştir
      } else {
        passwordField.attr("type", "password");
        $(this).removeClass("fa-eye").addClass("fa-eye-slash");  // Göz ikonunu geri değiştir
      }
    });
  });

</script>

<script>
  $(document).ready(function() {
    $('#loginForm').submit(function() {
      let loginBtn = $('.login-btn');
      loginBtn.prop('disabled', true);
      loginBtn.find('.spinner-border').removeClass('d-none');
      loginBtn.find('.btn-text').text('Giriş Yapılıyor...');
    })
  })
</script>
@endsection
