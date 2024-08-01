<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function createProject(Request $request)
    {
        try {
            $userRole = $request->user()->role;

            if (($userRole !== ('project manager')) && ($userRole !== 'admin')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $project = new Project();
            $project->project_title = $request->project_title;
            $project->project_description = $request->project_description;
            $project->creator_id = $request->user()->id;

            $project->save();

            return response()->json([
                'success' => true,
                'message' => 'Project created successfully',
                'data' => $project
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Project cant be created',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function updateProject( Request $request, $id)
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

    public function deleteProject($id)
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

    public function updateUserProjectPermissions($id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->role === 'admin') {
                return response()->json([
                    'success' => false,
                    'message' => 'You do not have permission to downgrade an admin'
                ], 403);
            };

            $user->role = 'project manager';

            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User permissions updated successfully',
                'data' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Could not update permissions',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
