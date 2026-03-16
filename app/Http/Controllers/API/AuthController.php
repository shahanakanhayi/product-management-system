<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //to register staff
    public function register(Request $request)
{
    $staff = Staff::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)
    ]);

    $token = $staff->createToken('staff-token')->plainTextToken;

    return response()->json([
        'message' => 'Staff registered',
        'token' => $token
    ]);
}
 // to login staff
 public function login(Request $request)
{
    $staff = Staff::where('email',$request->email)->first();

    if(!$staff || !Hash::check($request->password,$staff->password)){
        return response()->json([
            'message' => 'Invalid credentials'
        ],401);
    }

    $token = $staff->createToken('staff-token')->plainTextToken;

    return response()->json([
        'message' => 'Login successful',
        'token' => $token
    ]);
}
}
