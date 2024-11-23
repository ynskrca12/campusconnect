@extends('layouts.master') @section('content')

@auth
<div class="col-md-12 text-center mt-3 mb-3">
    <a href="{{ route('ilan_ekle') }}" class="btn btn-info">İlan Ekle</a>
</div>
@else
<div class="container">
 <!-- Dark Alert Box -->
 <div class="alert alert-info" role="alert">
  <h5>İlan eklemek ve daha fazlası için lütfen <a href="{{route('login')}}" class="btn btn-primary">giriş yapınız...</a></h5>
</div>
</div>
@endauth
<div class="container">
    <div class="row justify-content-center">
        @foreach ($ilanlar as $ilan)
          <div class="col-lg-6 col-md-10 col-sm-12 mb-4">
              <div class="card text-center">
                  <div class="additional">
                      <div class="user-card">
                          <div class="level center">
                              {{$ilan->kategori}}
                          </div>
                          <div class="points center">
                              {{$ilan->fiyat}} ₺
                          </div>
                          <?php  $imageUrl = $ilan->image; ?>

                          <svg width="110" height="110" viewBox="0 0 250 250" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="title desc" class="center">
                              <g stroke="none" stroke-width="0" clip-path="url(#scene)">
                                  <g id="head">
                                      <image xlink:href="<?php echo $imageUrl; ?>" x="40" y="40" width="180" height="190" clip-path="url(#scene)" />
                                  </g>
                              </g>
                          </svg>
                      </div>
                      <div class="more-info">
                          <h3>{{$ilan->name}}</h3>
                          <div class="coords">
                              <span class="ilantarihi">İlan Tarihi :</span>
                              <span class="ilantarihi2">{{ date('d-m-Y H:i:s', strtotime($ilan->created_at)) }}</span>
                          </div>
                          <div class="coords">
                              <span class="universite">Üniversite :</span>
                              <span class="universite2"> @php $user = DB::table('users')->where('id',$ilan->user_id)->value('university'); echo $user; @endphp</span>
                          </div>
                          <a href="" class="btn btn-info btn-sm mt-5">İletişime Geç</a>
                      </div>
                  </div>
                  <div class="general">
                      <h3>{{$ilan->name}}</h3>
                      <p>{{$ilan->description}}</p>
                      <span class="more">Detaylar için üzerime gel</span>
                  </div>
              </div>
          </div>
        @endforeach
    </div>
</div>

