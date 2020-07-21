<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Chat;  //Chatモデル

class ChatController extends Controller
{
    public function add()
    {
        return view('chat.create');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Chat::$rules);
        
        $chat = new Chat;
        $form = $request->all();
        
        unset($form['_token']);
        
        $chat->fill($form);
        $chat->save();
        
        return redirect('chat/create');
    }
    
    public function index(Request $request)
    {
        $cond_body = $request->cond_body;
        if ($cond_body != '') {
           // 検索されたら検索結果を取得する
           $posts = Chat::where('body', 'LIKE', "%{$cond_body}%")->get();
        } else {
           // それ以外はすべての投稿を取得する
           $posts = Chat::all();
        }
        
        return view('chat.index', ['posts' => $posts, 'cond_body' => $cond_body]);
    }
}
