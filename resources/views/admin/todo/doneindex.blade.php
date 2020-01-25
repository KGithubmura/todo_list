@extends('layouts.admin')
@section('title','完了済みリスト一覧')

@section('content')
  <div class = "container">
    <div class = "row">
      <h2>完了済みリスト一覧</h2>
    </div>
    <div class = "row">
      <div class = "col-md-4">
          <a href = "{{ action('Admin\TodoController@add') }}" role = "button" class = "btn btn-primary">新規作成</a>
          <a href = "{{ action('Admin\TodoController@index') }}" role = "button" class = "btn btn-primary">ToDoリストへ</a>　
      </div>
      <div class="col-md-8">
                <form action="{{ action('Admin\TodoController@doneindex') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            <select name="sort" value="{{ $sort }}" href = "{{ action('Admin\TodoController@index') }}" role = "button">
                                <option value="">優先度</option>
                                <option value="asc">低い順</option>
                                <option value="desc">高い順</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-todo col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width='10%'>カテゴリー</th>
                                <th width="20%">タイトル</th>
                                <th width='10%'>作成日</th>
                                <th width='10%'>#期限日</th>
                                <th width='10%'>優先度</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $todo)
                            @if($todo->is_complete == 1)
                                <tr>
                                    <th>{{ $todo->id }}</th>
                                    <td>{{ str_limit($todo->title, 100) }}</td>
                                    <td>{{ str_limit($todo->nowtime) }}</td>
                                    <th>{{ str_limit($todo->deadline_date) }}</th>
                                    <td>{{ str_limit($todo->priority) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\TodoController@delete',['id' => $todo->id]) }}">削除</a>
                                        </div>
                                        <div>
                                            <a href="{{ action('Admin\TodoController@undone',['id' => $todo->id]) }}">未完了に戻す</a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
　　　　　　{{ $posts ->links() }}
    </div>
@endsection