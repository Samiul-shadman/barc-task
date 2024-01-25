<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerificationMiddlware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        

        $token = $request->cookie('token');

        if($token != null){

            $decode = JWTToken::VerifyToken($token);

            if($decode == 'Unauthorized'){
                return response()->json([
                    'status' => 'unauthorized',
                    'message' => 'Log in Failed'
                ]);

            }
            else{
                $request->headers->set('email',$decode->userEmail);
                $request->headers->set('id',$decode->userId);
                return $next($request);
            }
        }
        else{
            return response()->json([
                        'status' => 'Failed'
                    ]);
        }
        
    }
}
