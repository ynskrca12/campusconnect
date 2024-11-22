@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row justify-content-center mb-4">
    <div class="search-bar">
      <input type="text" class="search-input" placeholder="Üniversiteni Bul..." id="searchInput">
      <button class="search-button"  id="searchButton">
          <i class="fa fa-search"></i>
      </button>
    </div>
  </div>

    <div class="row">
      <div class="row mb-4 mt-2">
        <h3 class="card-title" style="font-size: 26px">Üniversitelerimiz</h3>
        {{-- <div class="btn-group" role="group" aria-label="Üniversite Türü">
            <button type="button" class="btn btn-info filter-button" id="btnDevlet" value="Devlet">Devlet Üniversiteleri</button>
            <button type="button" class="btn btn-success filter-button" id="btnVakif" value="Vakıf">Vakıf Üniversiteleri</button>
          </div> --}}
      </div>
      @foreach($universiteler as $universite)
          <div class="col-lg-4 col-md-6 col-sm-12 mb-4 justify-content-center university-card" data-name="{{$universite->universite_ad}}">
              <div class="card">
                @if($universite->image)
                <img src="{{$universite->image}}" class="card-img-top" alt="Üniversite Resmi">
            @else
                <img src="{{ asset('public/universite/varsayilan_foto.jpg') }}"  class="card-img-top" alt="Üniversite Resmi">
            @endif
            <div class="card-header">
              <h5>{{$universite->universite_ad}}</h5>
            </div>
                  <div class="card-body">
                      <h5 class="text-center" style="margin-top: -19px;">Sosyal Medya</h5>
                      <div class="header2-media-icons-div mb-2">
                          <div class="header2-media-icon-div ">
                              <a href="{{ $universite->instagram ? : ''}}" target="_blank" class="header2-ikon-a  instagram-color" title="İnstagram">
                                  <i class="fab fa-instagram"></i>
                              </a>
                          </div>
                          <div class="header2-media-icon-div">
                              <a href="{{ $universite->twitter ? : ''}}" target="_blank" class="header2-ikon-a twitter-color" title="Twitter">
                                  <i class="fab fa-twitter"></i>
                              </a>
                          </div>
                          <div class="header2-media-icon-div">
                              <a href="{{ $universite->youtube ? : ''}}" target="_blank" class="header2-ikon-a youtube-color" title="Youtube">
                                  <i class="fab fa-youtube"></i>
                              </a>
                          </div>
                      </div>
                      {{-- <p class="card-text">Üniversite Şehri : {{$universite->universite_il}}</p>
                      <p class="card-text">Üniversite Türü : {{$universite->turu}}</p>
                      <p class="card-text">Kuruluş Tarihi : {{$universite->kurulus}}</p> --}}
                  </div>
                  <div class="card-footer">
                      <a href="{{ route('universite_detay', ['id' =>$universite->id]) }}" class="btn btn-success btnCard">Yorumlar</a>
                      <a href="http://www.{{$universite->internet_sitesi}}" class="btn btn-primary btnCard">Resmi Siteye Git</a>
                  </div>
              </div>
          </div>
      @endforeach
  </div>
</div>

@endsection

@section('css')
  <style>

    .container-scroller, .page-body-wrapper, .content-wrapper {
      background: linear-gradient(to right, #217dbe, #92c2fd);

    }
    
    .card-header{
      height: 17%;
      text-align: center;
      margin-top: 15px;
      background-color: #fff;
    }

    h3 {
      font-size: 28px;
      font-weight: bold;
      color: #333;
      margin-bottom: 15px;
      border-bottom: 2px solid #4caf50;
      padding-bottom: 5px;
    }

    .search-bar {
        display: flex;
        align-items: center;
        background-color: #f5f5f5;
        border-radius: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 6px;
        width: 500px;
        margin: -15px auto;
    }

    .search-input {
        flex: 1;
        border: none;
        outline: none;
        padding: 10px;
        font-size: 14px;
        background-color: transparent;
    }

    .search-button {
        border: none;
        background-color: #4caf50;
        color: #fff;
        padding: 8px 12px;
        border-radius: 20px;
        cursor: pointer;
        margin-left: 8px;
        transition: background-color 0.3s;
    }

    .search-button:hover {
        background-color: #45a049;
    }

    .card {
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      overflow: hidden;
      width: 300px;
      height: 500px;
      margin-bottom: 20px;
    }

    .card:hover {
      transform: translateY(-15px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.7);
    }

    .card-img-top {
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
      height: 160px;
      object-fit: cover;
    }

    .card-body {
      padding: 5px;
      background-color: #fff;
    }

    .card-title {
      font-size: 15px;
      font-weight: bold;
    }

    .card-text {
      font-size: 14px;
      color: #666;
      margin-bottom: 10px;
    }

    .card-footer {
      background-color: #f8f9fa;
      padding: 8px 15px;
      border-bottom-left-radius: 8px;
      border-bottom-right-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .btnCard {
      font-size: 14px;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 6px 15px;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    .btnCard:hover {
      background-color: #0056b3;
    }

    .btn-group {
        display: flex;
        gap: 100px;
        margin-bottom: 20px;
        margin-top: 20px;
      }

      h2 {
        color: #333;
    }
    .header2-media-icons-div {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .header2-media-icon-div {
        margin: 0 10px;
        font-size: 24px;
    }

    .header2-ikon-a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        text-decoration: none;
    }

    .instagram-color {
        color: #C13584;
    }
    .instagram-color:hover {
        color: #ffffff;
        background-color: #C13584;
    }

    .twitter-color {
        color: #1DA1F2;
    }
    .twitter-color:hover {
        color: #ffffff;
        background-color: #1DA1F2;
    }

    .youtube-color {
        color: #FF0000;
    }
    .youtube-color:hover {
        color: #ffffff;
        background-color: #FF0000;
    }

  </style>


@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $("#searchInput").on("input", function() {
      const searchTerm = $(this).val().trim().toLowerCase();
      $(".university-card").each(function() {
        const universityName = $(this).data("name").toLowerCase();
        if (universityName.includes(searchTerm)) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    });

    $("#searchButton").on("click", function() {
      $("#searchInput").focus();
    });

    // $("#btnDevlet").on("click", function() {
    //     var universite_turu = $(this).val();
    //     console.log(universite_turu)
    //     $.ajax({
    //                 type: "GET",
    //                 url: '{{ route('devlet_universite_getir') }}?universite_turu=' + universite_turu,
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 },
    //                 success: function(data) {
    //                     console.log(data)


    //                 },//end success
    //             });//end ajax
    // });

  });



</script>
@endsection
