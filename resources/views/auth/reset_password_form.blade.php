@extends('layouts.master')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <div class="card-body">
            <h4 class="text-center mb-4">Şifreyi Sıfırla</h4>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ request()->query('token') }}">
                <input type="hidden" name="email" value="{{ request()->query('email') }}">

                <!-- Yeni Şifre -->
                <div class="mb-3">
                    <label for="password" class="form-label">Yeni Şifre</label>
                    <input type="password" name="password" id="password" class="form-control" required minlength="6">
                </div>

                <!-- Şifre Onayı -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Yeni Şifre (Tekrar)</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn w-100 text-white" style="background-color: #001b48;">Şifreyi Güncelle</button>
            </form>
        </div>
    </div>
</div>
@endsection