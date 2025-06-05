@extends('layouts.master') 

@section('content') 
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 p-0">
            <div class="p-4 border-bottom">
                <h5 class="mb-0 fw-semibold">Çalışma Alanım</h5>
            </div>

            <ul class="nav flex-column nav-pills px-3 py-3 gap-2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active d-flex align-items-center gap-2 py-2 px-3 rounded-pill text-start" data-bs-toggle="pill" href="#tasks">
                        <i class="bi bi-list-task"></i>
                        <span>Görev Yönetimi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 py-2 px-3 rounded-pill text-start" data-bs-toggle="pill" href="#calendar">
                        <i class="bi bi-calendar-event"></i>
                        <span>Takvimim</span>
                    </a>
                </li>
            </ul>
        </div>


        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <div class="tab-content">
                <!-- Görev Yönetimi -->
                <div class="tab-pane fade show active" id="tasks">
                    <!-- TaskBoard Seçimi -->
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2 pe-md-5 me-3">
                        <div class="d-flex align-items-center gap-2 select-board-container">
                            <label for="boardSelect" class="fw-semibold mb-0 label-form-select">Çalışma Alanı:</label>
                            <form id="board-select-form" method="GET">
                                <select id="boardSelect" name="board_id" class="form-select form-select-sm px-5 text-muted" style="border: 1px solid #001b48;font-size: 14px;" onchange="this.form.submit()">
                                    <option value="" disabled class="text-muted">Çalışma Alanı Seçin</option>
                                    @foreach ($taskBoards as $board)
                                        <option value="{{ $board->id }}" {{ $selectedBoardId == $board->id ? 'selected' : '' }}>
                                            {{ $board->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>

                        <button class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1 rounded-3 px-4" id="create-board-btn">
                            <i class="fa fa-plus me-1"></i>
                            <span>Çalışma Alanı Ekle</span>
                        </button>
                    </div>



                    <div class="row">
                        @php
                            $statuses = config('task_statuses');
                        @endphp
                        <div class="row row-cols-1 row-cols-md-auto flex-md-nowrap overflow-auto gap-3 px-1 scroll-draggable">
                            @if(!empty($statuses) && is_iterable($statuses))
                                @foreach ($statuses as $statusKey => $statusData)
                                    <div class="task-board-column" style="min-width: 360px;">
                                        <div class="p-2 rounded-4" style="background-color: {{ $statusData['bg-color'] }};" data-status="{{ $statusKey }}"
                                        data-board="{{ $selectedBoardId }}">

                                            <label class="form-label fs-14 fw-semibold border-2 rounded px-3 py-1 mt-2" style="color: #000000" >
                                                <i class="bi {{ $statusData['icon'] }} text-{{ $statusData['color'] }} me-1"></i>
                                                {{ $statusData['label'] }}
                                            </label>

                                            <div class="task-column p-2 rounded" data-status="{{ $statusKey }}">
                                                
                                                <!-- Add Task Button -->
                                                <button class="btn btn-sm btn-outline-{{ $statusData['color'] }} mb-2 add-task-btn text-muted" data-status="{{ $statusKey }}">
                                                    <i class="fa-solid fa-plus me-1 icon-xs"></i> Görev Ekle
                                                </button>

                                                <!-- Add Task Form -->
                                                <div class="add-task-form mb-2 d-none">
                                                    <form class="task-create-form">
                                                        @csrf
                                                        <input type="hidden" name="status" value="{{ $statusKey }}">
                                                        <input type="hidden" name="task_board_id" value="{{ $selectedBoardId }}">

                                                        <div class="mb-2">
                                                            <input type="text" name="title" class="form-control form-control-sm border-0" placeholder="Görev başlığı..." required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <input type="date" name="due_date" class="form-control form-control-sm border-0 text-muted" placeholder="Son Tarih">
                                                        </div>
                                                        <div class="mb-2">
                                                            <select name="priority" class="form-select form-select-sm border-0">
                                                                <option value="">Öncelik Seçin</option>
                                                                <option value="Düşük">Düşük</option>
                                                                <option value="Orta">Orta</option>
                                                                <option value="Yüksek">Yüksek</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-outline-primary btn-sm w-100">Kaydet</button>
                                                    </form>
                                                </div>

                                                @foreach ($tasks->where('status', $statusKey) as $task)
                                                    <div class="task-item card mb-2 px-3 py-2 rounded-4" data-id="{{ $task->id }}">
                                                        <div class="d-flex justify-content-between mt-1 align-items-start">
                                                            <span class="fw-semibold fs-14 mb-1 task-title" data-id="{{ $task->id }}">{{ $task->title }}</span>

                                                            <div class="dropdown">
                                                                <i class="fa-solid fa-ellipsis cursor-pointer text-muted" role="button" id="dropdownMenu{{ $task->id }}" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $task->id }}">
                                                                    <li><a class="dropdown-item rename-task text-dark" href="#" data-id="{{ $task->id }}">Yeniden Adlandır</a></li>
                                                                    <li><a class="dropdown-item delete-task text-dark" href="#" data-id="{{ $task->id }}">Sil</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <span class="text-muted fs-14 mb-1">Öncelik: {{ ucfirst($task->priority) }}</span>
                                                        @if ($task->due_date)
                                                            <span class="text-muted fs-14 mb-1">Son Tarih: {{ $task->due_date }}</span>
                                                        @endif
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Takvim -->
                <div class="tab-pane fade" id="calendar">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center py-5" style="min-height: 400px;border-radius: 1rem;">
                        <i class="bi bi-calendar-check display-3 text-primary mb-3"></i>
                        <h3 class="fw-bold text-dark mb-2">Takvim Modülü Çok Yakında Sizinle!</h3>
                        <p class="text-muted mb-3 px-4" style="max-width: 600px;">
                            Tüm görevlerinizi, toplantılarınızı ve randevularınızı tek bir yerden kolayca planlayabileceğiniz <strong>akıllı takvim</strong> sistemi üzerinde çalışıyoruz. 
                            Zaman yönetimini daha verimli hale getirecek gelişmiş özellikler sizi bekliyor.
                        </p>
                        <ul class="text-muted small mb-4" style="max-width: 700px;">
                            <li>🗓️ Görevleri tarih bazlı görüntüleme</li>
                            <li>🔔 Hatırlatıcılar ve bildirim entegrasyonu</li>
                            <li>👥 Takım bazlı planlama desteği</li>
                            <li>📅 Haftalık / Aylık görünüm seçenekleri</li>
                        </ul>
                        <div class="d-inline-flex align-items-center gap-2">
                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                                Geliştirme Aşamasında
                            </span>
                            <small class="text-muted fst-italic">Planlanan yayın tarihi: 2025 Yazı</small>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <style>
        #boardSelect {
            border: none !important;
            border-bottom: 1px solid #001b48 !important;
            border-radius: 0 !important;
        }
        .swal-input-custom {
            width: 90% !important;
            margin: 0 auto;
        }
        .scroll-draggable.active {
            cursor: grabbing;
            user-select: none;
        }
        .scroll-draggable {
            cursor: grab;
        }
        .row {
        scroll-behavior: smooth;
        }

        .content-wrapper {
            padding: 5px;
        }
        .icon-xs {
            font-size: 12px !important;
        }
        .fs-14 {
            font-size: 14px !important;
        }
        .add-task-form {
            border: 1px solid lightgray;
            border-radius: 12px;
            padding: 10px;
            background: #fff;
        }
        .btn-primary{
            color: #fff !important;
            border-color: #001b48 !important;
            background: #001b48 !important;
        }
        .btn-primary:hover{
            color: #001b48 !important;
            background: #fff !important;
            border-color: #001b48 !important;
        }
        .btn-outline-primary{
            color: #001b48 !important;
            border-color: #001b48 !important;
            background: #fff !important;
        }
        .btn-outline-primary:hover{
            color: #fff !important;
            background: #001b48 !important;
            border-color: #001b48 !important;
        }
        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            color: #fff !important;
            background-color: #001b48 !important;
        }
        .nav-pills .nav-link {
            color: #001b48 !important;
        }
        @media (max-width: 768px) {
        .task-board-column {
            min-width: 100% !important;
        }
        .label-form-select {
            display: none; 
        }
        #create-board-btn {
            width: 100% !important;
            display: flex !important;
            justify-content: center;
        }
        .select-board-container {
            width: 100% !important;
            display: flex !important;
            justify-content: center;
            margin-bottom: 10px;
        }
    }
    </style>
