@extends('layouts.adminlayout')

@section('title', 'ユーザー一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>ユーザー一覧</h2>
        </div>
        
        <div class="row-space">
        </div>
        
        <div class="row">
            <div class="col-md-2">
                <a href="{{ route('register') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            
            <div class="col-md-4">
            </div>
            
            <div class="col-md-6">
                <form action="{{ action('AdminController@index') }}" method="get">
                    <div class=" input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">ニックネーム＆アドレス検索</div>
                        </div>
                        <input type="text" class="form-control" name="cond_name" value="{{ $cond_name }}">
                        <div class="input-group-append">

                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="row-space">
        </div>

        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="10%">ニックネーム</th>
                                <th width="50%">メールアドレス</th>
                                <th width="15%">登録日時／編集日時</th>
                                <th width="10%">編集／削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chat_users as $chat_user)
                                <tr class="table-light">
                                    <td>{{ $chat_user->id }}</td>
                                    <td>{{ $chat_user->name }}</td>
                                    <td>{{ $chat_user->email}}</td>
                                    <td>
                                        <div>{{ $chat_user->created_at }}</div>
                                        <div>{{ $chat_user->updated_at }}</div>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ action('AdminController@edit', ['id' => $chat_user->id]) }}">
                                                <button type="button" class="btn btn-outline-primary btn-sm">
                                                    編集
                                                </button>
                                            </a>
                                        </div>
                                        <div>
                                            <a href="{{ action('AdminController@delete', ['id' => $chat_user->id]) }}">
                                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="return confirm('本当に削除しますか？')">  
                                                    削除
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                 {{-- {{ $chat_users }} --}}
                
            </div>
        </div>
    </div>
@endsection