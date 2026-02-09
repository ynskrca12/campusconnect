@foreach($topics as $topic)
    <div class="col-md-6 mb-3 d-flex">
        <div class="card-wrapper h-100 w-100 d-flex flex-column">
            @if($topic->university)
                <a href="{{ route('university.show', $topic->university->slug) }}" 
                   class="university-badge-home mb-2 text-decoration-none">
                    <img src="{{ $topic->university->logo }}" style="width:40px;height:40px;object-fit:contain;" alt="{{$topic->university->slug}}">
                    <span class="university-name-home">{{ $topic->university->universite_ad }}</span>
                </a>
            @endif
            <x-topic-box :topic="$topic" routeName="university.topic.comments" type="university" isHome="true"/>
        </div>
    </div>
@endforeach