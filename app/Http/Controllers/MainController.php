<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Update;

class MainController extends Controller
{
    function Updated(Request $request){
        $data = $request->all();

        $update = new Update;
        $update->subject = $data["subject"];
        $update->job = $data["job"];
        $clown->save();

        return response()->json(["success" => true]);
    }
}
