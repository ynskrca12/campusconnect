@extends('layouts.master')

@section('title', 'Sayfa Bulunamadı | CampusConnect')
@section('meta_description', 'Üzgünüz, aradığınız sayfa bulunamadı. CampusConnect ile kampüs hayatına dair bilgilere ulaşmak için anasayfaya dönebilirsiniz.')
@section('meta_keywords', '404, sayfa bulunamadı, hata, kampüs, blog, üniversite,şehir, haber, yazı')

@section('content')
<section class="section text-center py-5">
    <div class="container">
        <img src="{{ asset('assets/images/logos/light_logo_cropped.png') }}" alt="404 Not Found" class="img-fluid mb-5" style="max-width: 300px;">
        <h1 class="display-4 mt-3 fw-semibold">Sayfa Bulunamadı</h1>
        <p class="lead my-4">Aradığınız sayfa kaldırılmış, adı değişmiş olabilir ya da geçici olarak kullanılamıyor olabilir.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">
            Anasayfaya Dön
        </a>
    </div>
</section>
@endsection
