@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="announcement-list">
                @foreach($duyurular as $duyuru)
                <div class="announcement">
                    <div class="announcement-content">                      
                        <h3>{{ $duyuru->name }}</h3>
                        <p>{{ $duyuru->description }}</p>
                        <div class="meta mt-3">
                            <span class="author">Yayınlayan: {{ $duyuru->user_id }}</span>
                            <span class="date">Yayınlanma Tarihi: {{ $duyuru->created_at->format('d.m.Y H:i') }}</span>
                        </div>
                    </div>
                </div>
                @endforeach

                @if(count($duyurular) == 0)
                <p class="no-announcement">Henüz bir duyuru veya ilan bulunmamaktadır.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
/* Diğer stiller burada */

body {
    background-color: #fff; /* Beyaz arka plan */
}

.announcement-list {
    margin-top: 20px;
}

.announcement {
    background-color: #f4f4f4; /* Hafif gri arkaplan */
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s;
    padding: 20px;
    text-align: center;
    margin-bottom: 20px;
}

.announcement:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
}

.meta {
    display: flex;
    flex-direction: column;
    align-items: center;
    font-size: 12px;
    color: #888;
    margin-top: 10px;
}

.meta .author {
    font-weight: bold;
    margin-bottom: 9px;
}

.announcement h3 {
    margin-top: 0;
    font-size: 20px;
    color: #333;
    margin-bottom: 10px;
}

.announcement p {
    margin: 0;
    font-size: 16px;
    color: #666;
    line-height: 1.4;
}

.no-announcement {
    text-align: center;
    margin-top: 20px;
    color: #666;
}
</style>    
@endsection

@section('js')
<script>
/* JavaScript kodları buraya eklenebilir */
</script>
@endsection
