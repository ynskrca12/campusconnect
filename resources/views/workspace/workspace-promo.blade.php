@extends('layouts.master')

@section('content')
<style>
    .feature-icon {
        width: 60px;
        height: 60px;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 28px;
        color: #007bff;
        transition: transform 0.3s;
    }

    .feature-icon:hover {
        transform: scale(1.1);
    }

    .fade-up {
        animation: fadeUp 1s ease-in-out;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container pb-5">
    <div class="row align-items-center mb-5">
        <div class="col-md-6 fade-up">
            <img src="{{ asset('/assets/images/workspace/workspace_intro.png') }}" class="img-fluid" alt="Çalışma Alanı">
        </div>
        <div class="col-md-6 fade-up">
            <h2 class="fw-bold mb-3">Görevlerini Yönet, Zamanını Planla!</h2>
            <p class="text-muted fs-5">
                Kendi kampüs ajandanı oluşturabileceğin, görevlerini planlayabileceğin, yaklaşan etkinlikleri takip edebileceğin bir alan seni bekliyor.
            </p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg mt-3">Şimdi Kaydol ve Başla</a>
        </div>
    </div>

    <div class="text-center mb-5 fade-up">
        <h3 class="fw-bold">Neler Sunuyoruz?</h3>
        <p class="text-muted">Sana özel bir öğrenci ajandası deneyimi:</p>
    </div>

    <div class="row text-center g-4 fade-up">
        <div class="col-md-4">
            <div class="feature-icon mx-auto mb-3"><i class="fas fa-tasks"></i></div>
            <h5>Görev Yönetimi</h5>
            <p class="text-muted">Ders, proje ve kişisel görevlerini kolayca oluştur ve takip et.</p>
        </div>
        <div class="col-md-4">
            <div class="feature-icon mx-auto mb-3"><i class="fas fa-calendar-alt"></i></div>
            <h5>Takvim Entegrasyonu</h5>
            <p class="text-muted">Tüm görev ve etkinliklerini haftalık ya da aylık görünümde planla.</p>
        </div>
        <div class="col-md-4">
            <div class="feature-icon mx-auto mb-3"><i class="fas fa-bell"></i></div>
            <h5>Hatırlatmalar</h5>
            <p class="text-muted">Önemli görevlerin yaklaşınca sana bildirimle haber verelim.</p>
        </div>
    </div>

    <div class="row align-items-center mt-5 fade-up">
        <div class="col-md-6 order-md-2">
            <img src="{{ asset('/assets/images/workspace/student_task.png') }}" class="img-fluid" alt="Öğrenci Görevleri">
        </div>
        <div class="col-md-6 order-md-1">
            <h3 class="fw-bold mb-3">Neden Kullanmalısın?</h3>
            <ul class="list-unstyled text-muted fs-5">
                <li><i class="fas fa-check text-success me-2"></i> Üniversite hayatını organize etmek daha kolay</li>
                <li><i class="fas fa-check text-success me-2"></i> Akademik ve kişisel hedeflerine ulaşmanda yardımcı</li>
                <li><i class="fas fa-check text-success me-2"></i> Toplulukla birlikte üretmek ve planlamak mümkün</li>
            </ul>
        </div>
    </div>

    <div class="text-center mt-5 fade-up">
        <h4 class="fw-semibold">Hazırsan, kendine özel ajandanı oluşturmaya başla!</h4>
        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg mt-3">Giriş Yap</a>
    </div>
</div>
@endsection
