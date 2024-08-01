<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use App\Models\userProject;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function createComment(Request $request, $id)
    {
        try {
            $user = auth()->user();
            $task = Task::findOrFail($id);

            if (!$task) {
                return response()->json([
                    'success' => false,
                    'message' => 'Couldnt create comment'
                ], 404);
            }

            $comment = new Comment();
            $comment->comment = $request->comment;
            $comment->user_id = $user->id;
            $comment->task_id = $task->id;

            if ($task->manager_id !== $user->id) {
                $userProject = userProject::where('project_id', $task->project_id)->where('user_id', $user->id)->first();
                if (!$userProject) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Couldnt create comment'
                    ], 403);
                    }
                    $userTask = Task::findOrFail($id)->where('user_id', $user->id)->first();
                    if (!$userTask) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Couldnt create comment'
                        ], 403);
                        }             
                }
                $comment->save();

            return response()->json([
                'success' => true,
                'message' => 'Comment send successfully',
                'data' => $comment
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'comment cant be created',
                'error' => $th->getMessage()
            ], 500);
        }
    }

}
