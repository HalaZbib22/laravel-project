<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;

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
}
