{{-- resources/views/user/profile.blade.php --}}

@extends('layouts.master')

@section('title', $user->username . ' - Profil')

@section('content')
<div class="py-1 py-md-3">
    <div class="row">
        {{-- Sol Taraf - Kullanıcı Bilgileri --}}
        <div class="col-lg-4 mb-4">
            <div class="profile-card">
                {{-- Avatar --}}
                <div class="text-center mb-4">
                    <div class="avatar-wrapper"      style="background-color:
                            @if($user->user_image === 'man.png')
                                #95bdff
                            @elseif($user->user_image === 'woman.png')
                                #ffbdd3
                            @endif
                        ">
                        <img src="{{ asset('storage/profile_images/' . $user->user_image) }}" 
                             alt="{{ $user->username }}" 
                             class="profile-avatar">
                    </div>
                    <h2 class="profile-username mt-3">{{ $user->username }}</h2>
                    <p class="profile-join-date">
                        <i class="fa-solid fa-calendar-alt me-1"></i>
                        {{ $user->created_at->format('d.m.Y') }} tarihinde katıldı
                    </p>
                </div>

                {{-- Kullanıcı Detayları --}}
                <div class="profile-details d-flex align-items-center justify-content-between gap-1 mx-3">
                    @if($user->university)
                    <div class="detail-item">
                        <img src="{{ $user->universityInfo->logo ?? asset('assets/images/university_placeholder.png') }}"
                            alt="{{ $user->university }}" 
                            class="university-list-logo">
                        <a href="{{route('university.show', ['slug' => $user->universityInfo->slug])}}"
                            style="color: #000;text-decoration:none;">{{ $user->university  }}</a>
                    </div>
                    @endif

                    @if($user->gender)
                    <div class="detail-item">
                        <i class="fa-solid fa-{{ ['male'=>'mars','female'=>'venus','pass'=>'minus'][$user->gender] ?? 'minus' }}"></i>
                        <span>{{ ['male'=>'Erkek','female'=>'Kadın','pass'=>'Belirtilmedi'][$user->gender] ?? 'Belirtilmedi' }}</span>
                    </div>
                    @endif
                </div>

                {{-- İstatistikler --}}
                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-value">{{ $totalComments }}</div>
                        <div class="stat-label">Toplam Yorum</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $totalLikes }}</div>
                        <div class="stat-label">Alınan Beğeni</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $totalDislikes }}</div>
                        <div class="stat-label">Beğenilmeme</div>
                    </div>
                </div>

                {{-- Kategori Dağılımı --}}
                <div class="category-breakdown d-mobile-none">
                    <h5 class="section-title">Yorum Dağılımı</h5>
                    <div class="breakdown-item">
                        <span class="breakdown-label">
                            <i class="fa-solid fa-comments me-2"></i>Genel Forum
                        </span>
                        <span class="breakdown-value">{{ $generalCommentsCount }}</span>
                    </div>
                    <div class="breakdown-item">
                        <span class="breakdown-label">
                            <i class="fa-solid fa-graduation-cap me-2"></i>Üniversiteler
                        </span>
                        <span class="breakdown-value">{{ $universitiesCommentsCount }}</span>
                    </div>
                    <div class="breakdown-item">
                        <span class="breakdown-label">
                            <i class="fa-solid fa-city me-2"></i>Şehirler
                        </span>
                        <span class="breakdown-value">{{ $citiesCommentsCount }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sağ Taraf - Son Aktiviteler --}}
        <div class="col-lg-8">
            <div class="activities-section">

                {{-- Tab Navigation --}}
                <ul class="nav nav-pills activity-tabs mb-4" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#universities" type="button">
                            Üniversite Yorumları
                            <span class="badge">{{ $universitiesCommentsCount }}</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#general" type="button">
                            Forum Yorumları
                            <span class="badge">{{ $generalCommentsCount }}</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#cities" type="button">
                            Şehir Yorumları
                            <span class="badge">{{ $citiesCommentsCount }}</span>
                        </button>
                    </li>
                     <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#liked" type="button">
                            Beğeniler
                            <span class="badge">{{ $likedGeneralCount + $likedUniversityCount + $likedCityCount }}</span>
                        </button>
                    </li>
                </ul>

                {{-- Tab Content --}}
                <div class="tab-content">
                    {{-- Genel Forum Yorumları --}}
                    <div class="tab-pane fade" id="general">
                        @forelse($recentGeneralComments as $comment)
                            <x-topic-box :topic="$comment" routeName="topic.comments" type="general"/>
                        @empty
                            <div class="empty-state">
                                <i class="fa-solid fa-inbox"></i>
                                <p>Henüz genel forum yorumu yok</p>
                            </div>
                        @endforelse
                        
                        @if($generalCommentsCount > 10)
                                <div class="text-center mt-4">
                                    <button class="btn-load-more-new" data-tab="general" data-offset="10">
                                        <i class="fa-solid fa-chevron-down me-2"></i>
                                        Daha Fazlasını Gör
                                        <span class="loading-spinner" style="display: none;">
                                            <i class="fa-solid fa-spinner fa-spin ms-2"></i>
                                        </span>
                                    </button>
                                </div>
                            @endif
                    </div>

                    {{-- Üniversite Yorumları --}}
                    <div class="tab-pane fade  show active" id="universities">
                        @forelse($recentUniversitiesComments as $topic)
                            <x-topic-box :topic="$topic" routeName="university.topic.comments" type="university"/>

                        @empty
                            <div class="empty-state">
                                <i class="fa-solid fa-inbox"></i>
                                <p>Henüz üniversite yorumu yok</p>
                            </div>
                        @endforelse
                        
                        @if($universitiesCommentsCount > 10)
                            <div class="text-center mt-4">
                                <button class="btn-load-more-new" data-tab="universities" data-offset="10">
                                    <i class="fa-solid fa-chevron-down me-2"></i>
                                    Daha Fazlasını Gör
                                    <span class="loading-spinner" style="display: none;">
                                        <i class="fa-solid fa-spinner fa-spin ms-2"></i>
                                    </span>
                                </button>
                            </div>
                        @endif
                    </div>

                    {{-- Şehir Yorumları --}}
                    <div class="tab-pane fade" id="cities">
                        @forelse($recentCitiesComments as $topic)
                            <x-topic-box :topic="$topic" routeName="city.topic.comments" type="city"/>
                        @empty
                            <div class="empty-state">
                                <i class="fa-solid fa-inbox"></i>
                                <p>Henüz şehir yorumu yok</p>
                            </div>
                        @endforelse
                        
                        @if($citiesCommentsCount > 10)
                            <div class="text-center mt-4">
                                <button class="btn-load-more-new" data-tab="cities" data-offset="10">
                                    <i class="fa-solid fa-chevron-down me-2"></i>
                                    Daha Fazlasını Gör
                                    <span class="loading-spinner" style="display: none;">
                                        <i class="fa-solid fa-spinner fa-spin ms-2"></i>
                                    </span>
                                </button>
                            </div>
                        @endif
                    </div>

                    {{-- BEĞENiler --}}
                    <div class="tab-pane fade" id="liked">
                        <div class="comments-container" data-tab="liked">
                            
                            {{-- Üniversite Beğenileri --}}
                            @if($likedUniversityTopics->count() > 0)
                                <div class="liked-category-section" data-category="university">
                                    <div class="liked-category-title">
                                        <i class="fa-solid fa-graduation-cap me-2"></i>
                                        Üniversiteler
                                    </div>
                                    <div class="category-items">
                                        @foreach($likedUniversityTopics as $topic)
                                            <div class="liked-item" data-topic-id="{{ $topic->id }}" data-topic-type="university">
                                                <x-topic-box :topic="$topic" routeName="university.topic.comments" type="university"/>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    @if($likedUniversityCount > 10)
                                        <div class="text-center mt-3 mb-4">
                                            <button class="btn-load-more-category" data-category="university" data-offset="10">
                                                <i class="fa-solid fa-chevron-down me-2"></i>
                                                Daha Fazla Üniversite Yorumu
                                                <span class="loading-spinner" style="display: none;">
                                                    <i class="fa-solid fa-spinner fa-spin ms-2"></i>
                                                </span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            {{-- Genel Forum Beğenileri --}}
                            @if($likedGeneralTopics->count() > 0)
                                <div class="liked-category-section" data-category="general">
                                    <div class="liked-category-title">
                                        <i class="fa-solid fa-comments me-2"></i>
                                        Genel Forum
                                    </div>
                                    <div class="category-items">
                                        @foreach($likedGeneralTopics as $topic)
                                            <div class="liked-item" data-topic-id="{{ $topic->id }}" data-topic-type="general">
                                                <x-topic-box :topic="$topic" routeName="topic.comments" type="general"/>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    @if($likedGeneralCount > 10)
                                        <div class="text-center mt-3 mb-4">
                                            <button class="btn-load-more-category" data-category="general" data-offset="10">
                                                <i class="fa-solid fa-chevron-down me-2"></i>
                                                Daha Fazla Forum Yorumu
                                                <span class="loading-spinner" style="display: none;">
                                                    <i class="fa-solid fa-spinner fa-spin ms-2"></i>
                                                </span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            {{-- Şehir Beğenileri --}}
                            @if($likedCityTopics->count() > 0)
                                <div class="liked-category-section" data-category="city">
                                    <div class="liked-category-title">
                                        <i class="fa-solid fa-city me-2"></i>
                                        Şehirler
                                    </div>
                                    <div class="category-items">
                                        @foreach($likedCityTopics as $topic)
                                            <div class="liked-item" data-topic-id="{{ $topic->id }}" data-topic-type="city">
                                                <x-topic-box :topic="$topic" routeName="city.topic.comments" type="city"/>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    @if($likedCityCount > 10)
                                        <div class="text-center mt-3 mb-4">
                                            <button class="btn-load-more-category" data-category="city" data-offset="10">
                                                <i class="fa-solid fa-chevron-down me-2"></i>
                                                Daha Fazla Şehir Yorumu
                                                <span class="loading-spinner" style="display: none;">
                                                    <i class="fa-solid fa-spinner fa-spin ms-2"></i>
                                                </span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            {{-- Hiç beğeni yoksa --}}
                            @if($likedGeneralTopics->count() == 0 && $likedUniversityTopics->count() == 0 && $likedCityTopics->count() == 0)
                                <div class="empty-state">
                                    <i class="fa-solid fa-heart-crack"></i>
                                    <p>Henüz beğenilen yorum yok</p>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>

    .university-list-logo {
        width: 28px;
        height: 28px;
        object-fit: contain;
        border-radius: 6px;
        flex-shrink: 0;
        margin-right: 8px;
    }

    @media (max-width: 768px) {
        .university-list-logo {
            width: 28px;
            height: 28px;
        }

        .d-mobile-none {
            display: none;
        }
    }

    /* Kategori Section */
    .liked-category-section {
        margin-bottom: 30px;
    }

    .liked-category-section:last-child {
        margin-bottom: 0;
    }

    /* Kategori bazlı buton */
    .btn-load-more-category {
        display: inline-flex;
        align-items: center;
        padding: 10px 24px;
        background: #fff;
        color: var(--primary-color);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-weight: 500;
        font-size: 13px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-load-more-category:hover {
        background: var(--bg-light);
        border-color: var(--primary-color);
        transform: translateY(-1px);
    }

    .btn-load-more-category:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .btn-load-more-category.loading {
        pointer-events: none;
    }
        /* Daha Fazlasını Gör Butonu */
    .btn-load-more-new {
        display: inline-flex;
        align-items: center;
        padding: 12px 30px;
        background: #fff;
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-load-more-new:hover {
        background: var(--primary-color);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 27, 72, 0.2);
    }

    .btn-load-more-new:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .btn-load-more-new .loading-spinner {
        display: inline-block;
    }

    .btn-load-more-new.loading {
        pointer-events: none;
    }
    .liked-item {
        transition: all 0.4s ease;
    }

    .liked-item.removing {
        opacity: 0;
        transform: translateX(-20px);
        height: 0;
        margin: 0;
        overflow: hidden;
    }
    /* Ana Renkler */
    :root {
        --primary-color: #001b48;
        --primary-light: #002b6b;
        --text-dark: #333;
        --text-muted: #666;
        --border-color: #e0e0e0;
        --bg-light: #f8f9fa;
    }

    /* Profil Kartı */
    .profile-card {
        padding: 30px;
    }

    /* Avatar */
    .avatar-wrapper {
        width: 140px;
        height: 140px;
        margin: 0 auto;
        border-radius: 50%;
        background: #fff;
    }

    .profile-avatar {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .profile-username {
        font-size: 24px;
        font-weight: 700;
        color: var(--primary-color);
        margin: 0;
    }

    .profile-join-date {
        color: var(--text-muted);
        font-size: 13px;
        margin-top: 8px;
    }

    /* Detay İtemler */
    .profile-details {
        padding: 16px 0;
        border-top: 1px solid var(--border-color);
        border-bottom: 1px solid var(--border-color);
    }

    .detail-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        color: var(--text-dark);
        font-size: 14px;
    }

    .detail-item i {
        width: 30px;
        color: var(--primary-color);
        font-size: 16px;
    }

    /* İstatistikler */
    .profile-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin: 25px 0;
    }

    .stat-item {
        text-align: center;
        padding: 15px 10px;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        background: var(--primary-color);
        transform: translateY(-2px);
    }

    .stat-item:hover .stat-value,
    .stat-item:hover .stat-label {
        color: #fff;
    }

    .stat-value {
        font-size: 24px;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 500;
    }

    /* Kategori Dağılımı */
    .category-breakdown {
        margin-top: 25px;
    }

    .section-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 15px;
    }

    .breakdown-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid var(--border-color);
        font-size: 14px;
    }

    .breakdown-item:last-child {
        border-bottom: none;
    }

    .breakdown-label {
        color: var(--text-dark);
        display: flex;
        align-items: center;
    }

    .breakdown-label i {
        color: var(--primary-color);
    }

    .breakdown-value {
        font-weight: 700;
        color: var(--primary-color);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 13px;
    }

    /* Aktiviteler Bölümü */
    .activities-section {
        padding: 30px;
    }

    /* Tab Navigation */
    .activity-tabs {
        display: flex;
        flex-wrap: nowrap;
        gap: 0;
        justify-content: flex-start;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: var(--primary-color) var(--bg-light);
    }

    .activity-tabs::-webkit-scrollbar {
        height: 4px;
    }

    .activity-tabs::-webkit-scrollbar-track {
        background: var(--bg-light);
        border-radius: 10px;
    }

    .activity-tabs::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 10px;
    }

    .activity-tabs::-webkit-scrollbar-thumb:hover {
        background: var(--primary-light);
    }

    .activity-tabs .nav-item {
        flex: 0 0 auto;
    }

    .activity-tabs .nav-link {
        border: none;
        background: none;
        color: var(--text-muted);
        font-weight: 600;
        font-size: 14px;
        padding: 12px 20px;
        border-radius: 8px 8px 0 0;
        position: relative;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap; 
    }

    .activity-tabs .nav-link:hover {
        color: var(--primary-color);
    }

    .activity-tabs .nav-link.active {
        color: var(--primary-color);
        background: white;
        border-bottom: 2px solid var(--primary-color);
    }

    .activity-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 2px;
        background: var(--primary-color);
    }

    .activity-tabs .badge {
        background: var(--primary-color);
        color: #fff;
        font-size: 11px;
        padding: 3px 8px;
        border-radius: 20px;
        margin-left: 8px;
    }

    @media (max-width: 768px) {
    .activity-tabs {
        margin-left: -20px;
        margin-right: -20px;
        padding-left: 20px;
        padding-right: 20px;
        gap: 8px;
    }
    
    .activity-tabs .nav-link {
        font-size: 13px;
        padding: 10px 16px;
    }
    
    .activity-tabs .badge-count {
        font-size: 10px;
        padding: 2px 6px;
    }
}

