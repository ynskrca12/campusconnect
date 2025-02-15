@extends('layouts.master')
@section('content')
    @if (Session::has('info'))
        <div class="alert alert-info" role="alert">
            {{ Auth::user()->name }}   {{ Session::get('info') }}
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h3>Üniversiteler</h3>
            </div>
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
@endsection

@section('js')
<script>
    $(document).ready(function () {
        var copy = $(".logos").clone();
        $(".university-slider").append(copy);
    });
</script>