@endsection

@section('js')
    <!-- SortableJS -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- rename and delete function --}}
<script>
    $(document).ready(function () {        
        $('.rename-task').on('click', function (e) {
            e.preventDefault();
            const taskId = $(this).data('id');
            const $titleSpan = $(`.task-title[data-id="${taskId}"]`);
            const currentTitle = $titleSpan.text().trim();

            const $input = $(`<input type="text" class="form-control form-control-sm" value="${currentTitle}" />`);
            $titleSpan.replaceWith($input);
            $input.focus();

            $input.on('blur keydown', function (e) {
                if (e.type === 'blur' || e.key === 'Enter') {
                    const newTitle = $input.val().trim();
                    if (newTitle && newTitle !== currentTitle) {
                        $.ajax({
                            url: `/workspace/task/${taskId}/rename`,
                            method: 'PATCH',
                            data: { title: newTitle, _token: '{{ csrf_token() }}' },
                            success: function () {
                                $input.replaceWith(`<span class="fw-semibold fs-14 mb-1 task-title" data-id="${taskId}">${newTitle}</span>`);
                            }
                        });
                    } else {
                        $input.replaceWith(`<span class="fw-semibold fs-14 mb-1 task-title" data-id="${taskId}">${currentTitle}</span>`);
                    }
                }
            });
        });

        $('.delete-task').on('click', function (e) {
            e.preventDefault();
            const taskId = $(this).data('id');

            if (confirm("Bu görevi silmek istediğinize emin misiniz?")) {
                $.ajax({
                    url: `/workspace/task/${taskId}`,
                    method: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function () {
                        $(`.task-item[data-id="${taskId}"]`).fadeOut(300, function () { $(this).remove(); });
                    }
                });
            }
        });
    });
