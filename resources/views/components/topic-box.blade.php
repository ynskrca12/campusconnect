@props(['topic', 'routeName' => 'topic.comments', 'type' => 'general','isHome' => false])

@php
    // Controller'dan gelmediyse hesapla
    if (!isset($topic->userLiked) && auth()->check()) {
        $likeTable = match($type) {
            'university' => 'university_topics_likes',
            'city' => 'city_topics_likes',
            default => 'general_topics_likes'
        };
        
        $userLikeStatus = DB::table($likeTable)
            ->where('topic_id', $topic->id)
            ->where('user_id', auth()->id())
            ->first();
        
        $topic->userLiked = $userLikeStatus && $userLikeStatus->like == 1;
        $topic->userDisliked = $userLikeStatus && $userLikeStatus->like == 0;
    } elseif (!auth()->check()) {
        $topic->userLiked = false;
        $topic->userDisliked = false;
    }
@endphp

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
                        <i class="fa-brands fa-twitter me-2"></i> Twitter'da Paylaş
                    </a>
                </li> 
                @if (auth()->check() && auth()->user()->id === $topic->user_id)
                    <li><a class="dropdown-item delete-topic text-dark" href="#" data-id="{{ $topic->id }}" data-type="{{ $type }}"><i class="fa-solid fa-trash me-3"></i>Sil</a></li>                    
                @endif
            </ul>
        </div>
    </div>

    <p>
        @if($isHome && strlen(strip_tags($topic->comment)) > 150)
            {{ Str::limit(strip_tags($topic->comment), 150) }}
            <a href="{{ route($routeName, ['slug' => $topic->topic_title_slug]) }}"
                style="color: #001b48">Devamını Oku</a>
        @else
            {!! $topic->comment !!}
        @endif
    </p>

    <div class="d-flex justify-content-between mt-2">
        <div class="like-dislike mt-3">
            <div class="like-btn d-inline me-2"
                data-id="{{ $topic->id }}"
                data-type="{{ $type }}"
                data-user-liked="{{ ($topic->userLiked ?? false) ? '1' : '0' }}"
                style="cursor: pointer;">
                <i style="font-size: 18px; color: {{ ($topic->userLiked ?? false) ? '#dc3545' : '#536471' }};"
                class="bi bi-heart{{ ($topic->userLiked ?? false) ? '-fill' : '' }}"></i>
                <span class="like-count" style="color: #495057;">{{ $topic->likes }}</span>
            </div>

            <div class="dislike-btn d-inline me-2"
                data-id="{{ $topic->id }}"
                data-type="{{ $type }}"
                data-user-disliked="{{ ($topic->userDisliked ?? false) ? '1' : '0' }}"
                style="cursor: pointer;">
                <i style="font-size: 18px; color: {{ ($topic->userDisliked ?? false) ? '#6c757d' : '#536471' }};"
                class="bi bi-hand-thumbs-down{{ ($topic->userDisliked ?? false) ? '-fill' : '' }}"></i>
                <span class="dislike-count" style="color: #495057;">{{ $topic->dislikes }}</span>
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
    
    .like-btn, .dislike-btn {
        transition: all 0.2s ease;
    }

    .like-btn:hover {
        transform: scale(1.1);
    }

    .dislike-btn:hover {
        transform: scale(1.1);
    }

    .like-btn:active, .dislike-btn:active {
        transform: scale(0.95);
    }

    .like-count, .dislike-count {
        transition: color 0.2s ease;
        font-weight: 600;
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