<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken {

    public static function createToken($userEmail, $userId, $userType){
        $key = env('JWT_KEY');

         //$key = config('jwt.key');

        // Log::info('JWT Key Type:', ['type' => gettype($key)]);

        $payload = [
            'iss' => 'rupshop',
            'iat' => time(),
            'exp' => time()+60*60,
            'userEmail' => $userEmail,
            'userId' => $userId,
            'userType'  => $userType
        ];

        return JWT::encode($payload, $key, 'HS256');

    }


    public static function createTokenForPassword($userEmail){
         $key = env('JWT_KEY');
        //$key = config('jwt.key');


        $payload = [
            'iss' => 'rupshop',
            'iat' => time(),
            'exp' => time()+60*10,
            'userEmail' => $userEmail,
            'userId' => '0',
            'userType' => ''
        ];

        return JWT::encode($payload, $key, 'HS256');

    }




    public static function verifyToken($token){
        
        try{
            if($token == null){
                return 'unauthorized';
            }else{
                $key = env('JWT_KEY');

                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                
                return $decoded;
            }
        }
        catch(Exception $e){
            return 'unauthorized';
        }

    }

}