@media (max-width: 576px) {
    .activity-tabs {
        gap: 6px;
    }
    
    .activity-tabs .nav-link {
        font-size: 12px;
        padding: 8px 12px;
    }
    
    /* Çok küçük ekranlarda sadece ikon + sayı */
    .activity-tabs .tab-text {
        display: none;
    }
    
    .activity-tabs .nav-link {
        flex-direction: row;
        gap: 4px;
    }
    

}

    .activity-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
        gap: 15px;
    }

    .activity-title {
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        flex: 1;
    }

    .activity-title a {
        color: var(--primary-color);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .activity-title a:hover {
        color: var(--primary-light);
        text-decoration: underline;
    }

    .activity-date {
        font-size: 12px;
        color: var(--text-muted);
        white-space: nowrap;
    }

    .activity-content {
        color: var(--text-dark);
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 12px;
    }

    .activity-footer {
        display: flex;
        gap: 20px;
        padding-top: 12px;
        border-top: 1px solid var(--border-color);
    }

    .activity-stat {
        font-size: 13px;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .activity-stat i {
        font-size: 14px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-muted);
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 15px;
        opacity: 0.3;
    }

    .empty-state p {
        margin: 0;
        font-size: 14px;
    }

    /* Load More Button */
    .btn-load-more {
        display: inline-block;
        padding: 10px 30px;
        background: var(--bg-light);
        color: var(--primary-color);
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .btn-load-more:hover {
        background: var(--primary-color);
        color: #fff;
    }

    .liked-category-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--primary-color);
        padding: 12px 0;
        margin: 20px 0 15px 0;
        border-bottom: 2px solid var(--border-color);
        display: flex;
        align-items: center;
    }

    .liked-category-title:first-child {
        margin-top: 0;
    }


    /* Responsive Design */
    @media (max-width: 991px) {
        .profile-card {
            position: relative;
            top: 0;
        }
        
        .profile-stats {
            gap: 10px;
        }
        
        .stat-item {
            padding: 0px;
        }
        
        .stat-value {
            font-size: 20px;
        }
    }

    @media (max-width: 768px) {
        .profile-card,
        .activities-section {
            padding: 0px;
        }
        
        .avatar-wrapper {
            width: 120px;
            height: 120px;
        }
        
        .profile-username {
            font-size: 20px;
        }
        
        .activity-tabs .nav-link {
            font-size: 13px;
            padding: 10px 15px;
        }
        
        .activity-header {
            flex-direction: column;
            gap: 8px;
        }
        
        .activity-title {
            font-size: 15px;
        }
    }
