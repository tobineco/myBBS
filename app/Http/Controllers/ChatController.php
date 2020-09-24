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
        
        return redirect('chat/index');
    }
    
    public function index(Request $request)
    {
        $cond_body = $request->cond_body;
        
        if ($cond_body != '') {
           // 検索されたら検索結果を取得する
           $posts = Chat::where('body', 'LIKE BINARY', "%{$cond_body}%")
                    ->orderBy("id", "desc")->Paginate(10);
        } else {
           // それ以外はすべての投稿を取得する
           // $posts = Chat::all()->sortByDesc('created_at');
           
           $posts = Chat::orderBy("id", "desc")->Paginate(10);
        }
        return view('chat.index', ['posts' => $posts, 'cond_body' => $cond_body]);
    }
    
    public function edit(Request $request)
    {
        // Chat Modelからデータを取得する
        $chat = Chat::find($request->id);
        
        // 認可
        $this->authorize('update', $chat);
        
        if (empty($chat)) {
          abort(404);  
        }
        return view('chat.edit', ['chat_form' => $chat]);
    }

    public function update(Request $request)
    {
        // Chat Modelからデータを取得する
        $chat = Chat::find($request->id);
        
        // 認可
        $this->authorize('update', $chat);
        
        // Validationをかける
        $this->validate($request, Chat::$rules);
        
        // 送信されてきたフォームデータを格納する
        $chat_form = $request->all();
        unset($chat_form['_token']);

        // 該当するデータを上書きして保存する
        $chat->fill($chat_form)->save();

        return redirect('chat/index');
    }      
    
    public function delete(Request $request)
    {
        // 該当するChat Modelを取得
        $chat = Chat::find($request->id);
        
        // 認可
        $this->authorize('delete', $chat);
        
        // 削除する
        $chat->delete();
        return redirect('chat/index');
    }
}