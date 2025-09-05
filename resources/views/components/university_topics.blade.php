@foreach($topics as $topic)
    <x-topic-box :topic="$topic" routeName="university.topic.comments" type="university"  isHome="true"/>
@endforeach
