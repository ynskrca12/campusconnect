@extends('layouts.master')
@section('content')
    @if (Session::has('info'))
        <div class="alert alert-info" role="alert">
            {{ Auth::user()->name }}   {{ Session::get('info') }}
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="text-center mt-1  p-3" >
                 
                </div>
            </div>
        </div>
       
    </div>
@endsection

@section('css')
<style>  
    .container-scroller, .page-body-wrapper, .content-wrapper {
        background-image: url('{{ asset('public/home_img/background.jpg') }}');
        background-position: center;
        background-size: cover;
    }

</style>
@endsection

