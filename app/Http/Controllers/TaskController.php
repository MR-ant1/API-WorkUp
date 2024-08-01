<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;

class TaskController extends Controller
{
    public function createTask(Request $request, $id)
    {
        try {
            $user = auth()->user();
            $project = Project::findOrFail($id);

            if ($user->role !== ('project manager')) {
                return response()->json([
                    'success' => false,
                    'message' => 'You cant crate a task'
                ], 403);
            }

            
            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Project not found'
                ], 404);
            }

            $task = new Task();
            $task->task_name = $request->input('task_name');
            $task->task_description = $request->input('task_description');
            $task->deadline_date = $request->input('deadline_date');
            $task->user_id = $request->input('user_id');
            $task->project_id = $project->id;
            $task->manager_id = $project->creator_id;

            $task->save();

            return response()->json([
                'success' => true,
                'message' => 'Task created successfully',
                'data' => $task
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Task cant be created',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function updateTask(Request $request, $id)
    {
        try {
            $task = Task::findOrFail($id);
            $user = auth()->user();

            if ($user->role !== 'project manager') {
                return response()->json([
                    'success' => false,
                    'message' => 'You do not have permission to edit a task'
                ], 403);
            };

            if ($user->id !== $task->manager_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'You do not have permission to edit this task'
                ], 403);
            };

            $task->task_name = $request->input('task_name', $task->task_name);
            $task->task_description = $request->input('task_description', $task->task_description);
            $task->deadline_date = $request->input('deadline_date', $task->deadline_date);

            $task->save();

            return response()->json([
                'success' => true,
                'message' => 'Task updated successfully',
                'data' => $task
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Could not update task',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function deleteTask($id)
    {
        try {
            $task = Task::findOrFail($id);
            $user = auth()->user();

            if ($user->role !== 'project manager') {
                return response()->json([
                    'success' => false,
                    'message' => 'You do not have permission to remove a task'
                ], 403);
            };

            if ($user->id !== $task->manager_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'You do not have permission to delete this task'
                ], 403);
            };

            $task->delete();

            return response()->json([
                'success' => true,
                'message' => 'Successfully deleted task'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Could not delete task',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function markTaskCompleted(Request $request, $id)
    {
        try {
            $task = Task::findOrFail($id);
            $user = auth()->user();

            if ($user->id !== $task->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not meant to complete this task'
                ], 403);
            };
            if ($task->is_completed === 0) {
                $task->is_completed = 1;
                $task->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Task marked'
                ], 200);
        } else {$task->is_completed = 0;
                $task->save();
            return response()->json([
                'success' => true,
                'message' => 'Task unmarked'
            ], 200);}
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Could not mark task',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
