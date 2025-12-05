@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- Geri Butonu --}}
            <div class="mb-3">
                <a href="{{ route('my_workspace') }}?board_id={{ $task->task_board_id }}" class="btn d-inline-flex align-items-center gap-2 rounded-3">
                    <i class="bi bi-arrow-left"></i>
                    <span>Çalışma Alanına Dön</span>
                </a>
            </div>

            <div class="card rounded-5 mb-4" style="border:1px solid #dcdcdc;">
                <div class="card-body p-md-5 p-4">

                    {{-- Başlık ve Sil Butonu --}}
                    <div class="mb-4 d-flex align-items-center justify-content-between gap-3">
                        <div class="flex-grow-1 d-flex align-items-center">
                            <i class="fa-solid fa-pen-to-square text-primary me-3 fs-5" style="color: #001b48 !important"></i>
                            <input type="text"
                                class="form-control live-update task-title rounded-0 fs-4 fw-bold p-0"
                                data-field="title"
                                data-id="{{ $task->id }}"
                                value="{{ $task->title }}"
                                placeholder="Görev başlığı...">
                        </div>
                        <button class="btn d-flex align-items-center rounded-3" id="deleteTaskBtn" data-task-id="{{ $task->id }}">
                            <i class="bi bi-trash text-danger"></i>
                            <span class="d-none d-md-inline"></span>
                        </button>
                    </div>

                    {{-- Meta Bilgiler --}}
                    <div class="meta-info-bar mb-4 pb-3 border-bottom d-flex flex-wrap gap-3 align-items-center justify-content-between">
                        <div class="d-flex flex-wrap gap-3 align-items-center">
                            <div class="meta-item">
                                <i class="bi bi-calendar-plus me-1 text-muted"></i>
                                <span class="text-muted small">Oluşturuldu:</span>
                                <span class="fw-semibold small">{{ date('d.m.Y', strtotime($task->created_at)) }}</span>
                            </div>
                            <div class="meta-divider"></div>
                            <div class="meta-item">
                                <i class="bi bi-clock-history me-1 text-muted"></i>
                                <span class="text-muted small">Son Güncelleme:</span>
                                <span class="fw-semibold small">{{ date('d.m.Y H:i', strtotime($task->updated_at)) }}</span>
                            </div>
                        </div>
                        
                        {{-- Durum Badge --}}
                        <div>
                            <span class="status-badge status-{{ $task->status }}" id="statusBadge">
                                @php
                                    $statusLabels = [
                                        'to_do' => ['icon' => '📝', 'label' => 'Yapılacak'],
                                        'in_progress' => ['icon' => '🚧', 'label' => 'Yapılıyor'],
                                        'review' => ['icon' => '🔍', 'label' => 'Kontrol'],
                                        'done' => ['icon' => '✅', 'label' => 'Tamamlandı']
                                    ];
                                @endphp
                                {{ $statusLabels[$task->status]['icon'] }} {{ $statusLabels[$task->status]['label'] }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-4">
                        {{-- Durum --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold text-secondary small d-flex align-items-center gap-2">
                                <i class="bi bi-list-check"></i>
                                Durum
                            </label>
                            <select class="form-select live-update" data-field="status" data-id="{{ $task->id }}">
                                <option value="to_do" {{ $task->status == 'to_do' ? 'selected' : '' }}>📝 Yapılacak</option>
                                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>🚧 Yapılıyor</option>
                                <option value="review" {{ $task->status == 'review' ? 'selected' : '' }}>🔍 Kontrol</option>
                                <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>✅ Tamamlandı</option>
                            </select>
                        </div>

                        {{-- Öncelik --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold text-secondary small d-flex align-items-center gap-2">
                                <i class="bi bi-flag"></i>
                                Öncelik
                            </label>
                            <select class="form-select live-update" data-field="priority" data-id="{{ $task->id }}">
                                <option value="Düşük" {{ $task->priority == 'Düşük' ? 'selected' : '' }}>🟢 Düşük</option>
                                <option value="Orta" {{ $task->priority == 'Orta' ? 'selected' : '' }}>🟡 Orta</option>
                                <option value="Yüksek" {{ $task->priority == 'Yüksek' ? 'selected' : '' }}>🔴 Yüksek</option>
                            </select>
                        </div>

                        {{-- Son Tarih --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold text-secondary small d-flex align-items-center gap-2">
                                <i class="bi bi-calendar-event"></i>
                                Son Tarih
                            </label>
                            <input type="date" 
                                class="form-control live-update" 
                                data-field="due_date" 
                                data-id="{{ $task->id }}" 
                                value="{{ $task->due_date }}">
                            @if($task->due_date)
                                @php
                                    $dueDate = \Carbon\Carbon::parse($task->due_date);
                                    $today = \Carbon\Carbon::today();
                                    $daysLeft = $today->diffInDays($dueDate, false);
                                @endphp
                                <small class="due-date-info mt-1 d-block">
                                    @if($daysLeft < 0)
                                        <span class="text-danger">
                                            <i class="bi bi-exclamation-circle"></i>
                                            {{ abs($daysLeft) }} gün gecikti
                                        </span>
                                    @elseif($daysLeft == 0)
                                        <span class="text-warning">
                                            <i class="bi bi-clock"></i>
                                            Bugün bitiyor
                                        </span>
                                    @elseif($daysLeft <= 3)
                                        <span class="text-warning">
                                            <i class="bi bi-hourglass-split"></i>
                                            {{ $daysLeft }} gün kaldı
                                        </span>
                                    @else
                                        <span class="text-muted">
                                            <i class="bi bi-check-circle"></i>
                                            {{ $daysLeft }} gün kaldı
                                        </span>
                                    @endif
                                </small>
                            @endif
                        </div>
                    </div>

                    {{-- Açıklama --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary small d-flex align-items-center gap-2">
                            <i class="bi bi-text-left"></i>
                            Açıklama
                        </label>
                        <textarea 
                            class="form-control live-update description-area" 
                            data-field="description" 
                            data-id="{{ $task->id }}" 
                            rows="6"
                            placeholder="Görev hakkında detaylı bilgi ekleyin...">{{ $task->description }}</textarea>
                        <small class="text-muted d-block mt-1">
                            <i class="bi bi-info-circle"></i>
                            Görev detaylarını, adımları veya notları buraya yazabilirsiniz
                        </small>
                    </div>

                            {{-- Alt Görevler (Checklist) --}}
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label fw-semibold text-secondary small mb-0 d-flex align-items-center gap-2">
                                <i class="bi bi-check2-square"></i>
                                Alt Görevler
                            </label>
                            <button class="btn btn-sm btn-outline-primary rounded-3 d-flex align-items-center gap-1" id="addSubtaskBtn">
                                <i class="bi bi-plus-circle"></i>
                                <span class="d-none d-sm-inline">Alt Görev Ekle</span>
                                <span class="d-sm-none">Ekle</span>
                            </button>
                        </div>
                        
                        {{-- Mobil İpucu --}}
                        <div class="alert alert-info d-md-none mb-3 py-2 px-3" style="font-size: 12px;">
                            <i class="bi bi-info-circle me-1"></i>
                            <strong>İpucu:</strong> Alt görev yazıp ekranda başka bir yere dokunun veya Enter'a basın.
                        </div>
    
                        <div id="subtasksList" class="subtasks-container">
                            {{-- Alt görevler buraya gelecek --}}
                            @if($task->subtasks && count($task->subtasks) > 0)
                                @foreach($task->subtasks as $subtask)
                                    <div class="subtask-item" data-subtask-id="{{ $subtask->id }}">
                                        <div class="form-check d-flex align-items-center gap-2">
                                            <input class="form-check-input subtask-checkbox" type="checkbox" 
                                                {{ $subtask->is_completed ? 'checked' : '' }} 
                                                data-subtask-id="{{ $subtask->id }}">
                                            <input type="text" class="form-control form-control-sm subtask-title {{ $subtask->is_completed ? 'completed' : '' }}" 
                                                value="{{ $subtask->title }}" 
                                                data-subtask-id="{{ $subtask->id }}"
                                                placeholder="Alt görev...">
                                            <button class="btn btn-sm btn-outline-danger delete-subtask" data-subtask-id="{{ $subtask->id }}">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted text-center py-3 mb-0 empty-subtasks">
                                    <i class="bi bi-inbox"></i><br>
                                    <small>Henüz alt görev eklenmedi</small>
                                </p>
                            @endif
                        </div>

                        {{-- İlerleme Çubuğu --}}
                        @if($task->subtasks && count($task->subtasks) > 0)
                            @php
                                $completedCount = $task->subtasks->where('is_completed', true)->count();
                                $totalCount = $task->subtasks->count();
                                $percentage = $totalCount > 0 ? round(($completedCount / $totalCount) * 100) : 0;
                            @endphp
                            <div class="mt-3" id="progressContainer">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <small class="text-muted">İlerleme</small>
                                    <small class="fw-semibold" id="progressText">{{ $completedCount }}/{{ $totalCount }} ({{ $percentage }}%)</small>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" id="progressBar" role="progressbar" 
                                        style="width: {{ $percentage }}%; background-color: #001b48;" 
                                        aria-valuenow="{{ $percentage }}" 
                                        aria-valuemin="0" 
                                        aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Etiketler --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary small d-flex align-items-center gap-2">
                            <i class="bi bi-tags"></i>
                            Etiketler
                        </label>
                        <div class="tags-container d-flex flex-wrap gap-2 mb-2" id="tagsContainer">
                            @if($task->tags && count($task->tags) > 0)
                                @foreach($task->tags as $tag)
                                    <span class="tag-badge" data-tag="{{ $tag }}">
                                        {{ $tag }}
                                        <i class="bi bi-x-circle ms-1 remove-tag" data-tag="{{ $tag }}"></i>
                                    </span>
                                @endforeach
                            @endif
                        </div>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="tagInput" placeholder="Etiket ekle (Enter ile ekleyin)">
                            <button class="btn btn-outline-secondary" type="button" id="addTagBtn">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        <small class="text-muted d-block mt-1">
                            <i class="bi bi-lightbulb"></i>
                            Örnek: acil, önemli, araştırma, toplantı
                        </small>
                    </div>

                    {{-- Geri bildirim --}}
                    <div id="update-status" class="alert alert-success d-flex align-items-center gap-2 mb-0" style="display: none !important;">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Değişiklik kaydedildi</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    :root {
        --primary-color: #001b48;
        --border-color: #dcdcdc;
        --text-muted: #64748b;
        --bg-light: #f8fafc;
    }

    .content-wrapper {
        padding: 2.75rem 15px !important;
    }

    /* Task Title */
    .task-title {
        border: none !important;
        border-bottom: 2px solid var(--border-color) !important;
        transition: border-color 0.2s;
    }

    .task-title:focus {
        outline: none;
        box-shadow: none;
        border-bottom-color: var(--primary-color);
    }

    /* Meta Info Bar */
    .meta-info-bar {
        font-size: 14px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .meta-divider {
        width: 1px;
        height: 20px;
        background: var(--border-color);
    }

    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .status-to_do {
        background: #f1f5f9;
        color: #475569;
    }

    .status-in_progress {
        background: #dbeafe;
        color: #1e40af;
    }

    .status-review {
        background: #fef3c7;
        color: #92400e;
    }

    .status-done {
        background: #d1fae5;
        color: #065f46;
    }

    /* Form Controls */
    .form-select, .form-control {
        border-radius: 8px;
        border: 1px solid var(--border-color);
        transition: all 0.2s;
    }

    .form-select:focus, .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(0, 27, 72, 0.1);
    }

    .form-label {
        font-size: 13px;
        margin-bottom: 8px;
    }

    /* Description Area */
    .description-area {
        resize: vertical;
        min-height: 120px;
        line-height: 1.6;
    }

    /* Due Date Info */
    .due-date-info {
        font-size: 12px;
        font-weight: 500;
    }

    /* Subtasks */
    .subtasks-container {
        max-height: 400px;
        overflow-y: auto;
    }

    .subtask-item {
        padding: 8px 12px;
        background: var(--bg-light);
        border-radius: 6px;
        margin-bottom: 8px;
        transition: background 0.2s;
    }

    .subtask-item:hover {
        background: #f1f5f9;
    }

    .subtask-checkbox {
        cursor: pointer;
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }

    .subtask-title {
        border: none;
        background: transparent;
        padding: 4px 8px;
        flex: 1;
        transition: all 0.2s;
    }

    .subtask-title:focus {
        background: white;
        border-radius: 4px;
        box-shadow: none;
        outline: none;
    }

    .subtask-title.completed {
        text-decoration: line-through;
        color: var(--text-muted);
    }

    .delete-subtask {
        border: none;
        background: transparent;
        color: #dc3545;
        padding: 2px 6px;
        opacity: 0.6;
        transition: opacity 0.2s;
    }

    .delete-subtask:hover {
        opacity: 1;
        background: #fee;
    }

    .empty-subtasks {
        font-size: 14px;
    }

    /* Progress Bar */
    #progressContainer {
        padding: 12px;
        background: var(--bg-light);
        border-radius: 8px;
    }

    .progress {
        border-radius: 10px;
        background: #e2e8f0;
    }

    .progress-bar {
        border-radius: 10px;
        transition: width 0.3s ease;
    }

    /* Tags */
    .tags-container {
        min-height: 40px;
        padding: 8px;
        background: var(--bg-light);
        border-radius: 6px;
    }

    .tag-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        background: var(--primary-color);
        color: white;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
    }

    .remove-tag {
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.2s;
    }

    .remove-tag:hover {
        opacity: 1;
    }

    /* Buttons */
    .btn-outline-secondary {
        color: var(--text-muted);
        border-color: var(--border-color);
    }

    .btn-outline-secondary:hover {
        background: var(--bg-light);
        border-color: var(--text-muted);
        color: var(--text-muted);
    }

    .btn-outline-primary {
        color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-outline-primary:hover {
        background: var(--primary-color);
        color: white;
    }

    .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }

    .btn-outline-danger:hover {
        background: #dc3545;
        color: white;
    }

    /* Update Status */
    #update-status {
        border-radius: 8px;
        font-size: 14px;
        padding: 12px 16px;
        border: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem !important;
        }

        .task-title {
            font-size: 1.25rem !important;
        }

        .meta-info-bar {
            flex-direction: column;
            align-items: flex-start !important;
        }

        .meta-divider {
            display: none;
        }
    }
    /* Mini Bildirim */
    .mini-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #001b48;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0, 27, 72, 0.3);
        z-index: 9999;
        animation: slideInRight 0.3s ease;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Mobil İpucu */
    .alert-info {
        background: #e7f3ff;
        border: 1px solid #b3d9ff;
        color: #004085;
        border-radius: 8px;
    }

    /* Subtask Input Focus - Mobil için daha belirgin */
    .subtask-title-new:focus {
        background: #fffef7 !important;
        border: 2px solid #001b48 !important;
        box-shadow: 0 0 0 3px rgba(0, 27, 72, 0.1) !important;
    }

    /* Loading durumu */
    .subtask-title-new:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Mobil dokunma alanı iyileştirme */
    @media (max-width: 768px) {
        .subtask-item {
            padding: 10px 12px;
            margin-bottom: 10px;
        }
        
        .subtask-checkbox {
            width: 20px;
            height: 20px;
        }
        
        .subtask-title, .subtask-title-new {
            font-size: 15px;
            padding: 8px 10px;
            min-height: 44px; /* iOS dokunma alanı */
        }
        
        .delete-subtask, .delete-subtask-new {
            min-width: 44px;
            min-height: 44px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .mini-notification {
            top: 10px;
            right: 10px;
            left: 10px;
            text-align: center;
        }
    }

    /* Touch feedback */
    .subtask-item:active {
        background: #e8f0fe;
    }

    .delete-subtask:active, .delete-subtask-new:active {
        transform: scale(0.95);
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        console.log('Sayfa yüklendi'); // Test için

        // Live Update (Mevcut)
        $('.live-update').on('change input', function () {
            let field = $(this).data('field');
            let value = $(this).val();
            let id = $(this).data('id');

            // Durum değişirse badge'i güncelle
            if (field === 'status') {
                updateStatusBadge(value);
            }

            $.ajax({
                url: "{{ route('tasks.live.update') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    field: field,
                    value: value
                },
                success: function (res) {
                    $('#update-status').fadeIn().delay(1500).fadeOut();
                },
                error: function () {
                    alert("Bir hata oluştu, lütfen tekrar deneyin.");
                }
            });
        });

        // Status Badge Güncelleme
        function updateStatusBadge(status) {
            const statusData = {
                'to_do': { icon: '📝', label: 'Yapılacak', class: 'status-to_do' },
                'in_progress': { icon: '🚧', label: 'Yapılıyor', class: 'status-in_progress' },
                'review': { icon: '🔍', label: 'Kontrol', class: 'status-review' },
                'done': { icon: '✅', label: 'Tamamlandı', class: 'status-done' }
            };

            const data = statusData[status];
            $('#statusBadge')
                .removeClass('status-to_do status-in_progress status-review status-done')
                .addClass(data.class)
                .text(`${data.icon} ${data.label}`);
        }

        // Görev Silme
        $('#deleteTaskBtn').on('click', function() {
            console.log('Silme butonu tıklandı'); // Test
            const taskId = $(this).data('task-id');
            
            Swal.fire({
                title: 'Görevi Sil',
                text: 'Bu görevi silmek istediğinize emin misiniz?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Evet, Sil',
                cancelButtonText: 'İptal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/workspace/task/${taskId}`,
                        method: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function () {
                            Swal.fire({
                                icon: 'success',
                                title: 'Silindi!',
                                text: 'Görev başarıyla silindi.',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = '{{ route("my_workspace") }}?board_id={{ $task->task_board_id }}';
                            });
                        },
                        error: function () {
                            Swal.fire('Hata', 'Görev silinirken bir hata oluştu.', 'error');
                        }
                    });
                }
            });
        });

        // ============ ALT GÖREV İŞLEMLERİ ============
        
        // Alt Görev Ekleme Butonu
        $(document).on('click', '#addSubtaskBtn', function(e) {
            e.preventDefault();
            console.log('Alt görev ekleme butonu tıklandı!');
            
            $('.empty-subtasks').remove();
            
            const subtaskHtml = `
                <div class="subtask-item" data-subtask-id="new">
                    <div class="form-check d-flex align-items-center gap-2">
                        <input class="form-check-input subtask-checkbox" type="checkbox" disabled>
                        <input type="text" class="form-control form-control-sm subtask-title-new" placeholder="Alt görev yazın ve Enter'a basın...">
                        <button class="btn btn-sm btn-outline-danger delete-subtask-new" type="button">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>
            `;
            
            $('#subtasksList').append(subtaskHtml);
            $('.subtask-title-new').focus();
        });

        // Yeni Alt Görev Enter ile Kaydet
        $(document).on('keypress blur', '.subtask-title-new', function(e) {
            // Sadece Enter veya blur event'inde çalış
            if (e.type === 'blur' || (e.type === 'keypress' && (e.key === 'Enter' || e.keyCode === 13))) {
                e.preventDefault();
                
                const $input = $(this);
                const title = $input.val().trim();
                const $item = $input.closest('.subtask-item');
                
                // Zaten işlem yapılıyorsa tekrar yapma
                if ($item.data('saving')) {
                    return;
                }
                
                console.log('Alt görev kaydediliyor (', e.type, '):', title);
                
                if (!title) {
                    console.log('Başlık boş, kaldırılıyor');
                    $item.remove();
                    checkEmptySubtasks();
                    return;
                }
                
                // İşlem yapıldığını işaretle
                $item.data('saving', true);
                
                // Loading göster
                $input.prop('disabled', true).css('opacity', '0.6');
                $item.find('.delete-subtask-new').prop('disabled', true);
                
                console.log('AJAX isteği gönderiliyor...');
                
                $.ajax({
                    url: '/workspace/task/{{ $task->id }}/subtask',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        title: title
                    },
                    success: function(res) {
                        console.log('Başarılı yanıt:', res);
                        
                        if (res.success && res.subtask) {
                            // Yeni item oluştur
                            const newHtml = `
                                <div class="subtask-item" data-subtask-id="${res.subtask.id}">
                                    <div class="form-check d-flex align-items-center gap-2">
                                        <input class="form-check-input subtask-checkbox" type="checkbox" data-subtask-id="${res.subtask.id}">
                                        <input type="text" class="form-control form-control-sm subtask-title" value="${res.subtask.title}" data-subtask-id="${res.subtask.id}">
                                        <button class="btn btn-sm btn-outline-danger delete-subtask" data-subtask-id="${res.subtask.id}" type="button">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                </div>
                            `;
                            
                            $item.replaceWith(newHtml);
                            updateProgress();
                            
                            // Küçük bildirim göster
                            showMiniNotification('✓ Alt görev eklendi');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Hatası:', {
                            status: status,
                            error: error,
                            response: xhr.responseText
                        });
                        
                        $input.prop('disabled', false).css('opacity', '1');
                        $item.find('.delete-subtask-new').prop('disabled', false);
                        $item.data('saving', false);
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata!',
                            text: 'Alt görev eklenirken bir hata oluştu: ' + error,
                            confirmButtonText: 'Tamam',
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                });
            }
        });

        function showMiniNotification(message) {
            const notification = `
                <div class="mini-notification">
                    ${message}
                </div>
            `;
            
            $('body').append(notification);
            
            setTimeout(function() {
                $('.mini-notification').fadeOut(300, function() {
                    $(this).remove();
                });
            }, 2000);
        }
        // Alt Görev Başlık Güncelleme - blur ile otomatik kaydet
        $(document).on('blur', '.subtask-title', function() {
            const subtaskId = $(this).data('subtask-id');
            const newTitle = $(this).val().trim();
            const $input = $(this);
            
            if (newTitle) {
                console.log('Alt görev başlığı güncelleniyor:', subtaskId, newTitle);
                
                // Visual feedback
                $input.css('opacity', '0.6');
                
                $.ajax({
                    url: `/workspace/subtask/${subtaskId}/update`,
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}',
                        title: newTitle
                    },
                    success: function() {
                        console.log('Başlık güncellendi');
                        $input.css('opacity', '1');
                        showMiniNotification('✓ Güncellendi');
                    },
                    error: function(xhr) {
                        console.error('Başlık güncellenirken hata:', xhr.responseText);
                        $input.css('opacity', '1');
                        showMiniNotification('✗ Güncelleme hatası');
                    }
                });
            }
        });

        // Yeni Alt Görev Silme (Henüz kaydedilmemiş)
        $(document).on('click', '.delete-subtask-new', function(e) {
            e.preventDefault();
            $(this).closest('.subtask-item').remove();
            checkEmptySubtasks();
        });

        // Alt Görev Checkbox Toggle
        $(document).on('change', '.subtask-checkbox', function() {
            const subtaskId = $(this).data('subtask-id');
            const isCompleted = $(this).is(':checked');
            const $title = $(this).siblings('.subtask-title');
            
            console.log('Checkbox değişti:', subtaskId, isCompleted);
            
            if (isCompleted) {
                $title.addClass('completed');
            } else {
                $title.removeClass('completed');
            }

            $.ajax({
                url: `/workspace/subtask/${subtaskId}/toggle`,
                method: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    is_completed: isCompleted
                },
                success: function() {
                    console.log('Checkbox güncellendi');
                    updateProgress();
                },
                error: function(xhr) {
                    console.error('Checkbox güncellenirken hata:', xhr.responseText);
                }
            });
        });

        // Alt Görev Silme (Kaydedilmiş)
        $(document).on('click', '.delete-subtask', function(e) {
            e.preventDefault();
            const subtaskId = $(this).data('subtask-id');
            const $item = $(this).closest('.subtask-item');
            
            console.log('Alt görev siliniyor:', subtaskId);
            
            Swal.fire({
                title: 'Alt Görevi Sil',
                text: 'Bu alt görevi silmek istediğinize emin misiniz?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Evet, Sil',
                cancelButtonText: 'İptal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/workspace/subtask/${subtaskId}`,
                        method: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function() {
                            console.log('Alt görev silindi');
                            $item.fadeOut(300, function() {
                                $(this).remove();
                                updateProgress();
                                checkEmptySubtasks();
                            });
                        },
                        error: function(xhr) {
                            console.error('Alt görev silinirken hata:', xhr.responseText);
                            Swal.fire('Hata', 'Alt görev silinirken bir hata oluştu.', 'error');
                        }
                    });
                }
            });
        });

        // İlerleme Güncelleme
        function updateProgress() {
            const total = $('.subtask-checkbox').length;
            const completed = $('.subtask-checkbox:checked').length;
            const percentage = total > 0 ? Math.round((completed / total) * 100) : 0;
            
            console.log('İlerleme güncellendi:', completed, '/', total);
            
            $('#progressText').text(`${completed}/${total} (${percentage}%)`);
            $('#progressBar').css('width', `${percentage}%`).attr('aria-valuenow', percentage);
            
            if (total === 0) {
                $('#progressContainer').hide();
            } else {
                $('#progressContainer').show();
            }
        }

        // Boş Alt Görev Kontrolü
        function checkEmptySubtasks() {
            if ($('.subtask-item').length === 0) {
                $('#subtasksList').html(`
                    <p class="text-muted text-center py-3 mb-0 empty-subtasks">
                        <i class="bi bi-inbox"></i><br>
                        Henüz alt görev eklenmedi
                    </p>
                `);
                $('#progressContainer').hide();
            }
        }

        // ============ ETİKET İŞLEMLERİ ============
        
        // Etiket Ekleme (Enter ile)
        $('#tagInput').on('keypress', function(e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                e.preventDefault();
                const tag = $(this).val().trim();
                
                console.log('Etiket ekleniyor:', tag);
                
                if (tag && !$(`.tag-badge[data-tag="${tag}"]`).length) {
                    addTag(tag);
                    $(this).val('');
                }
            }
        });

        // Etiket Ekleme (Buton ile)
        $('#addTagBtn').on('click', function(e) {
            e.preventDefault();
            const tag = $('#tagInput').val().trim();
            
            console.log('Etiket ekleniyor (buton):', tag);
            
            if (tag && !$(`.tag-badge[data-tag="${tag}"]`).length) {
                addTag(tag);
                $('#tagInput').val('');
            }
        });

        function addTag(tag) {
            const tagHtml = `
                <span class="tag-badge" data-tag="${tag}">
                    ${tag}
                    <i class="bi bi-x-circle ms-1 remove-tag" data-tag="${tag}"></i>
                </span>
            `;
            
            $('#tagsContainer').append(tagHtml);
            
            $.ajax({
                url: '/workspace/task/{{ $task->id }}/tag',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    tag: tag
                },
                success: function() {
                    console.log('Etiket eklendi:', tag);
                },
                error: function(xhr) {
                    console.error('Etiket eklenirken hata:', xhr.responseText);
                }
            });
        }

        // Etiket Silme
        $(document).on('click', '.remove-tag', function() {
            const tag = $(this).data('tag');
            
            console.log('Etiket siliniyor:', tag);
            
            $(`.tag-badge[data-tag="${tag}"]`).fadeOut(200, function() {
                $(this).remove();
            });
            
            $.ajax({
                url: '/workspace/task/{{ $task->id }}/tag',
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                    tag: tag
                },
                success: function() {
                    console.log('Etiket silindi:', tag);
                },
                error: function(xhr) {
                    console.error('Etiket silinirken hata:', xhr.responseText);
                }
            });
        });

        // Sayfa yüklendiğinde ilerlemeyi güncelle
        updateProgress();
    });
</script>
@endsection