@extends('layouts.master')

@section('title', 'Sunucu Hatası | CampusConnect')
@section('meta_description', 'Üzgünüz, bir hata oluştu. Lütfen daha sonra tekrar deneyiniz veya anasayfaya dönerek diğer içeriklerimizi keşfedin.')
@section('meta_keywords', '500, sunucu hatası, hata, site çöktü, sistem hatası')

@section('content')
<section class="section bg-light text-center py-5">
    <div class="container">
        <img src="{{ asset('assets/images/logos/light_logo_cropped.png') }}" alt="500 Internal Server Error" class="img-fluid mb-4" style="max-width: 300px;">
        <h1 class="display-4">Bir Hata Oluştu</h1>
        <p class="lead my-4">Sistemimizde beklenmedik bir hata oluştu. Ekibimiz durumu incelemektedir.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">
            Anasayfaya Dön
        </a>
    </div>
</section>
@endsection