</style>
@endsection

@section('js')
<script>
// Profil sayfasında mı kontrol et
const isOwnProfile = '{{ auth()->check() && auth()->id() == $user->id ? "true" : "false" }}' === 'true';
const currentUserId = '{{ auth()->id() }}';

function getTopicUrl(type, topicId, action) {
    switch (type) {
        case 'city':
            return `/city/topic/${topicId}/${action}`;
        case 'university':
            return `/university/topic/${topicId}/${action}`;
        default:
            return `/general/topic/${topicId}/${action}`;
    }
}

// Like butonu
$(document).on('click', '.like-btn', function () {
    const $this = $(this);
    const topicId = $(this).data('id');
    const type = $(this).data('type');

    if (!currentUserId) {
        toastr.error('Giriş yapmalısın.');
        return;
    }

    const likeCount = $(this).find('.like-count');
    const dislikeBtn = $(this).closest('.like-dislike').find('.dislike-btn');
    const dislikeCount = dislikeBtn.find('.dislike-count');
    
    // Beğeniler sekmesindeki item'ı bul
    const $likedItem = $(this).closest('.liked-item');
    const isInLikedTab = $likedItem.length > 0;
    
    // Tüm topic box'ı bul (clone için)
    const $topicBox = $(this).closest('.topic');

    $.ajax({
        url: getTopicUrl(type, topicId, 'like'),
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
        },
        success: function (response) {
            const previousLikes = parseInt(likeCount.text());
            likeCount.text(response.likes);
            dislikeCount.text(response.dislikes);
            
            // Eğer kendi profilindeyse
            if (isOwnProfile) {
                const $likedTabItem = $(`#liked .liked-item[data-topic-id="${topicId}"][data-topic-type="${type}"]`);
                
                // SENARYO 1: Beğeni EKLENDI (user_liked = true)
                if (response.user_liked && $likedTabItem.length === 0) {
                    addToLikedTab($topicBox, topicId, type);
                }
                
                // SENARYO 2: Beğeni KALDIRILDI (user_liked = false)
                else if (!response.user_liked && $likedTabItem.length > 0) {
                    removeLikedItem($likedTabItem);
                }
                
                // Beğeniler sekmesindeyse
                if (isInLikedTab && !response.user_liked) {
                    removeLikedItem($likedItem);
                }
            }
        }
    });
});

