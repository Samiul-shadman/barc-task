<?php

namespace App\Helper;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken{

    public static function CreateToken($userEmail){

        $key = env('JWT_KEY');

        $payload = [
            'iss' => 'barc',
            'iat' => time(),
            'exp' => time()+60*60,
            'userEmail' => $userEmail,
        ];

        return JWT::encode($payload, $key, 'HS256');
    }


    public static function VerifyToken($token){
        $key = env('JWT_KEY');

        try{
            $decode = JWT::decode($token, new Key($key, 'HS256'));
            return $decode->userEmail;
        }

        catch(Exception $e){
            return 'Unauthorized';
        }
    }
}

