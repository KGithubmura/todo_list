@extends('layouts.admin')
@section('title','カテゴリー一覧')

@section('content')
  <div class = "container">
    <div class = "row">
      <h2 class="text-dark">カテゴリー一覧</h2>
    </div>
    <div class = "row">
      <div class = "col-md-8 my-2">
        <a href = "{{ action('Admin\TodoController@categoryCreate') }}" class = "btn btn-primary alert-dark">新しくカテゴリーを作る</a>
      </div>
    </div>
    <div class = "row">
      <div class="col-md-8">
        <form action="{{ action('Admin\TodoController@category') }}" method="get">
          <div class="row">
          @foreach ($categories as $category)
                <div class="list-category col-md-3 mx-auto my-3">
                  <a href = "{{ action('Admin\TodoController@index',['id' => $category->id])}}" name="id" role = "button" class = "btn btn-primary alert-success">{{ $category->name }}</a>
                </div>
                <div class = "my-3">
                    <a href="{{ action('Admin\TodoController@categoryEdit', ['id' => $category->id]) }}" class="text-white">編集</a>
                </div>
          @endforeach
          </div>
      </div>
    </div>
@endsection