</script>

{{-- draggable function and show add new task --}}
<script>
    document.querySelectorAll('.task-column').forEach(column => {
        new Sortable(column, {
            group: 'tasks',
            ghostClass: 'sortable-ghost',
            animation: 150,
            onEnd: function (evt) {
                const taskId = evt.item.dataset.id;
                const newStatus = evt.to.dataset.status;

                fetch(`/workspace/task/${taskId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ status: newStatus })
                });
            }
        });
    });

    // Görev ekleme formunu göster
    document.querySelectorAll('.add-task-btn').forEach(button => {
        button.addEventListener('click', function () {
            const parent = this.closest('.task-column');
            parent.querySelector('.add-task-form').classList.toggle('d-none');
        });
    });

    // Yeni görev kaydet
    document.querySelectorAll('.task-create-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const status = formData.get('status');
            const taskBoardId = formData.get('task_board_id');

             // Eğer task_board_id yoksa uyarı ver
            if (!taskBoardId || taskBoardId === 'null') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Çalışma Alanı Yok',
                    text: 'Lütfen önce bir çalışma alanı oluşturun veya seçin.',
                    confirmButtonText: 'Tamam',
                });
                return;
            }

            fetch(`{{ route('workspace.task.store') }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success && data.task) {
                    // Yeni görev HTML'ini oluştur
                    const taskHtml = `
                        <div class="task-item card mb-2 px-3 py-2 rounded-3" data-id="${data.task.id}">
                            <div class="d-flex justify-content-between mt-1 align-items-start">
                                <span class="fw-semibold fs-14 mb-1 task-title" data-id="${data.task.id}">${data.task.title}</span>

                                <div class="dropdown">
                                    <i class="fa-solid fa-ellipsis cursor-pointer text-muted" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item rename-task text-dark" href="#" data-id="${data.task.id}">Yeniden Adlandır</a></li>
                                        <li><a class="dropdown-item delete-task text-dark" href="#" data-id="${data.task.id}">Sil</a></li>
                                    </ul>
                                </div>
                            </div>
                            <span class="text-muted fs-14 mb-1">Öncelik: ${data.task.priority ?? 'Yok'}</span>
                            ${data.task.due_date ? `<span class="text-muted fs-14 mb-1">Son Tarih: ${data.task.due_date}</span>` : ''}
                        </div>
                    `;

                    // İlgili sütunu bul ve görevi ekle
                    const targetColumn = document.querySelector(`.task-column[data-status="${status}"]`);
                    targetColumn.insertAdjacentHTML('beforeend', taskHtml);

                    // Formu temizle ve kapat
                    form.reset();
                    form.closest('.add-task-form').classList.add('d-none');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata',
                        text: 'Görev eklenirken bir sorun oluştu.',
                        confirmButtonText: 'Tamam',
                    });
                }
            })
            .catch(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Sunucu Hatası',
                    text: 'Sunucuyla iletişim kurulurken bir hata oluştu.',
                    confirmButtonText: 'Tamam',
                });
            });
        });
    });


