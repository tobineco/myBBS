<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;  //Userモデル

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $cond_name = $request->cond_name;
        
        if ($cond_name != '') {
           // 検索されたら検索結果を取得する
           $chat_users = User::where('name', 'LIKE BINARY', "%{$cond_name}%")
                         ->orwhere('email', 'LIKE BINARY', "%{$cond_name}%")->get();
        } else {
           // それ以外はすべての投稿を取得する
           $chat_users = User::all();
        }
        return view('admin.index', ['chat_users' => $chat_users, 'cond_name' => $cond_name]);
    }

    public function edit(Request $request)
    {
        // User Modelからデータを取得する
        $chat_user = User::find($request->id);
        
        if (empty($chat_user)) {
          abort(404);  
        }
        return view('admin.edit', ['chat_form' => $chat_user]);
    }

    public function update(Request $request)
    {
        // User Modelからデータを取得する
        $chat_user = User::find($request->id);
        
        // 送信されてきたフォームデータを格納する
        $chat_form = $request->all();
        unset($chat_form['_token']);

        // 該当するデータを上書きして保存する
        $chat_user->fill($chat_form)->save();

        return redirect('admin/index');
    }      
    
    public function delete(Request $request)
    {
        // 該当するUser Modelを取得
        $chat_user = User::find($request->id);
        
        // 削除する
        $chat_user->delete();
        return redirect('admin/index');
    }
}
