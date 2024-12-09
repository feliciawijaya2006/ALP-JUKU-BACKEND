<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
            'status' => true,
            'message' => 'Users retrieved successfully',
            'data' => $users
        ], 200);
    }

    public function show($userID)
    {
        $users = User::findOrFail($userID);
        return response()->json([
            'status' => true,
            'message' => 'User found successfully',
            'data' => $users
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'role' => 'nullable|string',
            'phone' => 'nullable|string|max:15',
            'image' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $users = User::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'data' => $users
        ], 201);
    }

    public function update(Request $request, $userID)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userID,
            'password' => 'nullable|string|min:8',
            'role' => 'nullable|string',
            'phone' => 'nullable|string|max:15',
            'image' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $users = User::findOrFail($userID);
        $users->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'User updated successfully',
            'data' => $users
        ], 200);
    }

    public function destroy($userID)
    {
        $users = User::findOrFail($userID);
        $users->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully'
        ], 204);
    }
}
