<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $credentials = request(['email','password']);
        if (!auth('api')->attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid login details',
                'status'=>false,
            ], 400);
        }
        $user = Customer::where('email', $request['email'])->firstOrFail();
        $token = JWTAuth::fromUser($user);;
        return response()->json([
            'token' => $token,
            'user'=>$user,
            'status'=>true,
        ],200);
    }
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'=>'required',
            'phone'=>'required|unique:customers',
            'email'=>'required|unique:customers',
            'password'=>'required|min:8',
        ]);

        if ($validation->fails()) {
            $errors = $validation->errors();
            return response()->json([
                'message' => $errors,
                'status'=>false,
            ], 400);
        }
        $input=$request->all();
        $input['password']= Hash::make($request->password);
        $user = Customer::Create($input);
        return response()->json([
            'message' => 'success',
            'status'=>false,
            'user'=>$user
        ],200);
    }

}
