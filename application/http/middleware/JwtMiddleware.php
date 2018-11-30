<?php

namespace app\http\middleware;

use \Firebase\JWT\JWT;

class JwtMiddleware
{
    public function handle($request, \Closure $next)
    {
        // 从协议头取出令牌
        $jwt = $request->header('Authorization');
//        echo $jwt;
        try
        {
            $key = 'abcd1234';
            // 解析 token
            $jwt = JWT::decode($jwt, $key,array('HS256'));
            // 把解析出来的数据保存到 Request 对象中的 jwt 属性上，将来在控制器中就可能 $req->jwt 这样来获取了
            $request->jwt = $jwt;
            // 继续执行下一个中间件
            return $next($request);
        }
        catch(\Exception $e)
        {
            // 返回错误信息
            return response($e->getMessage(),401);
        }
    }
}
