@extends('layouts.master')

@section('title', $university->universite_ad . ' Yorumları | CampusConnect')
@section('meta_description', $university->universite_ad . ' hakkında öğrenci yorumları, kampüs yaşamı ve gerçek deneyimler.')

@section('content')

{{-- University Header --}}
<div class="university-header">
    <div class="container">
        <div class="header-wrapper">
            <button class="btn-back" onclick="goBack()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </button>
            <div class="header-info">
                <div class="d-flex mb-3 align-items-center">
                    @if ($university->logo)
                        <img src="{{ $university->logo }}" style="width:40px;height:40px;object-fit:contain;" alt="">
                    @else
                        <svg width="40" height="40" fill="#001b48" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2L1 7l11 5 9-4.09V17h2V7zM3 9.29V17a2 2 0 002 2h6v-5H7v-2h4V9H3z"/>
                        </svg>
                    @endif
                    <span class="university-name ms-2">{{ $university->universite_ad }} Yorumları</span>
                </div>
           
                <div class="header-stats">
                    <div class="stat-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                        <span>{{ array_sum($topicCount) }} Yorum</span>
                    </div>
                    <div class="stat-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        <span>Aktif Topluluk</span>
                    </div>
                </div>
            </div>
            <button class="btn-write-review btnExplain" data-category="free-zone">
                <i class="fa-solid fa-comments me-2"></i>
                <span>Yorum Yaz</span>
            </button>
        </div>
    </div>
</div>

