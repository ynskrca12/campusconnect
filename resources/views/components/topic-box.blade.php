@props(['topic', 'routeName' => 'topic.comments', 'type' => 'general'])

<div class="topic mb-3">
    <div class="d-flex justify-content-between align-items-start">
        <h3 class="topic-title mb-3">
            <a href="{{ route($routeName, ['slug' => $topic->topic_title_slug]) }}" class="text-decoration-none text-dark">
                {{ $topic->topic_title }}
            </a>
        </h3>
        <div class="dropdown me-3">
            <i class="fa-solid fa-ellipsis cursor-pointer text-muted fs-6 mt-3" role="button" id="dropdownMenu{{ $topic->id }}" data-bs-toggle="dropdown" aria-expanded="false"></i>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $topic->id }}">
                    <li>
                    <a class="dropdown-item copy-link text-dark"
                    href="#"
                    data-link="{{ route($routeName, ['slug' => $topic->topic_title_slug]) }}">
                        <i class="fa-solid fa-link me-2"></i> Linki Kopyala
                    </a>
                </li>
                <li>
                    <a class="dropdown-item text-dark"
                    href="https://twitter.com/intent/tweet?text={{ urlencode($topic->topic_title . ' - ' . route($routeName, ['slug' => $topic->topic_title_slug])) }}"
                    target="_blank">
                        <i class="fa-brands fa-twitter me-2"></i> Twitter’da Paylaş
                    </a>
                </li> 
                @if (auth()->check() && auth()->user()->id === $topic->user_id)
                    <li><a class="dropdown-item delete-topic text-dark" href="#" data-id="{{ $topic->id }}" data-type="{{ $type }}"><i class="fa-solid fa-trash me-3"></i>Sil</a></li>                    
                @endif
                                
            </ul>
        </div>
    </div>

    <p>{!! $topic->comment !!}</p>

    <div class="d-flex justify-content-between mt-2">

        <div class="like-dislike mt-3">
            <div class="like-btn d-inline me-2" data-id="{{ $topic->id }}" style="cursor: pointer; color: #888;">
                <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-up"></i>
                <span class="like-count">{{ $topic->likes }}</span>
            </div>
            <div class="dislike-btn d-inline me-2" data-id="{{ $topic->id }}" style="cursor: pointer; color: #888;">
                <i style="font-weight: 500 !important" class="fa-solid fa-thumbs-down"></i>
                <span class="dislike-count">{{ $topic->dislikes }}</span>
            </div>
            <div class="d-inline">
                <a href="{{ route($routeName, ['slug' => $topic->topic_title_slug]) }}"
                title="Yanıtla"
                style="color: #555;">
                    <i class="fa-solid fa-reply"></i>
                </a>
            </div>
        </div>

        <div class="meta">
            <div class="d-flex align-items-center entry-footer-bottom">
                <div class="footer-info">
                    <div style="display: block;padding:0px 2px;text-align: end;margin: -5px 0px;">
                        <p style="display: block;white-space:nowrap;color:#001b48;">{{ $topic->user->username ?? 'Anonim' }}</p>
                    </div>
                    <div style="display: block;padding:1px 2px;line-height: 14px;">
                        <p style="color: #888;font-size: 12px;">{{ $topic->created_at->format('d.m.Y H:i') }}</p>
                    </div>
                </div>
                <div class="avatar-container">
                    <x-user-avatar :user="$topic->user" />
                </div>
            </div>
        </div>

    </div>

</div>

<style>
    .topic {
        padding: 10px 30px !important;
        border: 1px solid #dcdcdc !important;
        border-radius: 15px;         
    }
    
    .topic h3 a{
        margin: 0;
        font-size: 17px;
        color: #333 !important;
        text-decoration: none;
    }

    .topic h3 a:hover{
        color: #424242 !important; 
        text-decoration: underline; 
    }

    .topic p {
        margin: 5px 0;
        font-size: 14px;
        color: #666;
    }
    .topic .meta {
        display: flex;
        justify-content: end;
    }
    
    .footer-info{
        float: left;
        vertical-align: middle;
        padding: 4px;
        padding-right: 10px;
    }
    @media (max-width: 768px) {
        .topic {
            padding: 15px 20px 15px 20px !important;
        }
        .topic h3 a {
            font-size: 15px;
        }
        .topic p {
            font-size: 13px;
        }
    }
    .fa-ellipsis {
        z-index: 9999 !important;
    }
</style>