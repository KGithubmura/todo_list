@extends('layouts.admin')
@section('title','リスト編集')

@section('content')
 @section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>リスト編集</h2>
                <form action="{{ action('Admin\TodoController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                     <div class="form-group row">
                        <label class="col-md-2">カテゴリー</label>
                        <div class="col-md-3">
                            <select name="category_id">
                              <option value="">選択してください</option>
                              <option value="1">私用</option>
                              <option value="2">仕事</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">タイトル</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ $todo_form->title }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">期限</label>
                        <div class="col-md-10">
                            <input type="text" name="deadline_date" step="300"　value="{{ $todo_form->deadline_date }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">優先度</label>
                        <div class="col-md-10">
                          <select name="priority">
                              <option value="">選択してください</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $todo_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection