<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    protected $username = 'email';


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {

        $validate = Validator::make($request->all(), [
            $this->username => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validate->fails()) {
            //验证失败
            return response()->post($validate->errors(), 422, '验证表单数据失败');
        }


        $requestData = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        if (Auth::attempt($requestData)) {
            $user = Auth::user();
            $token = $user->createToken('Token Name')->accessToken;
            return response()->post($token);
        }
        return response()->post([], 400, '用户名或密码错误');
    }

    /**
     * 退出登录
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        if (Auth::guard('api')->check()) {
            Auth::guard('api')->user()->token()->delete();
        }
        return response()->json(['status' => 'success']);
    }
}
