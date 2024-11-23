@extends('layouts.master')

@section('content')
  <form class="root-login-form" action="{{route('login')}}" method="POST">
    @csrf
    <div class="login-inner-div">
      <h1>Giriş Ekranı</h1>
      @if (Session::has('success'))
          <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
          </div>
      @endif
      @if (Session::has('error'))
          <div class="alert alert-warning" role="alert">
            {{ Session::get('error') }}
          </div>
      @endif
      <div class="input-divs">
        <input type="text"  placeholder="Kullanıcı Adı veya E-mail" name="username_email" id="username_email"/>
      </div>

      <div class="input-divs position-relative">
        <input type="password" name="password" placeholder="Şifre" id="password"/>
        <!-- Göz ikonu -->
        <span toggle="#password" class="fa fa-fw fa-eye-slash password-toggle-icon"></span>
      </div> 

      <a class="lost-password">Şifremi unuttum</a>

      <button type="submit" class="login-btn">GİRİŞ YAP</button>
      <div class="is-member-div">
        <label class="is-member">Üye değil misiniz?
          <a href="/register" class="to-join">Katılmak için tıklayınız</a>
        </label>
      </div>
    </div>
  </form>
@endsection

@section('css')
<style>
  .password-toggle-icon {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
  }

  .root-login-form {
    margin: -5em auto;
    width: 100%;
    max-width: 500px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .login-inner-div {
    background-color: #ffffff;
    box-shadow: 0 20px 30px rgba(0, 0, 0, 0.6);
    border-radius: 1em;
    padding: 2em;
    display: flex;
    flex-direction: column;
    gap: 1em;
    text-align: center;
    width: 450px;
  }

  .login-inner-div h1 {
    font-size: 1.8em;
    margin-bottom: 0.5em;
    color: #333;
  }

  .login-inner-div input {
    padding: 1em;
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

  /* :root {
    --primary-color: #001b48;
    --stratos: #001b48;
  } */
  .container-scroller, .page-body-wrapper, .content-wrapper{
          background-image: url('{{ asset('public/login_img/uni_campus.jpg') }}');
          background-position: center;
          background-size: 100%;
      }

      @media (max-width: 900px) {
        .container-scroller, .page-body-wrapper, .content-wrapper{
          background-image: url('{{ asset('public/login_img/uni_campus.jpg') }}');
          background-position: center;
          background-size: cover;
      }
  }  
</style>
@endsection

@section('js')
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
@endsection
