<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User; 
use Auth; 
use Validator;
use Lcobucci\JWT\Parser;

class UserController extends Controller
{
    public $successStatus = 200;
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $token =  $user->createToken('Nowadays')->accessToken; 

            return response()->json(['code' =>$this->successStatus, 'message' => 'Login Successfully', 'id'=>$user->id,'token'=>$token], 200);

        }else{  
            return response()->json(['code' => 401 ,'message' => 'Username or Password is invalid']); 
        } 
    }
    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email|unique:users', 
            'password' => 'required|min:6|confirmed', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('Nowadays')->accessToken; 
        $success['name'] =  $user->name;

        return response()->json(['code' => $this->successStatus, 'message' => 'Successfully registered the user']); 
    }
    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

    public function show()
    {
        $user = Auth::user(); 
        return response()->json($user); 
    }

    public function logout(Request $request) {
        $value = $request->token;
        if ($value) {
    
            $id = (new Parser())->parse($value)->getHeader('jti');
            \DB::table('oauth_access_tokens')->where('id', '=', $id)->update(['revoked' => 1]);
            // $this->guard()->logout();
        }
        Auth::logout();
        return response()->json(['code' => 200, 'message' => 'You are successfully logged out'], 200);
    }
}
