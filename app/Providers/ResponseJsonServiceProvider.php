<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseJsonServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        // get返回
        Response::macro('get', function ($data = [], $code = 200, $msg = 'ok', $headers = []) {
            $result = [
                'code' => $code,
                'data' => $data,
                'msg' => $msg,
            ];
            return Response::json($result, 200, $headers);
        });

        // post返回
        Response::macro('post', function ($data = [], $code = 201, $msg = 'ok', $headers = []) {
            $result = [
                'code' => $code,
                'data' => $data,
                'msg' => $msg,
            ];
            return Response::json($result, 201, $headers);
        });

        // put返回
        Response::macro('put', function ($data = [], $code = 201, $msg = 'ok', $headers = []) {
            $result = [
                'code' => $code,
                'data' => $data,
                'msg' => $msg,
            ];
            return Response::json($result, 201, $headers);
        });

        // patch返回
        Response::macro('patch', function ($data = [], $code = 201, $msg = 'ok', $headers = []) {
            $result = [
                'code' => $code,
                'data' => $data,
                'msg' => $msg,
            ];
            return Response::json($result, 201, $headers);
        });

        // delete返回
        Response::macro('delete', function ($data = [], $code = 204, $msg = 'ok', $headers = []) {
            $result = [
                'code' => $code,
                'data' => $data,
                'msg' => $msg,
            ];
            return Response::json($result, 204, $headers);
        });
    }

}
