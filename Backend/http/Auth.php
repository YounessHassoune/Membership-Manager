<?php


namespace App\http;

use App\http\Request;
use Firebase\JWT\JWT;

class Auth
{
    public static function authorization($user)
    {
        $iat = time();
        $exp = $iat + 60 * 60;
        $payload = array(
            "iss" => "localhost",
            "aud" => "localhost",
            "iat" => $iat,
            'exp' => $exp,
            'id' => $user
        );
        $jwt = JWT::encode($payload, $_ENV["KEY"], 'HS512');
        return $jwt;
    }
    public static function gettoken()
    {
        $token = Request::RequestInfo()->authorization;
        if ($token) {
            return str_replace('Bearer ', '', $token);
        } else {
            return false;
        }
    }
    public static function verification($token)
    {
        return JWT::decode($token, $_ENV["KEY"], array('HS512'));
    }
}
