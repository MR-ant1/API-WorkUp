<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;



class UserController extends Controller
{
   
    public function updateUserRole( Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->role = $request->input('role', $user->role);

            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'data' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Could not update user',
                'error' => $th->getMessage()
            ], 500);
        }
    }


}
