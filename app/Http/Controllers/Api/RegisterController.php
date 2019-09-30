<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $validator = $this->validateRequestForm($request);
        if($validator->fails()){
            return response()->post($validator->errors(),422,'验证数据失败');
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        event(new Registered($user));
        return response()->post($user);
    }

    /**
     * 验证表单
     * @param $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateRequestForm($request)
    {
        $validator = Validator::make($request->input(), [
            'name' => [
                'string',
                'max:10',
                'required'
            ],
            'email' => [
                'required',
                Rule::unique('users'),
            ],
            'password' => [
                'required',
            ]
        ]);
        return $validator;
    }
}
