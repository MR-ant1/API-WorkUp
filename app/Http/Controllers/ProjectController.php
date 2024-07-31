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
}
