@extends('layouts.admin')
@section('title','カテゴリー編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2 class="text-secondary">カテゴリー編集</h2>
                <form action="{{ action('Admin\TodoController@categoryUpdate') }}" method="post" enctype="multipart/form-data">
                      @if (count($errors) > 0)
              <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
              </ul>
            @endif
            <div class="form-group row">
                <label class="col-md-2 text-secondary">カテゴリー</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="name" value="{{ $category_form->name }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-10">
                    <input type="hidden" name="id" value="{{ $category_form->id }}">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </div>
                <td>
                    <div>
                        <a href="{{ action('Admin\TodoController@categoryDelete',['id' => $category_form]) }}">カテゴリー削除</a>
                    </div>
                </td>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection