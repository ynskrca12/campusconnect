@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold text-custom mb-3">Eğitim ve Yaşam Platformumuz</h2>
    <p class="text-muted custom-description  mb-5">Öğrenciler ve adaylar için sunduğumuz geniş kapsamlı hizmetlerle, eğitim hayatınızda ve şehirdeki yaşamınızı daha kolay ve verimli hale getirin. Üniversite bilgileri, şehir yaşamı, sosyal etkinlikler ve daha fazlası ile aradığınız tüm bilgilere tek bir platformda ulaşın.</p>
    
    <!-- Üniversite Hizmetleri -->
    <h3 class="text-secondary mt-4 mb-3"><i class="fas fa-university text-primary" style="margin-right: 6px;"></i> Üniversite Seçimi ve Eğitim Olanakları</h3>
    <div class="row">
        <div class="col-md-4 animate-fade-in">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-info-circle fa-2x text-primary"></i>
                    <h5 class="mt-2">Genel Bilgiler</h5>
                    <p>Üniversiteler hakkında kapsamlı bilgi ve kaynak edinin.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate-fade-in">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-comments fa-2x text-primary"></i>
                    <h5 class="mt-2">Soru-Cevap</h5>
                    <p>Öğrencilerle ve akademisyenlerle bilgi paylaşımı yapın.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate-fade-in">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-tree fa-2x text-primary"></i>
                    <h5 class="mt-2">Kampüs Hayatı</h5>
                    <p>Sosyal alanlar ve kampüs içi yaşam hakkında bilgi edinin.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate-fade-in">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-book fa-2x text-primary"></i>
                    <h5 class="mt-2">Eğitim Kalitesi</h5>
                    <p>Akademik olanaklar, ders içerikleri ve eğitim fırsatlarını detaylı inceleyin.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate-fade-in">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-bus fa-2x text-primary"></i>
                    <h5 class="mt-2">Ulaşım</h5>
                    <p>Üniversite içi ve şehir içi ulaşım imkanlarını keşfedin.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate-fade-in">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-alt fa-2x text-primary"></i>
                    <h5 class="mt-2">Etkinlikler</h5>
                    <p>Üniversitedeki sosyal ve akademik etkinliklere göz atın.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Şehir Hizmetleri -->
    <h3 class="text-secondary mt-5 mb-3"><i class="fas fa-city text-primary" style="margin-right: 6px;"></i> Şehirdeki Yaşam ve İmkanlar</h3>
    <div class="row mb100">
        <div class="col-md-4 animate-fade-in">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-subway fa-2x text-primary"></i>
                    <h5 class="mt-2">Ulaşım</h5>
                    <p>Toplu taşıma ve şehir içi ulaşım bilgilerini öğrenin.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate-fade-in">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-glass-cheers fa-2x text-primary"></i>
                    <h5 class="mt-2">Eğlence</h5>
                    <p>Şehirdeki sosyal ve eğlence mekanlarını keşfedin.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate-fade-in">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-money-bill-wave fa-2x text-primary"></i>
                    <h5 class="mt-2">Yaşam Maliyeti</h5>
                    <p>Şehirdeki konaklama ve yaşam maliyetlerini inceleyin.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate-fade-in">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-hospital fa-2x text-primary"></i>
                    <h5 class="mt-2">Sağlık Hizmetleri</h5>
                    <p>Şehirdeki hastaneler, poliklinikler ve sağlık hizmetleri hakkında bilgi edinin.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate-fade-in">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-shopping-bag fa-2x text-primary"></i>
                    <h5 class="mt-2">Alışveriş</h5>
                    <p>Şehirdeki alışveriş merkezleri, çarşılar ve marketler hakkında bilgi alın.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate-fade-in">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-landmark fa-2x text-primary"></i>
                    <h5 class="mt-2">Tarihi ve Kültürel Yerler</h5>
                    <p>Şehirdeki tarihi mekanları ve kültürel etkinlikleri keşfedin.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('css')
<style>
    .text-custom {
        color: #001b48; 
    }
   .animate-fade-in {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 1s ease-in-out forwards;
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        border: 1px solid #cfcfcf !important;
        border-radius: 17px !important;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }
    .card i {
        font-size: 2rem;
    }
    .card h5 {
        margin-top: 1rem;
    }
    .card p {
        flex-grow: 1;
        margin-top: 1rem;
    }
    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .col-md-4 {
        display: flex;
        justify-content: center;
        align-items: stretch;
        margin-bottom: 1rem;
        padding: 0 1rem;
        flex: 1 1 calc(33.333% - 2rem); /* 3 columns on medium screens */
    }
    @media (max-width: 768px) {
        h3{
            font-size: 1.5rem;
            margin-left: 6px;

        }
        .col-md-4 {
            flex: 1 1 calc(50% - 2rem); /* 2 columns on smaller screens */
        }
    }
    @media (max-width: 576px) {
        .col-md-4 {
            flex: 1 1 100%; /* 1 column on extra small screens */
        }
    }

    .mb100{
        margin-bottom: 100px;
    }
    .navbar.fixed-top + .page-body-wrapper {
        padding: 63px 0px 0px 0px !important;
    }
    .content-wrapper {
        padding: 0px !important;
    }
    .custom-description {
        font-size: 1.2rem;
        line-height: 1.8;
        color: #6c757d;
        margin: 0 auto;
        padding: 10px 0px;
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
