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
            $task->user_id = $user->id;
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
            $project = Project::findOrFail($id);
            $user = auth()->user();

            if ($user->role !== 'project manager') {
                return response()->json([
                    'success' => false,
                    'message' => 'You do not have permission to edit a project'
                ], 403);
            };

            $project->project_title = $request->input('projectTitle', $project->projectTitle);
            $project->project_description = $request->input('projectDescription', $project->projectDescription);

            $project->save();

            return response()->json([
                'success' => true,
                'message' => 'Project updated successfully',
                'data' => $project
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Could not update project',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function deleteTask($id)
    {
        try {
            $project = Project::findOrFail($id);
            $user = auth()->user();

            if ($user->role !== 'project manager') {
                return response()->json([
                    'success' => false,
                    'message' => 'You do not have permission to remove a project'
                ], 403);
            };
            $project->delete();

            return response()->json([
                'success' => true,
                'message' => 'Successfully deleted project'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Could not delete project',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
