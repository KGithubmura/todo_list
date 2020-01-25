@extends('layouts.admin')

@section('title','カテゴリー作成')
@section('content')
  <div class = "container">
    <div class = "row">
      <div class = "col-md-8 mx-auto">
        <h2>カテゴリー作成</h2>
        <form action="{{ action('Admin\TodoController@categoryCreate') }}" method="post" enctype="multipart/form-data">
            @if (count($errors) > 0)
              <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
              </ul>
            @endif
            <div class="form-group row">
                <label class="col-md-2">カテゴリー</label>
                <div class="col-md-10" action="{{ action('Admin\TodoController@categoryCreate') }}" >
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                </div>
            </div>
              {{ csrf_field() }}
            <input type="submit" class="btn btn-primary" value="作成">
        </form>
      </div>
    </div>
  </div>
@endsection