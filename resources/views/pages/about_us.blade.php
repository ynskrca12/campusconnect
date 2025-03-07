@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold text-primary mb-4 mt-5">Biz Kimiz?</h2>
            <p class="text-muted">
                Üniversite adayları ve öğrencileri için bilgi paylaşımını kolaylaştıran, kampüs hayatı, bölümler,
                şehirler ve sosyal imkanlar hakkında fikir alışverişi yapabileceğiniz bir platformuz.
                Amacımız, öğrenci topluluğunu bir araya getirerek bilgiye ulaşımı kolaylaştırmaktır.
            </p>
            <p class="text-muted">
                Öğrencilerin merak ettiği sorulara cevap bulmasını, üniversite seçiminde daha bilinçli kararlar
                almasını ve şehir hayatına dair önemli bilgileri keşfetmesini sağlıyoruz. Topluluk temelli bir yapı
                ile kullanıcılarımızın deneyimlerini paylaşmasına olanak tanıyor, akademik ve sosyal hayat
                konusunda rehberlik ediyoruz. Sen de bu ailenin bir parçası ol ve deneyimlerini paylaş!
            </p>
        </div>
        <div class="col-md-6 text-center">
            <img src="/assets/images/about_us.jpg" alt="Hakkımızda" class="img-fluid animate-fade-in">
        </div>
    </div>
</div>

<div class="container mt-5 text-center mb100">
    <h2 class="fw-bold text-primary mb-5">Neden Biz?</h2>
    <div class="row mt-4">
        <div class="col-md-4 animate-fade-in mb-4">
            <i class="fas fa-users fa-3x text-primary"></i>
            <h5 class="mt-3">Öğrenci Topluluğu</h5>
            <p class="text-muted">Gerçek öğrencilerden gerçek deneyimler.</p>
        </div>
        <div class="col-md-4 animate-fade-in mb-4" style="animation-delay: 0.2s;">
            <i class="fas fa-graduation-cap fa-3x text-primary"></i>
            <h5 class="mt-3">Eğitim ve Bölümler</h5>
            <p class="text-muted">Üniversiteler ve bölümler hakkında doğru bilgiler.</p>
        </div>
        <div class="col-md-4 animate-fade-in mb-4" style="animation-delay: 0.4s;">
            <i class="fas fa-city fa-3x text-primary"></i>
            <h5 class="mt-3">Şehir Rehberi</h5>
            <p class="text-muted">Yaşayacağınız şehir hakkında her şey burada.</p>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .mb100{
        margin-bottom: 100px;
    }
    .navbar.fixed-top + .page-body-wrapper {
        padding: 63px 0px 0px 0px !important;
    }
    .content-wrapper {
        padding: 0px !important;
    }
    .animate-fade-in {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.8s ease-in-out forwards;
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('.animate-fade-in').each(function (i) {
            $(this).css('animation-delay', (i * 0.2) + 's');
        });
    });
</script>
@endsection
