@extends('layouts.admin')
@section('title','カテゴリー一覧')

@section('content')
  <div class = "container">
    <div class = "row">
      <h2>カテゴリー一覧</h2>
    </div>
    <div class = "row">
      <div class = "col-md-8 my-2">
        <a href = "{{ action('Admin\TodoController@categoryCreate') }}">新しくカテゴリーを作る</a>
      </div>
    </div>
    <div class = "row">
      <div class="col-md-8">
        <form action="{{ action('Admin\TodoController@category') }}" method="get">
          <div class="row">
          @foreach ($categories as $category)
              <div class="list-category col-md-3 mx-auto my-3">
                <a href = "{{ action('Admin\TodoController@index')}}" role = "button" class = "btn btn-primary">{{ $category->name }}</a>
              </div>
              <td>
                  <div class = "my-3">
                      <a href="{{ action('Admin\TodoController@categoryEdit', ['id' => $category->id]) }}">編集</a>
                  </div>
              </td>
          @endforeach
          </div>
      </div>
    </div>
@endsection