<div class="container main-container">
    <div class="row g-4">
        
        {{-- Sidebar --}}
        <div class="col-lg-3 d-none d-lg-block">
            <div class="sidebar-sticky">
                
                {{-- Categories Card --}}
                <div class="sidebar-card">
                    <h3 class="sidebar-title">Kategoriler</h3>
                    <nav class="category-nav">
                        <button class="category-btn active" data-category="free-zone">
                            <div class="category-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                </svg>
                            </div>
                            <div class="category-text">
                                <span class="category-name">Serbest Bölge</span>
                                <span class="category-count">{{ $topicCount['free-zone'] }}</span>
                            </div>
                        </button>
                        
                        <button class="category-btn" data-category="departmant-programs">
                            <div class="category-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                                </svg>
                            </div>
                            <div class="category-text">
                                <span class="category-name">Bölüm & Program</span>
                                <span class="category-count">{{ $topicCount['departmant-programs'] }}</span>
                            </div>
                        </button>
                        
                        <button class="category-btn" data-category="campus-life">
                            <div class="category-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="7" height="7"/>
                                    <rect x="14" y="3" width="7" height="7"/>
                                    <rect x="14" y="14" width="7" height="7"/>
                                    <rect x="3" y="14" width="7" height="7"/>
                                </svg>
                            </div>
                            <div class="category-text">
                                <span class="category-name">Kampüs Hayatı</span>
                                <span class="category-count">{{ $topicCount['campus-life'] }}</span>
                            </div>
                        </button>
                        
                        <button class="category-btn" data-category="question-answer">
                            <div class="category-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                                </svg>
                            </div>
                            <div class="category-text">
                                <span class="category-name">Soru & Cevap</span>
                                <span class="category-count">{{ $topicCount['question-answer'] }}</span>
                            </div>
                        </button>
                    </nav>
                </div>

                {{-- Trending Topics --}}
                <div class="sidebar-card">
                    <h3 class="sidebar-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                        </svg>
                        Popüler Konular
                    </h3>
                    <ul class="trending-list">
                        @forelse($getUnivercityFreeZoneTopics->take(8) as $topic)
                            <li>
                                <a href="{{ route('university.topic.comments', $topic->topic_title_slug) }}" 
                                   class="trending-link">
                                    <span class="trending-text">{{ Str::limit($topic->topic_title, 45) }}</span>
                                    <span class="trending-badge">{{ $topic->count }}</span>
                                </a>
                            </li>
                        @empty
                            <li class="empty-text">Henüz yorum yok</li>
                        @endforelse
                    </ul>
                </div>

            </div>
        </div>

        {{-- Main Content --}}
        <div class="col-lg-9">
            
            {{-- Mobile Category Tabs --}}
            <div class="mobile-categories d-lg-none">
                <div class="mobile-categories-scroll">
                    <button class="mobile-category active" data-category="free-zone">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                        <span>Serbest</span>
                        <span class="mobile-badge">{{ $topicCount['free-zone'] }}</span>
                    </button>
                    
                    <button class="mobile-category" data-category="departmant-programs">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                        </svg>
                        <span>Bölüm</span>
                        <span class="mobile-badge">{{ $topicCount['departmant-programs'] }}</span>
                    </button>
                    
                    <button class="mobile-category" data-category="campus-life">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="7"/>
                            <rect x="14" y="3" width="7" height="7"/>
                            <rect x="14" y="14" width="7" height="7"/>
                            <rect x="3" y="14" width="7" height="7"/>
                        </svg>
                        <span>Kampüs</span>
                        <span class="mobile-badge">{{ $topicCount['campus-life'] }}</span>
                    </button>
                    
                    <button class="mobile-category" data-category="question-answer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                            <line x1="12" y1="17" x2="12.01" y2="17"/>
                        </svg>
                        <span>Soru</span>
                        <span class="mobile-badge">{{ $topicCount['question-answer'] }}</span>
                    </button>
                </div>
            </div>

            {{-- Share Your Experience Card --}}
            <div class="share-card">
                <div class="share-card-content">
                    <div class="share-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                    </div>
                    <button class="share-input btnExplain" data-category="free-zone">
                        Deneyimini paylaş...
                    </button>
                </div>
            </div>

            {{-- Topics Container --}}
            <div class="topics-container">
                {{-- Free Zone Tab --}}
                <div class="tab-panel active" id="free-zone">
                    <div id="free-zone-topic-list">
                        @forelse($univercity_free_zone_topics as $topic)
                            <x-topic-box :topic="$topic" routeName="university.topic.comments" type="university"/>
                        @empty
                            <div class="empty-state">
                                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                </svg>
                                <h4>Henüz Yorum Yok</h4>
                                <p>Bu kategoride ilk yorumu sen yap!</p>
                            </div>
                        @endforelse
                        <div id="free-zone-spinner" class="loading-spinner d-none">
                            <div class="spinner"></div>
                        </div>
                    </div>
                </div>

                {{-- Other Tabs --}}
                <div class="tab-panel" id="departmant-programs">
                    <div id="departmant-programs-topic-list"></div>
                    <div id="departmant-programs-spinner" class="loading-spinner" style="display: none;">
                        <div class="spinner"></div>
                    </div>
                </div>

                <div class="tab-panel" id="campus-life">
                    <div id="campus-life-topic-list"></div>
                    <div id="campus-life-spinner" class="loading-spinner" style="display: none;">
                        <div class="spinner"></div>
                    </div>
                </div>

                <div class="tab-panel" id="question-answer">
                    <div id="question-answer-topic-list"></div>
                    <div id="question-answer-spinner" class="loading-spinner" style="display: none;">
                        <div class="spinner"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Mobile Trending Button --}}
<button class="mobile-fab d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#trendingOffcanvas">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
    </svg>
</button>

