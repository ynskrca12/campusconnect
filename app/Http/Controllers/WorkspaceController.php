<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class WorkspaceController extends Controller
{
    public function my_workspace()
    {
        $taskBoards = TaskBoard::where('user_id', auth()->id())->get();
        $selectedBoardId = request()->get('board_id', optional($taskBoards->first())->id);

        $tasks = Task::where('user_id', auth()->id())
                    ->where('task_board_id', $selectedBoardId)
                    ->get();

        return view('workspace.my_workspace', compact('taskBoards', 'tasks', 'selectedBoardId'));
    }//end

    public function storeTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:Düşük,Orta,Yüksek',
            'status' => 'required|in:to_do,in_progress,review,done',
            'task_board_id' => 'required|exists:task_boards,id',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
            'user_id' => auth()->id(),
            'task_board_id' => $request->task_board_id
        ]);

        return response()->json([
            'success' => true,
            'task' => [
                'id' => $task->id,
                'title' => $task->title,
                'priority' => ucfirst($task->priority),
                'due_date' => $task->due_date,
            ]
        ]);
    }//end

    public function updateTaskStatus(Request $request, Task $task)
    {
        if (auth()->id() !== $task->user_id) {
            return response()->json(['message' => 'Yetkiniz yok.'], 403);
        }

        $task->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    }//end

    public function renameTask(Request $request, Task $task)
    {
        $task->update(['title' => $request->title]);
        return response()->json(['success' => true]);
    }

    public function destroyTask(Task $task)
    {
        $task->delete();
        return response()->json(['success' => true]);
    }

    public function show(Task $task)
    {
        return view('workspace.task', compact('task'));
    }


    public function liveUpdate(Request $request)
    {
        

        $request->validate([
            'id' => 'required|integer|exists:tasks,id',
            'field' => 'required|string|in:status,priority,due_date,description,title',
            'value' => 'nullable|string|max:255',
        ]);



        $task = Task::findOrFail($request->id);
        $field = $request->field;
        $value = $request->value;

        // Enum validasyonu
        if ($field == 'status' && !in_array($value, ['to_do', 'in_progress', 'review', 'done'])) {
            return response()->json(['error' => 'Geçersiz durum'], 422);
        }

        if ($field == 'priority' && !in_array($value, ['Düşük', 'Orta', 'Yüksek'])) {
            return response()->json(['error' => 'Geçersiz öncelik'], 422);
        }

        $task->$field = $value;
        $task->save();

        return response()->json(['success' => true]);
    }

    public function createBoard(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:30',
            ], [
                'name.required' => 'Çalışma alanı adı zorunludur.',
                'name.max' => 'Çalışma alanı adı 30 karakterden fazla olamaz.',
            ]);

            $taskBoard = TaskBoard::create([
                'name' => $validated['name'],
                'user_id' => auth()->id(),
            ]);

            return response()->json([
                'success' => true,
                'board_id' => $taskBoard->id,
                'message' => 'Çalışma alanı başarıyla oluşturuldu.'
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Tahta oluşturulurken hata oluştu: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu. Lütfen tekrar deneyin.'
            ], 500);
        }
    }//end



}
