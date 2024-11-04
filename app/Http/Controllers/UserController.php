<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Helper\JWTToken;
use Illuminate\Http\Request;

class UserController extends Controller
{
    

    // User Registration 
    public function userRegister(Request $request){
        try{
            $userEmail = $request->input('email');
            $firstName = $request->input('first_name');
            $lastName  = $request->input('last_name');
            $mobile    = $request->input('mobile');
            $password  = $request->input('password');

            User::create([
                'first_name'  => $firstName,
                'last_name'   => $lastName,
                'email'       => $userEmail,
                'mobile'      => $mobile,
                'password'    => $password
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => 'You have been registered successfully'
           ], 201);
        }
        catch(Exception $e){
            return response()->json([
                'status'  => 'fail',
                'message' => 'User registration fail'
            ]);
        }
    }

    // User Login
    public function userLogin(Request $request){
        try{
            $userEmail = $request->input('email');
            $password  = $request->input('password');

            $user = User::where('email', '=', $userEmail)->where('password', '=', $password)->first();


            if($user !== null){
                $token = JWTToken::createToken($user->email, $user->id, $user->user_type);

                return response()->json([
                    'status'    => 'success',
                    'message'   => 'You are logged in now',
                    'type'  => $user->user_type,
                    'token' => $token
                ], 200)->cookie('token',$token,60*24*30);

            }

        }
        catch(Exception $e){
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Request fail to login',
                'error-message' => $e->getMessage(),
            ], 401);
        }
    }

    // Sending OTP code to email
    public function OTPSending(Request $request){
        try{
            $email = $request->input('email');
            $otp   = rand(000000, 999999);

            $user = User::where('email', '=', $email)->count();

            if($user == 1){
                // Send OTP code to email
                //Mail::to($email)->send(new OTPEmail($otp));

                // Update OTP code into database
                User::where('email', '=', $email)->update(['otp' => $otp]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'OTP has been sent successfully',
                    'otp' => $otp
                ], 200);
            }else{
                return response()->json([
                    'status'    => 'fail',
                    'message'   => 'Unauthorized user'
                ]);
            }
        }
        catch(Exception $e){
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Unauthorized user'
            ], 401);
        }
    }


    // OTP code verifying
    public function OTPVerifying(Request $request){
        try{
            $email = $request->input('email');
            $otp   = $request->input('otp');

            $user = User::where('email', '=', $email)->where('otp', '=', $otp)->count();

            if($user == 1){
                // Update OTP code into database
                User::where('email', '=', $email)->update(['otp' => '1']);

                // Create token
                $token = JWTToken::createTokenForPassword($email);

                return response()->json([
                    'status'    => 'success',
                    'message'   => 'OTP code has been verified successfully',
                    'token'     => $token
                ], 200)->cookie('token', $token, 60*24*30);

            }else{
                return response()->json([
                    'status'    => 'fail',
                    'message'   => 'Unauthorized user'
                ]);
            }
        }
        catch(Exception $e){
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Request fail to verify OTP code'
            ], 401);
        }
    }

    // Reset Password
    public function resetPassword(Request $request){
        try{
            $userEmail = $request->header('email');
            $password  = $request->input('password');

            User::where('email', '=', $userEmail)->update(['password' => $password]);

            return response()->json([
                'status'    => 'success',
                'message'   => 'Password has been updated successfully'
            ], 200);

        }
        catch(Exception $e){
            return response()->json([
                'status'    => 'success',
                'message'   => 'Request fail to update password'
            ], 401);
        }
    }


     // User info show
     public function userInfoAction(Request $request){ 
        try{
            $email = $request->header('email');

            $info = User::where('email', '=', $email)->first();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Request successfull',
                'info'      => $info
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Request fail'
            ], 401);
        }
    }


     // User info update
     public function userInfoUpdate(Request $request){
        try{
            $userEmail = $request->header('email');
            $firstName = $request->input('first_name');
            $lasstName = $request->input('last_name');
            $mobile    = $request->input('mobile');
            $password  = $request->input('password');

            User::where('email', '=', $userEmail)->update([
                'first_name'    => $firstName,
                'last_name'     => $lasstName,
                'mobile'        => $mobile,
                'password'      => $password
            ]);

            return response()->json([
                'status'    => 'success',
                'message'   => 'User info has been updated successfully'
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'statusn'   => 'fail',
                'message'   => 'Request fail to update user info',
                'error'     => $e->getMessage()
            ], 401);
        }
    }


    public function getAllUsers(Request $request){
        try{
            $users = User::all();

            return response()->json([
                'success'   => 'success',
                'users'     => $users
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'success'   => 'fail',
                'message'   => 'Request fail'
            ], 401);
        }
    }


    public function userDelete(Request $request){
        
           try{
            $userId = $request->id;

            User::where('id', '=', $userId)->delete();

            return response()->json([
                'status'    => 'success',
                'message'      => 'The user has been deleted siccessfully'
            ], 200);


           }
           catch(Exception $e){
            return response()->json([
                'status'    => 'fail',
                'mes'      => 'Request fai'
            ], 401);
           }
        
        
    }


    public function userLogout(Request $request){
        return redirect('/userLogin')->cookie('token', '', -1);
    }











}
