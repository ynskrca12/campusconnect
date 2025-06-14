@extends('layouts.master') 

@section('content') 
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 bg-light p-3">
            <h5>Çalışma Alanım</h5>
            <ul class="nav flex-column nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="pill" href="#tasks">Görev Yönetimi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="pill" href="#calendar">Takvimim</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <div class="tab-content">
                <!-- Görev Yönetimi -->
                <div class="tab-pane fade show active" id="tasks">
                    <div class="row">
                        @php
                            $statuses = config('task_statuses');
                        @endphp

                        @foreach ($statuses as $statusKey => $statusData)
                            <div class="col-md-3">
                                <label class="form-label fs-6 fw-semibold ">
                                    <i class="bi {{ $statusData['icon'] }} text-{{ $statusData['color'] }} me-1"></i>
                                    {{ $statusData['label'] }}
                                </label>

                                <div class="task-column p-2 rounded" data-status="{{ $statusKey }}">
                                    
                                    <!-- Add Task Button -->
                                    <button class="btn btn-sm btn-outline-{{ $statusData['color'] }} w-100 mb-2 add-task-btn" data-status="{{ $statusKey }}">
                                        + Add Task
                                    </button>

                                    <!-- Add Task Form -->
                                    <div class="add-task-form d-none">
                                        <form class="task-create-form">
                                            @csrf
                                            <input type="hidden" name="status" value="{{ $statusKey }}">
                                            <div class="mb-1">
                                                <input type="text" name="title" class="form-control form-control-sm" placeholder="Görev başlığı..." required>
                                            </div>
                                            <div class="mb-1">
                                                <input type="date" name="due_date" class="form-control form-control-sm">
                                            </div>
                                            <div class="mb-2">
                                                <select name="priority" class="form-select form-select-sm">
                                                    <option value="low">Düşük</option>
                                                    <option value="medium" selected>Orta</option>
                                                    <option value="high">Yüksek</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-success btn-sm w-100">Kaydet</button>
                                        </form>
                                    </div>

                                    <!-- Tasks -->
                                    @foreach ($tasks->where('status', $statusKey) as $task)
                                        <div class="task-item card mb-2 p-2" data-id="{{ $task->id }}">
                                            <strong>{{ $task->title }}</strong>
                                            <div><small>Öncelik: {{ ucfirst($task->priority) }}</small></div>
                                            @if ($task->due_date)
                                                <div><small>Son Tarih: {{ $task->due_date }}</small></div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- Takvim -->
                <div class="tab-pane fade" id="calendar">
                    <p>Takvim alanı buraya gelecek...</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    
@endsection

@section('js')
    <!-- SortableJS -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<script>
    // Sürükle-bırak işlemi
    document.querySelectorAll('.task-column').forEach(column => {
        new Sortable(column, {
            group: 'tasks',
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

            fetch(`{{ route('workspace.task.store') }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: formData
            })
            .then(res => {
                if (res.ok) {
                    location.reload(); // Başarılıysa sayfayı yenile
                } else {
                    alert('Görev eklenirken bir hata oluştu.');
                }
            });
        });
    });
</script>
@endsection