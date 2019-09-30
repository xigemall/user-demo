<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {

        $message = [
            'name'=>'用户名',
            'email'=>'邮箱',
            'password'=>'密码',
        ];
        $request->validate([
            'name' => [
                'string',
                'max:10',
                'required'
            ],
            'email' => [
                'required',
                Rule::unique('users'),
            ],
            'password'=>[
                'required',
            ]
        ],[],$message);

        $user = User::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password')),
        ]);
        event(new Registered($user));
        return response()->json($user);
    }
}
