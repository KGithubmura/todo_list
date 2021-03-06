@extends('layouts.admin')
@section('title','ToDoリスト一覧')

@section('content')
  <div class = "container">
    <div class = "row">
      <h2 class="text-secondary">ToDoリスト一覧</h2>
    </div>
    <div class = "row">
      <div class = "col-md-4">
          <a href = "{{ action('Admin\TodoController@add') }}" role = "button" class = "btn btn-primary">新規作成</a>
          <a href = "{{ action('Admin\TodoController@doneindex') }}" role = "button" class = "btn btn-primary">完了一覧</a>
      </div>
      <div class="col-md-8">
                <form action="{{ action('Admin\TodoController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2 text-secondary">タイトル</label>
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
        <div class = "row mb-3">
            <div class = "col-md-10">
                <a href = "{{ action('Admin\TodoController@category') }}" role = "button" class = "btn btn-primary">カテゴリーを選ぶ</a>
            </div>
            <div class = "col-md-2">
                <a href = "{{ action('Admin\TodoController@index') }}" role = "button" class = "btn btn-primary">一覧へ</a></a>
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
                            @if ($todo->deadline_date < $todo->nowtime )
                                <tr class = "bg-danger">　
                            @else($todo->deadline_date > $todo->nowtime )
                                <tr>
                            @endif
                                    <th>{{ $todo->id }}</th>
                                    <td>{{ str_limit($todo->category->name) }}</td>
                                    <td>{{ str_limit($todo->title, 100) }}</td>
                                    <td>{{ str_limit($todo->nowtime) }}</td>
                                    <td>{{ str_limit($todo->deadline_date) }}</td>
                                    <td>{{ str_limit($todo->priority) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\TodoController@edit', ['id' => $todo->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <a href="{{ action('Admin\TodoController@done',['id' => $todo->id]) }}">完了</a>
                                        </div>
                                    </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
　　　　{{ $posts->links() }}
    </div>
@endsection