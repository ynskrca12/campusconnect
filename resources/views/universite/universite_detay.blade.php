@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap">
<h2 class="text-center mb-5">{{$universite->universite_ad}}</h2>

<div class="container mt-3">

    <div class="row d-flex justify-content-center">

        <div class="col-md-12">
                         <h3 class="text-center">Yorumlar</h3>
                @auth
                    <div class="col-md-11 mt-2 mb-3">
                        <form method="post" action="{{ route('universite_yorum_ekle',$universite->id) }}">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="comment" class="form-control" placeholder="Yorum yap...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info">Gönder</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @else
                    <div class="container">
                        <div class="alert alert-info" role="alert">
                         <p>Yorum yapabilmek ve daha fazlası için lütfen <a href="{{route('login')}}" class="btn btn-primary">giriş yapınız.</a>
                            Hesabınız yoksa <a href="{{route('register')}}" class="btn btn-primary">üye olun.</a>
                         </p>
                       </div>
                    </div>
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
                            @if (Auth::check() && Auth::user()->id === intval($comment->user_id))
                            <form action="{{ route('universite_yorum_sil', [$universite->id, $comment->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
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
        font-family: 'Poppins', sans-serif;
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

@media (max-width: 768px) {
    .alert {
        margin-top: 20px; 
    }
    .btn-primary{
        padding: 2px;
        margin: 2px;
    }
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

