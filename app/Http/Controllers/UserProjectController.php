<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\userProject;

class UserProjectController extends Controller
{
   
    public function addUserToProject( Request $request, $id)
    {
        try {
            $project = Project::findOrFail($id);
            $userId = $request->input('user_id');
            $user = User::findOrFail($userId);

            if ($user->role === 'admin') {
                return response()->json([
                    'success' => false,
                    'message' => 'You do not have permission to add an admin'
                ], 403);
            };

            if(auth()->user()->role === 'user') {
                return response()->json([
                    'success' => false,
                    'message' => 'You do not have permission to add users'
                ], 403);
            }

            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Couldnt add User'
                ], 404);
            };

            $userProject = new userProject();
            $userProject->user_id = $user->id;
            $userProject->project_id = $project->id;

            $userProject->save();

            return response()->json([
                'success' => true,
                'message' => 'User added successfully',
                'data' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Could not add user',
                'error' => $th->getMessage()
            ], 500);
        }
    }


}