// Dislike butonu
$(document).on('click', '.dislike-btn', function () {
    const $this = $(this);
    const topicId = $(this).data('id');
    const type = $(this).data('type');

    if (!currentUserId) {
        toastr.error('Giriş yapmalısın.');
        return;
    }

    const dislikeCount = $(this).find('.dislike-count');
    const likeBtn = $(this).closest('.like-dislike').find('.like-btn');
    const likeCount = likeBtn.find('.like-count');
    
    // Beğeniler sekmesindeki item'ı bul
    const $likedItem = $(this).closest('.liked-item');
    const isInLikedTab = $likedItem.length > 0;

    $.ajax({
        url: getTopicUrl(type, topicId, 'dislike'),
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
        },
        success: function (response) {
            likeCount.text(response.likes);
            dislikeCount.text(response.dislikes);
            
            // Eğer kendi profilindeyse
            if (isOwnProfile) {
                const $likedTabItem = $(`#liked .liked-item[data-topic-id="${topicId}"][data-topic-type="${type}"]`);
                
                // Dislike yapıldı, beğenilerden kaldır
                if ($likedTabItem.length > 0) {
                    removeLikedItem($likedTabItem);
                }
                
                // Beğeniler sekmesindeyse
                if (isInLikedTab) {
                    removeLikedItem($likedItem);
                }
            }
        }
    });
});

// Beğeniler sekmesine ekle
// Beğeniler sekmesine ekle (güncelle)
function addToLikedTab($topicBox, topicId, type) {
    // Empty state varsa kaldır
    $('#liked .empty-state').remove();
    
    const categoryTitles = {
        'university': '<div class="liked-category-title"><i class="fa-solid fa-graduation-cap me-2"></i>Üniversiteler</div>',
        'general': '<div class="liked-category-title"><i class="fa-solid fa-comments me-2"></i>Genel Forum</div>',
        'city': '<div class="liked-category-title"><i class="fa-solid fa-city me-2"></i>Şehirler</div>'
    };
    
    // Kategori section var mı kontrol et
    let $categorySection = $(`.liked-category-section[data-category="${type}"]`);
    
    // Topic box'ı clone et
    const $clonedTopic = $topicBox.clone();
    const $newItem = $('<div class="liked-item" data-topic-id="' + topicId + '" data-topic-type="' + type + '"></div>');
    $newItem.append($clonedTopic);
    
    if ($categorySection.length === 0) {
        // Kategori section yoksa oluştur
        const buttonText = {
            'university': 'Daha Fazla Üniversite Yorumu',
            'general': 'Daha Fazla Forum Yorumu',
            'city': 'Daha Fazla Şehir Yorumu'
        };
        
        const sectionHtml = `
            <div class="liked-category-section" data-category="${type}">
                ${categoryTitles[type]}
                <div class="category-items"></div>
                <div class="text-center mt-3 mb-4">
                    <button class="btn-load-more-category" data-category="${type}" data-offset="10">
                        <i class="fa-solid fa-chevron-down me-2"></i>
                        ${buttonText[type]}
                        <span class="loading-spinner" style="display: none;">
                            <i class="fa-solid fa-spinner fa-spin ms-2"></i>
                        </span>
                    </button>
                </div>
            </div>
        `;
        
        // Doğru sırada ekle (university -> general -> city)
        const categoryOrder = ['university', 'general', 'city'];
        const currentIndex = categoryOrder.indexOf(type);
        let inserted = false;
        
        for (let i = currentIndex + 1; i < categoryOrder.length; i++) {
            const $nextSection = $(`.liked-category-section[data-category="${categoryOrder[i]}"]`);
            if ($nextSection.length > 0) {
                $(sectionHtml).insertBefore($nextSection);
                inserted = true;
                break;
            }
        }
        
        if (!inserted) {
            $('.comments-container[data-tab="liked"]').append(sectionHtml);
        }
        
        $categorySection = $(`.liked-category-section[data-category="${type}"]`);
    }
    
    // Category items container'a ekle
    $categorySection.find('.category-items').append($newItem);
    
    // Badge sayısını artır
    const $badge = $('.activity-tabs button[data-bs-target="#liked"] .badge');
    const currentBadgeCount = parseInt($badge.text());
    $badge.text(currentBadgeCount + 1);
    
    // Animasyon ekle
    $newItem.hide().slideDown(400);
}

