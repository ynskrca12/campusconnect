@extends('layouts.master')
@section('content')
<h2 class="text-center mb-5">{{$universite->universite_ad}}</h2>

<div class="container mt-3">

    <div class="row">

        <div class="col-md-10">
                         <h2>Kullanıcı Yorumları</h2>
                @auth
                    <div class="mb-3">
                        <form method="post" action="{{ route('universite_yorum_ekle',$universite->id) }}">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="comment" class="form-control" placeholder="Yorum yap...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn  btn-info">Gönder</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @else
                    <p>Yorum yapabilmek için lütfen giriş yapınız.
                         Hesabınız yoksa <a href="{{ route('register') }}">kayıt olun</a> veya<a href="{{ route('login') }}">giriş yap</a>.</p>
                @endauth
                   @foreach ($universite_yorumlar as $comment)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"> <i class="fas fa-user" style="margin-left: 10px;"></i>
                                  @php
                                      $user = DB::table('users')->where('id',$comment->user_id)->value('name');
                                      echo $user;
                                  @endphp
                                </h5>
                                <p class="card-text">{{ $comment->yorum }}</p>
                        <small class="text-muted "> {{ date('d-m-Y H:i:s', strtotime($comment->created_at)) }}</small>

                            </div>
                            @if (Auth::check() && Auth::user()->id === $comment->user_id)

                            <form action="{{ route('universite_yorum_sil', [$universite->id, $comment->id]) }}"
                                method="POST">  @csrf  @method('DELETE')
                                <button class="btn btn-danger btn-sm">Yorumu Sil</button>
                            </form>
                        @endif
                        </div>

                   @endforeach


        </div>
    </div>
</div>

@endsection

@section('css')
<style>
body {
    font-family: Arial, sans-serif;
}

.container {
    margin-top: 50px;
}


.card {
    border: none;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.card-body {
    padding: 0px;
}

.card.comment-card {
    margin-top: 20px;
    border: none;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.card.comment-card .card-body {
    padding: 15px;
}

.form-control.comment-input {
    border-radius: 0;
}
.btn-danger{
    float: right;
    margin-right: 30px;
    margin-bottom: 15px;
}
</style>
@endsection



@section('js')
<script>
    $(document).ready(function() {
    $(".sticky-top").stick_in_parent();
});
</script>

@endsection

