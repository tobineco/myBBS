@extends('layouts.chatlayout')

@section('title', 'チャット一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>チャット一覧</h2>
        </div>
        
        <div class="row-space">
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('ChatController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            
            <div class="col-md-8">
                <form action="{{ action('ChatController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">本文検索</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_body" value="{{ $cond_body }}">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
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
                                <th width="50%">本文</th>
                                <th width="15%">投稿日時</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $chat)
                                <tr class="table-light">
                                    <td>{{ $chat->id }}</td>
                                    <td>{{ $chat->user->name }}</td>
                                    <td>{{ \Str::limit($chat->body, 250) }}</td>
                                    <td>{{ $chat->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{-- {{ $posts }} --}}
                
            </div>
        </div>
    </div>
@endsection