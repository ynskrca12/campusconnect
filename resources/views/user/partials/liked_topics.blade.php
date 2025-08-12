@foreach ($liked_topics as $item)
    @php
        switch ($item->type) {
            case 'city':
                $routeName = 'city.topic.comments';
                break;
            case 'university':
                $routeName = 'university.topic.comments';
                break;
            default:
                $routeName = 'topic.comments';
        }
    @endphp
    <x-topic-box :topic="$item->topic" routeName="{{ $routeName }}" type="{{ $item->type }}"/>
@endforeach
