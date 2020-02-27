@extends('layouts.admin')

@section('title','ToDoリスト')
@section('content')
  <div class = "container">
    <div class = "row">
      <div class = "col-md-8 mx-auto">
        <h2 class="text-dark">ToDo作成</h2>
        <form action="{{ action('Admin\TodoController@create') }}" method="post" enctype="multipart/form-data">
            @if (count($errors) > 0)
              <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
              </ul>
            @endif
            <div class="form-group row">
              <label class="col-md-2 text-dark">カテゴリー</label>
              <div class="col-md-10">
                <select name="category_id">
                    <option value="0">選択無し</option>
                    @foreach($name as $category)
                    <option value="{{$category->id}}">{{ $category->name }}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 text-dark">タイトル</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                </div>
            </div>
            <div class="form-group row">
            <label class="col-md-2 text-dark">期限日</label>
                <div class="col-md-10">
                <input type="datetime-local" name="deadline_date" step="300">
                </div>
            </div>
            <div class="form-group row">
            <label class="col-md-2 text-dark">優先度</label>
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
              {{ csrf_field() }}
            <input type="submit" class="btn btn-primary" value="作成">
        </form>
      </div>
    </div>
  </div>
@endsection