</script>

{{-- change task board --}}
<script>
    $(document).on('click', '.task-item', function(e) {
        if ($(e.target).closest('.dropdown').length) return;

        let taskId = $(this).data('id');
        window.location.href = `/tasks/${taskId}`;
    });
</script>

{{-- create task board --}}
<script>

    document.getElementById('create-board-btn').addEventListener('click', function () {
        Swal.fire({
            title: 'Yeni Çalışma Alanı Oluştur',
            input: 'text',
            inputLabel: 'Lütfen çalışma alanı adını girin',
            inputPlaceholder: 'Örn: Haftalık Plan',
            confirmButtonText: 'Oluştur',
            cancelButtonText: 'İptal',
            showCancelButton: true,
            reverseButtons: true,
            inputAttributes: {
                name: 'name',
                maxlength: 50,
                autocapitalize: 'off',
                autocorrect: 'off'
            },
            background: '#f4f6f9',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            icon: 'info',
            customClass: {
                popup: 'rounded-4 shadow-lg',
                title: 'fw-bold fs-5',
                input: 'form-control swal-input-custom mt-3',
                confirmButton: 'btn btn-primary px-5 py-1',
                cancelButton: 'btn btn-outline-secondary px-5 py-1'
            },
            preConfirm: (boardName) => {
                if (!boardName.trim()) {
                    Swal.showValidationMessage('Çalışma Alanı adı boş olamaz!');
                }
                return boardName;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const boardName = result.value;
                fetch(`{{ route('workspace.createBoard') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name: boardName })
                })
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Başarılı!',
                            text: `"${boardName}" adlı çalışma alanı başarıyla oluşturuldu.`,
                            timer: 5000,
                            showConfirmButton: true
                        }).then(() => {
                            window.location.href = `{{ route('my_workspace') }}?board_id=${data.board_id}`;
                        });
                    }else if (data.errors) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata!',
                            text: data.errors.name[0] || 'Çalışma alanı oluşturulurken bir sorun oluştu.'
                        });
                        
                    } 
                    
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata!',
                            text: 'Çalısma alanı oluşturulurken bir sorun oluştu.'
                        });
                    }
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Bağlantı Hatası',
                        text: 'Sunucuya ulaşılamadı. Lütfen tekrar deneyin.'
                    });
                });
            }
        });
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.querySelector('.scroll-draggable');
        let isDown = false;
        let startX;
        let scrollLeft;

        container.addEventListener('mousedown', (e) => {
            isDown = true;
            container.classList.add('active');
            startX = e.pageX - container.offsetLeft;
            scrollLeft = container.scrollLeft;
        });

        container.addEventListener('mouseleave', () => {
            isDown = false;
            container.classList.remove('active');
        });

        container.addEventListener('mouseup', () => {
            isDown = false;
            container.classList.remove('active');
        });

        container.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - container.offsetLeft;
            const walk = (x - startX) * 1.5; // hız
            container.scrollLeft = scrollLeft - walk;
        });
    });
</script>

@endsection