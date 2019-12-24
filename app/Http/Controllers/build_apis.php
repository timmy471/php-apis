<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\user_apis;

use App\user;

use Illuminate\Support\Facades\Auth;

use Validator;

class build_apis extends Controller
{
    //get all field in the user_api table
   public function list(){
        return user_apis::all();
    }

    //be able to insert data
    public function insert(Request $request){
        $validator = validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);
        if($validator->fails()){
            return $validator->errors();
            // return response()->json("error" => "$validtor->errors");
        }
      $user = new user_apis;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $saved =  $user->save();
        if($saved){
            return $user;
        }else{
            return response()->json(errors());
        }
    }

    public function destroy(request $request){
        $user = user_apis::find($request->id);
        $delete = $user->delete();
        if($delete){
            return 'deleted';
        }else{
            return response();
        }
    }

    public function update(request $request){
        $user = user_apis::find($request->id);
        $user->name = $request->name;
        $save = $user->save();
        if($save){
            return $request->input();
        }else{
            return "bad";
        }
        
    }

    public $successStatus = 200;

    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    //authenticate users
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
$input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
return response()->json(['success'=>$success], $this-> successStatus); 
    }

    public function login(Request $request){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 

   
    }




