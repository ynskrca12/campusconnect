@extends('layouts.master')

@section('content')
<div class="container py-md-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-md-5">

                    <!-- Başlık -->
                    <div class="mb-4 d-flex align-items-center">
                        <i class="fa-solid fa-pen-to-square text-primary me-3 fs-5"></i>
                        <input type="text"
                            class="form-control live-update task-title border-0 fs-4 fw-bold p-0"
                            data-field="title"
                            data-id="{{ $task->id }}"
                            value="{{ $task->title }}">
                    </div>

                    <div class="row mb-4">
                        <!-- Durum -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold text-secondary">
                                <i class="fa-solid fa-bars-progress me-1"></i> Durum
                            </label>
                            <select class="form-select live-update" data-field="status" data-id="{{ $task->id }}">
                                <option value="to_do" {{ $task->status == 'to_do' ? 'selected' : '' }}>📝 Yapılacak</option>
                                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>🚧 Devam Ediyor</option>
                                <option value="review" {{ $task->status == 'review' ? 'selected' : '' }}>🔍 Kontrol</option>
                                <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>✅ Tamamlandı</option>
                            </select>
                        </div>

                        <!-- Öncelik -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold text-secondary">
                                <i class="fa-solid fa-bolt me-1"></i> Öncelik
                            </label>
                            <select class="form-select live-update" data-field="priority" data-id="{{ $task->id }}">
                                <option value="Düşük" {{ $task->priority == 'Düşük' ? 'selected' : '' }}>🟢 Düşük</option>
                                <option value="Orta" {{ $task->priority == 'Orta' ? 'selected' : '' }}>🟡 Orta</option>
                                <option value="Yüksek" {{ $task->priority == 'Yüksek' ? 'selected' : '' }}>🔴 Yüksek</option>
                            </select>
                        </div>

                        <!-- Son Tarih -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold text-secondary">
                                <i class="fa-solid fa-calendar-days me-1"></i> Son Tarih
                            </label>
                            <input type="date" class="form-control live-update" data-field="due_date" data-id="{{ $task->id }}" value="{{ $task->due_date }}">
                        </div>
                    </div>

                    <!-- Açıklama -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">
                            <i class="fa-solid fa-align-left me-1"></i> Açıklama
                        </label>
                        <textarea class="form-control live-update" data-field="description" data-id="{{ $task->id }}" rows="5">{{ $task->description }}</textarea>
                    </div>

                    <!-- Geri bildirim -->
                    <div id="update-status" class="mt-3 text-success fw-semibold" style="display: none;">
                        <i class="fa-solid fa-check-circle me-2"></i> Değişiklik kaydedildi.
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('css')
<style>
      .content-wrapper {
            padding:2.75rem 15px !important;
        } 
    .task-title:focus {
        outline: none;
        box-shadow: none;
    }

    .form-select, .form-control {
        border-radius: 10px;
    }

    select.form-select {
        background-color: #f9fafb;
    }

    .form-label {
        font-size: 0.9rem;
    }

    /* Renkli Durumlar */
    select[data-field="status"] option[value="to_do"] {
        color: #6c757d;
    }
    select[data-field="status"] option[value="in_progress"] {
        color: #0d6efd;
    }
    select[data-field="status"] option[value="review"] {
        color: #ffc107;
    }
    select[data-field="status"] option[value="done"] {
        color: #198754;
    }

    /* Öncelik Renkleri */
    select[data-field="priority"] option[value="Düşük"] {
        color: #28a745;
    }
    select[data-field="priority"] option[value="Orta"] {
        color: #ffc107;
    }
    select[data-field="priority"] option[value="Yüksek"] {
        color: #dc3545;
    }

    .live-update {
        transition: background-color 0.3s ease;
    }

    .live-update:focus {
        background-color: #e7f1ff;
    }

    #update-status {
        font-size: 0.95rem;
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('.live-update').on('change input', function () {
            let field = $(this).data('field');
            let value = $(this).val();
            let id = $(this).data('id');

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
    });
</script>
@endsection
