@extends('layouts.adminlayout')

@section('title', 'ユーザー編集')

@section('content')
    <div class="container">
        <div class="row">
            <h2>ユーザー編集画面</h2>
        </div>
        
        <div class="row-space">
        </div>

        <form action="{{ action('AdminController@update') }}" method="post" enctype="multipart/form-data">

        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="form-group">
                    
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="30%">ニックネーム</th>
                                <th width="80%">メールアドレス</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr class="table-light">
                                    <td>{{ $chat_form->id }}</td>
                                    <td>
                                        <input type="text" class="form-control" name="name" value="{{ $chat_form->name }}">
                                    </td>
                                    <td>
                                        <input type="email" class="form-control" name="email" value="{{ $chat_form->email }}">
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                    
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li class="red">{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <input type="hidden" name="id" value="{{ $chat_form->id }}">
                    
                    {{ csrf_field() }}
                    
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
                
                 {{-- {{ $chat_form }} --}}
                
            </div>
        </div>
    </div>
@endsection