{{-- Mobile Trending Offcanvas --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="trendingOffcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Popüler Konular</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="trending-list">
            @foreach($getUnivercityFreeZoneTopics as $topic)
                <li>
                    <a href="{{ route('university.topic.comments', $topic->topic_title_slug) }}" 
                       class="trending-link">
                        <span class="trending-text">{{ $topic->topic_title }}</span>
                        <span class="trending-badge">{{ $topic->count }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

{{-- Write Post Modal --}}
<div class="modal fade" id="topicModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yorumunu Paylaş</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="topicForm">
                    @csrf
                    <input type="hidden" name="universityId" value="{{ $university->id }}">
                    <input type="hidden" id="categoryName" name="category">
                    
                    <div class="mb-3">
                        <input type="text" 
                               id="title" 
                               name="topic_title" 
                               class="form-control" 
                               placeholder="Başlık..."
                               maxlength="80" 
                               required>
                        <div class="form-text text-end">
                            <span id="charCount">0</span>/80
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <textarea class="form-control" 
                                  id="topicDescription" 
                                  name="comment" 
                                  rows="6"
                                  placeholder="Deneyimlerini detaylı anlat..."
                                  required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100" id="submitTopic">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="22" y1="2" x2="11" y2="13"/>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                        </svg>
                        Paylaş
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
<style>
:root {
    --primary: #001b48;
    --accent: #0ea5e9;
    --text-primary: #0f172a;
    --text-secondary: #64748b;
    --bg-primary: #ffffff;
    --bg-secondary: #f8fafc;
    --border: #e2e8f0;
    --hover: #f1f5f9;
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
}

/* ========== HEADER ========== */
.university-header {
    background: var(--bg-primary);
    border-bottom: 1px solid var(--border);
    padding: 16px 0;
    margin-bottom: 24px;
}

.header-wrapper {
    display: flex;
    align-items: center;
    gap: 16px;
}

.btn-back {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background: transparent;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
    flex-shrink: 0;
}

.btn-back:hover {
    background: var(--hover);
}

.header-info {
    flex: 1;
    min-width: 0;
}

.university-name {
    font-size: 22px;
    font-weight: 500 !important;
    line-height: 1;
    /* white-space: nowrap; */
    overflow: hidden;
    text-overflow: ellipsis;
}

.header-stats {
    display: flex;
    gap: 20px;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    color: var(--text-secondary);
}

.stat-item svg {
    flex-shrink: 0;
}

.btn-write-review {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: #001b48;
    color: white;
    border: none;
    border-radius: 24px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s;
    white-space: nowrap;
    flex-shrink: 0;
}

.btn-write-review:hover {
    background: #0284c7;
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

/* ========== CONTAINER ========== */
.main-container {
    max-width: 1200px;
    padding: 0 16px 40px;
}

/* ========== SIDEBAR ========== */
.sidebar-sticky {
    position: sticky;
    top: 20px;
}

.sidebar-card {
    background: var(--bg-primary);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 16px;
}

.sidebar-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 16px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.sidebar-title svg {
    color: var(--accent);
}

/* Category Nav */
.category-nav {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.category-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: transparent;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s;
    text-align: left;
}

.category-btn:hover {
    background: var(--hover);
}

.category-btn.active {
    background: var(--bg-secondary);
}

.category-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: var(--bg-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: all 0.2s;
}

.category-btn.active .category-icon {
    background: #001b48;
}

.category-icon svg {
    color: var(--text-secondary);
}

.category-btn.active .category-icon svg {
    color: white;
}

.category-text {
    flex: 1;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.category-name {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-primary);
}

.category-count {
    font-size: 12px;
    font-weight: 700;
    color: var(--text-secondary);
    background: var(--bg-secondary);
    padding: 3px 10px;
    border-radius: 12px;
}

.category-btn.active .category-count {
    background: var(--accent);
    color: white;
}

/* Trending */
.trending-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.trending-list li {
    margin-bottom: 8px;
}

.trending-link {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    padding: 10px;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.2s;
}

.trending-link:hover {
    background: var(--hover);
}

.trending-text {
    flex: 1;
    font-size: 13px;
    font-weight: 500;
    color: var(--text-primary);
    line-height: 1.4;
}

.trending-badge {
    font-size: 12px;
    font-weight: 700;
    color: var(--text-secondary);
    background: var(--bg-secondary);
    padding: 4px 10px;
    border-radius: 12px;
    flex-shrink: 0;
}

.empty-text {
    text-align: center;
    color: var(--text-secondary);
    font-size: 13px;
    padding: 20px;
}

/* ========== MOBILE CATEGORIES ========== */
.mobile-categories {
    background: var(--bg-primary);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 8px;
    margin-bottom: 16px;
}

.mobile-categories-scroll {
    display: flex;
    gap: 8px;
    overflow-x: auto;
    scrollbar-width: none;
}

.mobile-categories-scroll::-webkit-scrollbar {
    display: none;
}

.mobile-category {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    padding: 12px 16px;
    background: transparent;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s;
    white-space: nowrap;
}

.mobile-category svg {
    color: var(--text-secondary);
}

.mobile-category span {
    font-size: 12px;
    font-weight: 600;
    color: var(--text-secondary);
}

.mobile-category.active {
    background: var(--bg-secondary);
}

.mobile-category.active svg,
.mobile-category.active span {
    color: var(--accent);
}

.mobile-badge {
    font-size: 11px !important;
    background: var(--bg-secondary);
    padding: 2px 8px;
    border-radius: 10px;
}

.mobile-category.active .mobile-badge {
    background: var(--accent);
    color: white !important;
}

/* ========== SHARE CARD ========== */
.share-card {
    background: var(--bg-primary);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 16px;
    margin-bottom: 16px;
}

.share-card-content {
    display: flex;
    align-items: center;
    gap: 12px;
}

.share-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: var(--bg-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.share-icon svg {
    color: #001b48;
}

.share-input {
    flex: 1;
    padding: 12px 16px;
    background: var(--bg-secondary);
    border: none;
    border-radius: 24px;
    font-size: 15px;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.2s;
    text-align: left;
}

.share-input:hover {
    background: var(--hover);
}

/* ========== TOPICS ========== */
.topics-container {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.tab-panel {
    display: none;
}

.tab-panel.active {
    display: block;
}

.loading-spinner {
    text-align: center;
    padding: 40px;
}

.spinner {
    width: 40px;
    height: 40px;
    border: 3px solid var(--border);
    border-top-color: var(--accent);
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.empty-state {
    background: var(--bg-primary);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 60px 40px;
    text-align: center;
}

.empty-state svg {
    color: var(--text-secondary);
    opacity: 0.3;
    margin-bottom: 16px;
}

.empty-state h4 {
    font-size: 18px;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 8px 0;
}

.empty-state p {
    font-size: 14px;
    color: var(--text-secondary);
    margin: 0;
}

/* ========== MOBILE FAB ========== */
.mobile-fab {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: var(--accent);
    color: white;
    border: none;
    box-shadow: var(--shadow-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 1000;
    transition: all 0.3s;
}

.mobile-fab:hover {
    transform: scale(1.1);
    box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1);
}

/* ========== MODAL ========== */
.modal-content {
    border-radius: 16px;
    border: 1px solid var(--border);
}

.modal-header {
    border-bottom: 1px solid var(--border);
    padding: 20px 24px;
}

.modal-title {
    font-size: 18px;
    font-weight: 700;
    color: var(--text-primary);
}

.modal-body {
    padding: 24px;
}

.form-control {
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 15px;
    transition: all 0.2s;
}

.form-control:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
}

.btn-primary {
    background: var(--accent);
    border: none;
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.2s;
}

.btn-primary:hover {
    background: #0284c7;
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

/* ========== RESPONSIVE ========== */
@media (max-width: 992px) {
    .university-name {
        font-size: 18px;
    }
    
    .btn-write-review {
        padding: 8px 16px;
        font-size: 13px;
    }
    
    .btn-write-review span {
        display: none;
    }
}

@media (max-width: 576px) {
    .university-header {
        padding: 12px 0;
    }
    
    .header-wrapper {
        gap: 12px;
    }
    
    .university-name {
        font-size: 16px;
    }
    
    .header-stats {
        flex-direction: column;
        gap: 6px;
    }
    
    .stat-item {
        font-size: 13px;
    }
}
</style>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

<script>
$(document).ready(function() {
    const universityId = {{ $university->id }};
    let currentCategory = 'free-zone';
    let currentPages = { 'free-zone': 1, 'departmant-programs': 1, 'campus-life': 1, 'question-answer': 1 };
    let isLoading = false;
    let hasMorePages = { 'free-zone': true, 'departmant-programs': true, 'campus-life': true, 'question-answer': true };

    // Category switch
    $('.category-btn, .mobile-category').on('click', function() {
        const category = $(this).data('category');
        if (category === currentCategory) return;
        
        currentCategory = category;
        
        $('.category-btn, .mobile-category').removeClass('active');
        $(`.category-btn[data-category="${category}"], .mobile-category[data-category="${category}"]`).addClass('active');
        
        $('.tab-panel').removeClass('active');
        $(`#${category}`).addClass('active');
        
        $('#categoryName').val(category);
        $('.btnExplain').data('category', category);
        
        if ($(`#${category}-topic-list`).is(':empty')) {
            loadCategoryContent(category);
        }
        loadSidebarTopics(category);
    });

    function loadCategoryContent(category) {
        if (isLoading) return;
        isLoading = true;
        $(`#${category}-spinner`).show();
        
        $.ajax({
            url: '/get-univercity-category-topic-content',
            method: 'GET',
            data: { category, univercityId: universityId },
            success: function(response) {
                $(`#${category}-topic-list`).html(response.success && response.html ? response.html : 
                    '<div class="empty-state"><svg width="64" height="64" viewBox="0 0 24 24" fill="black" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg><h4>Henüz Yorum Yok</h4><p>Bu kategoride ilk yorumu sen yap!</p></div>');
                isLoading = false;
                $(`#${category}-spinner`).hide();
            }
        });
    }

    function loadSidebarTopics(category) {
        $.ajax({
            url: '/get-univercity-category-topics',
            method: 'GET',
            data: { category, univercityId: universityId },
            success: function(response) {
                let html = '';
                response.topics.slice(0, 8).forEach(topic => {
                    const url = "{{ route('university.topic.comments', ['slug' => '__SLUG__']) }}".replace('__SLUG__', topic.topic_title_slug);
                    html += `<li><a href="${url}" class="trending-link"><span class="trending-text">${topic.topic_title.substring(0, 45)}...</span><span class="trending-badge">${topic.count}</span></a></li>`;
                });
                $('.trending-list').html(html || '<li class="empty-text">Henüz yorum yok</li>');
            }
        });
    }

    $(window).on('scroll', function() {
        if (isLoading || !hasMorePages[currentCategory]) return;
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 500) {
            currentPages[currentCategory]++;
            loadMore();
        }
    });

    function loadMore() {
        isLoading = true;
        $(`#${currentCategory}-spinner`).removeClass('d-none').show();
        
        $.ajax({
            url: '{{ route("university.forum.load-more") }}',
            method: 'GET',
            data: { page: currentPages[currentCategory], university_id: universityId, category: currentCategory },
            success: function(response) {
                $(`#${currentCategory}-topic-list`).append(response.html);
                hasMorePages[currentCategory] = response.hasMore;
                isLoading = false;
                $(`#${currentCategory}-spinner`).addClass('d-none').hide();
            }
        });
    }

    $('.btnExplain, .share-input').on('click', function() {
        @if(auth()->check())
            $('#categoryName').val($(this).data('category') || currentCategory);
            $('#topicModal').modal('show');
        @else
            toastr.warning('Yorum yapmak için giriş yapmalısınız');
            setTimeout(() => window.location.href = '/login', 1500);
        @endif
    });

    $('#title').on('input', function() {
        $('#charCount').text($(this).val().length);
    });

    $('#topicForm').on('submit', function(e) {
        e.preventDefault();
        const $btn = $('#submitTopic');
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Gönderiliyor...');
        
        $.ajax({
            url: '/university-topic/add',
            method: 'POST',
            data: $(this).serialize(),
            success: function() {
                $('#topicModal').modal('hide');
                $('#topicForm')[0].reset();
                toastr.success('Yorumunuz başarıyla paylaşıldı!');
                setTimeout(() => location.reload(), 1500);
            },
            error: function() {
                toastr.error('Bir hata oluştu');
                $btn.prop('disabled', false).html('<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>Paylaş');
            }
        });
    });

    window.goBack = () => window.history.back();

    toastr.options = { closeButton: true, progressBar: true, positionClass: "toast-top-right", timeOut: 3000 };
    @if(session('success')) toastr.success("{{ session('success') }}"); @endif
    @if(session('error')) toastr.error("{{ session('error') }}"); @endif
});
</script>
@endsection