<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    public function my_workspace() {
        $tasks = Task::where('user_id', auth()->id())->get();

        return view('workspace.my_workspace', compact('tasks'));
    }//end

    public function storeTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:to_do,in_progress,review,done'
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    public function updateTaskStatus(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    }
}