// Beğenilen item'ı kaldır (ortak fonksiyon)
function removeLikedItem($item) {
    // Badge sayısını azalt
    const $badge = $('.activity-tabs button[data-bs-target="#liked"] .badge');
    const currentBadgeCount = parseInt($badge.text());
    $badge.text(Math.max(0, currentBadgeCount - 1));
    
    // Item'ı animasyonla kaldır
    $item.addClass('removing');
    setTimeout(function() {
        $item.remove();
        
        // Eğer kategori boş kaldıysa, kategori başlığını da kaldır
        checkEmptyCategories();
    }, 400);
}

// Boş kategorileri kontrol et
function checkEmptyCategories() {
    // Tüm kategorileri kontrol et
    const categories = ['university', 'general', 'city'];
    
    categories.forEach(function(category) {
        const $items = $(`.liked-item[data-topic-type="${category}"]`);
        
        // Eğer kategori boşsa başlığı kaldır
        if ($items.length === 0) {
            // Başlıkları bul ve kaldır
            $('.liked-category-title').each(function() {
                const $title = $(this);
                const $nextItems = $title.nextUntil('.liked-category-title, .empty-state');
                
                if ($nextItems.length === 0 || $nextItems.filter('.liked-item').length === 0) {
                    $title.remove();
                }
            });
        }
    });
    
    // Tüm beğeniler boşsa empty state göster
    if ($('.liked-item').length === 0) {
        $('#liked').html(`
            <div class="empty-state">
                <i class="fa-solid fa-heart-crack"></i>
                <p>Henüz beğenilen yorum yok</p>
            </div>
        `);
    }
}
</script>

