<div id="topic-list">
    @foreach ($topics as $topic)
        <x-topic-box :topic="$topic" type="general" />
    @endforeach
</div>

