@extends('layouts.master')
@section('content')
    @if (Session::has('info'))
        <div class="alert alert-info" role="alert">
            {{ Auth::user()->name }}   {{ Session::get('info') }}
        </div>
    @endif
    <div class="info-section mb-4">
        <div class="overlay"></div>
        <div class="info-content">
            <h2 class="animated-title">Üniversite & Şehir Rehberine Hoş Geldiniz</h2>
            <p class="animated-text">
                Üniversite öğrencileri ve adayları için, şehirler ve üniversiteler hakkında en güncel bilgileri 
                bulabileceğiniz, öğrenci yorumlarını okuyabileceğiniz ve forumlarda tartışmalara katılabileceğiniz 
                interaktif bir platform sunuyoruz.
            </p>
            <a href="{{ route('forum') }}" class="btn  btn-animated">Keşfetmeye Başla</a>
        </div>
    </div>
    <div class="">
      
        
        <div class="row mb-4 mt-4" style="margin-top: 40px !important;">
          
            <div class="col-12">
                <div class="university-slider">
                    <div class="logos">
                        @foreach (File::glob(public_path('university logos') . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE) as $image)
                            <div class="logo-item">
                                <img src="{{ asset('university logos/' . basename($image)) }}" class="img-fluid" alt="Üniversite Logosu">
                            </div>
                        @endforeach
                        @foreach (File::glob(public_path('university logos') . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE) as $image)
                            <div class="logo-item">
                                <img src="{{ asset('university logos/' . basename($image)) }}" class="img-fluid" alt="Üniversite Logosu">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
       
    </div>
@endsection

@section('css')
<style>  
    /* .container-scroller, .page-body-wrapper, .content-wrapper {
        background-image: url('{{ asset('home_img/background.jpg') }}');
        background-position: center;
        background-size: cover;
    } */

    .navbar.fixed-top + .page-body-wrapper {
    padding: 63px 0px 0px 0px !important;
}
.content-wrapper {
    padding: 0px !important;
}

</style>

<style>
    .university-slider {
        overflow: hidden;
        position: relative;
        width: 100%;
        background: rgba(255, 255, 255, 0.8);
        padding: 10px;
        border-radius: 10px;
    }
    
    .logos {
        display: flex;
        width: max-content;
        animation: slide 20s linear infinite;
    }
    
    .logo-item {
        flex: 0 0 auto;
        width: 120px;
        margin-right: 20px;
    }
    
    .logo-item img {
        width: 100%;
        max-height: 100px;
        object-fit: contain;
        border-radius: 10px;
    }

    @keyframes slide {
        from { transform: translateX(0); }
        to { transform: translateX(-50%); } 
    }

  
</style>

<style>
     .info-section {
        position: relative;
        width: 100%;
        height: 400px;
        /* background-image: url('https://source.unsplash.com/1600x900/?university,students'); */
        background: linear-gradient(to right, #1e3c72, #2a5298);
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 20px;
        overflow: hidden;
        /* border-radius: 17px; */
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #001b48;
    }

    .info-content {
        position: relative;
        color: #fff;
        z-index: 2;
        max-width: 800px;
        animation: fadeIn 1.5s ease-in-out;
    }

    .info-content h2 {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 15px;
        animation: slideInDown 1s ease-in-out;
    }

    .info-content p {
        font-size: 16px;
        margin-bottom: 20px;
        animation: slideInUp 1s ease-in-out;
    }

    .btn-animated {
        font-size: 18px;
        padding: 10px 20px;
        background: #87ceeb;
        border: none;
        color: #001b48;
        text-decoration: none;
        transition: transform 0.3s ease-in-out, background 0.3s ease-in-out;
    }

    .btn-animated:hover {
        transform: scale(1.1);
        background: #4682b4;
        color: #fff;
    }
    @media (max-width: 768px) {
        .info-content h2 {
            font-size: 26px !important; 
        }
        .info-content p {
            font-size: 14px !important;
        }

        .navbar.fixed-top + .page-body-wrapper {
            padding: 56px 0px 0px 0px !important;
        }
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        var copy = $(".logos").clone();
        $(".university-slider").append(copy);
    });
</script>

