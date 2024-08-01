<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
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
                    'message' => 'Couldn post comment'
                ], 404);
            }

            $comment = new Comment();
            $comment->comment = $request->comment;
            $comment->user_id = $user->id;
            $comment->task_id = $task->id;

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
