<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Validator;

class MainController extends Controller
{
    function Messaged(Request $request){
        // METHOD 1
        // $data = $request->all();
        // $msg = new Message;
        // $msg->email = $data["email"];
        // $msg->subject = $data["subject"];
        // $msg->message = $data["message"];
        // $msg->save();
        // return response()->json(["status" => true]);
        //  END METHOD 1

        // METHOD 2
        $validator = Validator::make($request->all(), [
                'email' =>  'required|string|email|max:100',
                'subject' => 'required|string|min:2|max:45',
                'message' => 'required|string|min:2|between:2,100',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            } else {
                $status = Message::create($validator->validated());
                return response()->json([
                    'status' => 'Message Sent Successfully'],201);
            }
            //  END METHOD 2
        }
}
