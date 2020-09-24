@extends('layouts.chatlayout')

@section('title', 'HomeChat一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>連絡一覧</h2>
        </div>
        
        <div class="row-space">
        </div>
        
        <div class="row">
            <div class="col-md-2">
                <a href="{{ action('ChatController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            
            <div class="col-md-4">
            </div>
            
            <div class="col-md-6">
                <form action="{{ action('ChatController@index') }}" method="get">
                    <div class=" input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">本文検索</div>
                        </div>
                        <input type="text" class="form-control" name="cond_body" value="{{ $cond_body }}">
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
                                <th width="5%">番号</th>
                                <th width="10%">ニックネーム</th>
                                <th width="50%">本文</th>
                                <th width="15%">投稿日時／編集日時</th>
                                <th width="10%">編集／削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $chat)
                                <tr class="table-light">
                                    <td>{{ $chat->id }}</td>
                                    <td>{{ $chat->user->name }}</td>
                                    <td>{!! \Str::limit(nl2br(e($chat->body)), 500) !!}</td>
                                    <td>
                                        <div>{{ $chat->created_at }}</div>
                                        <div>{{ $chat->updated_at }}</div>
                                    </td>
                                    <td>
                                        <div>
                                            @can('edit', $chat)
                                            <a href="{{ action('ChatController@edit', ['id' => $chat->id]) }}">
                                                <button type="button" class="btn btn-outline-primary btn-sm">
                                                    編集
                                                </button>
                                            </a>
                                            @endcan
                                        </div>
                                        
                                        <div>
                                            @can('delete', $chat)
                                            <a href="{{ action('ChatController@delete', ['id' => $chat->id]) }}">
                                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="return confirm('本当に削除しますか？')">  
                                                    削除
                                                </button>
                                            </a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{ $posts->appends(['cond_body'=>$cond_body])->links() }}
                
                {{-- {{ $posts }} --}}
                
            </div>
        </div>
    </div>
@endsection