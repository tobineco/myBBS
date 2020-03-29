<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    //
    public function add()
    {
        return view('chat.create');
    }
    
    public function create(Request $request)
    {
        return redirect('chat/create');
    }
}