@endsection @section('css')
<style>
           @import url('https://fonts.googleapis.com/css?family=Abel');
           .container-scroller, .page-body-wrapper, .content-wrapper {
            background: linear-gradient(to right, #217dbe, #92c2fd);

                }
            html, body {
              background: #FCEEB5;
              font-family: Abel, Arial, Verdana, sans-serif;
            }

            .center {
              position: absolute;
              top: 50%;
              left: 50%;
              -webkit-transform: translate(-50%, -50%);
            }

            .card {
              width: 80%;
              height: 250px;
              background-color: #fff;
              background: linear-gradient(#f8f8f8, #fff);
              box-shadow: 0 8px 16px -8px rgba(0,0,0,0.4);
              border-radius: 6px;
              overflow: hidden;
              position: relative;
              margin: 1rem;
            }

            .card h3 {
              text-align: center;
            }

            .card .additional {
              position: absolute;
              width: 30%;
              height: 100%;
              background: linear-gradient(#5C95FF, #4080FF);
              transition: width 0.4s;
              overflow: hidden;
              z-index: 2;
            }


            .card:hover .additional {
              width: 100%;
              border-radius: 0 5px 5px 0;
            }

            .card .additional .user-card {
              width: 150px;
              height: 100%;
              position: relative;
              float: left;
            }

            .card .additional .user-card::after {
              content: "";
              display: block;
              position: absolute;
              top: 10%;
              right: -2px;
              height: 80%;
              border-left: 2px solid rgba(0,0,0,0.025);*/
            }

            .card .additional .user-card .level,
            .card .additional .user-card .points {
              top: 15%;
              color: #fff;
              text-transform: uppercase;
              font-size: 0.75em;
              font-weight: bold;
              background: rgba(0,0,0,0.15);
              padding: 0.125rem 0.75rem;
              border-radius: 100px;
              white-space: nowrap;
            }

            .card .additional .user-card .points {
              top: 85%;
            }

            .card .additional .user-card svg {
              top: 50%;
            }

            .card .additional .more-info {
              width: 300px;
              float: left;
              position: absolute;
              left: 150px;
              height: 100%;
              margin-top: 15px;
            }

            .card .additional .more-info h3 {
              color: #f8f8f8;
            }

            .card .additional .more-info a {
              float: right; 
              margin-right: 17px;
            }

            .card .additional .coords {
              margin: 1rem 1rem;
              color: #fff;
              font-size: 1rem;
            }

           

            .card .additional .coords span + span {
              /* float: right; */
            }

            .card .general {
              width: 70%;
              height: 100%;
              position: absolute;
              top: 0;
              right: 0;
              z-index: 1;
              box-sizing: border-box;
              padding: 1rem;
              padding-top: 0;
              margin-top: 15px;
            }

            .card .general .more {
              position: absolute;
              bottom: 1rem;
              right: 1rem;
              font-size: 0.9em;
            }

            @media (max-width: 900px) {
              .card {
              width: 100%;
              height: 250px;
              background-color: #fff;
              background: linear-gradient(#f8f8f8, #fff);
              box-shadow: 0 8px 16px -8px rgba(0,0,0,0.4);
              border-radius: 6px;
              overflow: hidden;
              position: relative;
              /* margin: 5px -20px ; */
              /* margin:  */
            }

            .card h3 {
              text-align: center;
            }

            .card .additional {
              position: absolute;
              width: 1%;
              height: 100%;
              background: linear-gradient(#5C95FF, #4080FF);
              transition: width 0.4s;
              overflow: hidden;
              z-index: 2;
            }


            .card:hover .additional {
              width: 100%;
              border-radius: 0 5px 5px 0;
            }

            .card .additional .user-card {
              width: 150px;
              height: 100%;
              position: relative;
              float: left;
            }

            .card .additional .user-card::after {
              content: "";
              display: block;
              position: absolute;
              top: 10%;
              right: -2px;
              height: 80%;
              border-left: 2px solid rgba(0,0,0,0.025);*/
            }

            .card .additional .user-card .level,
            .card .additional .user-card .points {
              top: 15%;
              color: #fff;
              text-transform: uppercase;
              font-size: 0.75em;
              font-weight: bold;
              background: rgba(0,0,0,0.15);
              padding: 0.125rem 0.75rem;
              border-radius: 100px;
              white-space: nowrap;
            }

            .card .additional .user-card .points {
              top: 85%;
            }

            .card .additional .user-card svg {
              top: 50%;
            }

            .card .additional .more-info {
              width: 300px;
              float: left;
              position: absolute;
              left: 150px;
              height: 100%;
              margin-top: 15px;
            }

            .card .additional .more-info h3 {
             display: none;
            }

            .card .additional .more-info a {
             float: left;
            }

            .card .additional .coords {
              margin-left: -95px;
              color: #fff;
              font-size: 1rem;
            }

            /* .card .additional .coords span + span {
              text-align: center;
              display: block;
            } */

            .card .additional .coords .ilantarihi , .card .additional .coords .universite {
              display: block;
              margin-left: -60px;
            }

            .card .additional .coords .ilantarihi2 , .card .additional .coords .universite2 {
              display: block;
              margin-left: -60px;
            }

            .card .general {
              width: 99%;
              height: 100%;
              position: absolute;
              top: 0;
              right: 0;
              z-index: 1;
              box-sizing: border-box;
              padding: 1rem;
              padding-top: 0;
              margin-top: 15px;
            }

            .card .general .more {
              position: absolute;
              bottom: 1rem;
              right: 1rem;
              font-size: 0.9em;
            }
        }

</style>
@endsection