<script>
 // Daha Fazlasını Gör Butonu
$(document).on('click', '.btn-load-more-new', function() {
    const $btn = $(this);
    const tab = $btn.data('tab');
    const currentOffset = parseInt($btn.data('offset'));
    
    // Button'u disable et
    $btn.prop('disabled', true).addClass('loading');
    $btn.find('.loading-spinner').show();
    $btn.find('.fa-chevron-down').hide();
    
    const username = '{{ $user->username }}';
    let url, data;
    
    if (tab === 'liked') {
        url = `/profil/${username}/load-more-liked`;
        data = { offset: currentOffset };
    } else {
        url = `/profil/${username}/load-more-comments`;
        const typeMap = {
            'general': 'general',
            'universities': 'university',
            'cities': 'city'
        };
        data = { 
            type: typeMap[tab],
            offset: currentOffset 
        };
    }
    
    $.ajax({
        url: url,
        method: 'GET',
        data: data,
        success: function(response) {
            const $container = $(`.comments-container[data-tab="${tab}"]`);
            
            if (response.html) {
                // Yeni içeriği ekle
                $container.append(response.html);
                
                // Offset'i güncelle
                $btn.data('offset', currentOffset + 10);
            }
            
            // Daha fazla yoksa butonu gizle
            if (!response.hasMore) {
                $btn.parent().html('<p class="text-muted" style="font-size: 14px; margin-top: 20px;">Tüm yorumlar gösteriliyor</p>');
            } else {
                // Button'u tekrar aktif et
                $btn.prop('disabled', false).removeClass('loading');
                $btn.find('.loading-spinner').hide();
                $btn.find('.fa-chevron-down').show();
            }
        },
        error: function() {
            toastr.error('Yorumlar yüklenirken hata oluştu');
            $btn.prop('disabled', false).removeClass('loading');
            $btn.find('.loading-spinner').hide();
            $btn.find('.fa-chevron-down').show();
        }
    });
});

// Kategori bazlı "Daha Fazlasını Gör"
$(document).on('click', '.btn-load-more-category', function() {
    const $btn = $(this);
    const category = $btn.data('category');
    const currentOffset = parseInt($btn.data('offset'));
    
    // Button'u disable et
    $btn.prop('disabled', true).addClass('loading');
    $btn.find('.loading-spinner').show();
    $btn.find('.fa-chevron-down').hide();
    
    const username = '{{ $user->username }}';
    
    $.ajax({
        url: `/profil/${username}/load-more-liked-category`,
        method: 'GET',
        data: { 
            category: category,
            offset: currentOffset 
        },
        success: function(response) {
            const $categorySection = $(`.liked-category-section[data-category="${category}"]`);
            const $itemsContainer = $categorySection.find('.category-items');
            
            if (response.html) {
                // Yeni içeriği ekle
                $itemsContainer.append(response.html);
                
                // Offset'i güncelle
                $btn.data('offset', currentOffset + 10);
            }
            
            // Daha fazla yoksa butonu gizle
            if (!response.hasMore) {
                $btn.parent().html('<p class="text-muted" style="font-size: 13px;">Tüm yorumlar gösteriliyor</p>');
            } else {
                // Button'u tekrar aktif et
                $btn.prop('disabled', false).removeClass('loading');
                $btn.find('.loading-spinner').hide();
                $btn.find('.fa-chevron-down').show();
            }
        },
        error: function() {
            toastr.error('Yorumlar yüklenirken hata oluştu');
            $btn.prop('disabled', false).removeClass('loading');
            $btn.find('.loading-spinner').hide();
            $btn.find('.fa-chevron-down').show();
        }
    });
});
</script>
@endsection