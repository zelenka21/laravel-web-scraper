<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class PingController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        Redis::ping();
        return response('pong');
    }
}
