
@extends('layouts.chatlayout')

@section('title', 'チャット新規画面')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h3>チャット新規作成</h3>
                
                <div class="form-group row">
                </div>
                
                <form action="{{ action('ChatController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div class="form-group row">
                        <label class="col-md-3">ニックネーム：</label>
                        <div class="col-md-2">
                            
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            
                            <h5> {{ Auth::user()->name }} </h5>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-3">本文：</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="15">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection