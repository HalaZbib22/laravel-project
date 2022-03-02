<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Validator;

class MainController extends Controller
{
    function Messaged(Request $request){
        $data = $request->all();

        $msg = new Message;
        $msg->email = $data["email"];
        $msg->subject = $data["subject"];
        $msg->message = $data["message"];
        $msg->save();

        return response()->json(["success" => true]);
    }

    public function updateProfile( Request $request ){
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users,id'.$request->user()->id,
            ]);
            if($validator->fails()){
                $error = $validator->errors()->all()[0];
                return response()->json(['status'=>'false','message'=>$error,'data'=>[]],422);
            }else{
                $user = User::find($request->user()->id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->update();
                return response()->json(['status'=>'true','message'=>"Profile Update!",'data'=>$user]);
            }
        }catch(\Exception $e){
            return response()->json(['status'=>'false','message'=>$e->getMessage(),'data'=>[]],500);
        }
    }
}
