<?php

namespace app\http\middleware;

use Firebase\JWT\JWT;

class Check
{
    public function handle($request, \Closure $next)
    {
        $key = 'abcd1234';
        JWT::decode($_GET['jwt_token'],$key,array('HS256'));

        return $next($request);
    }
}
