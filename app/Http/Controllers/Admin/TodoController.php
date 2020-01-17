<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Todo;
use Carbon\Carbon;

class TodoController extends Controller
{
    public function add()
    {
        return view('admin.todo.create');
    }
    
    
    public function create(Request $request)
    {
      
        $this->validate($request, Todo::$rules);
        $todo = new Todo;
        $form = $request->all();
        $todo->deadline_date = $form['deadline_date'];
        $todo->nowtime = Carbon::now();
        unset($form['_token']);
        
        $todo->is_complete = 0;
        $todo->user_id = $todo->id;
        $todo->fill($form);
        $todo->save();
        
        return redirect('admin/todo');
    }
    
    public function index(Request $request)
    {   
        $is_complete = 0;
        $cond_title = $request->cond_title;
        if ($cond_title != ''){
            $posts = Todo::where('title', $cond_title)->get();
        } else {
            $posts = Todo::where('is_complete',$is_complete)->get();
        }
        
        return view('admin.todo.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    public function edit(Request $request)
    {
        $todo = Todo::find($request->id);
        if (empty($todo)) {
            abort(404);
        }
        return view('admin.todo.edit',['todo_form' => $todo]);
    }
    
    public function update(Request $request)
    {
        $this->validate($request, Todo::$rules);
        $todo = Todo::find($request->id);
        $todo_form = $request->all();
        unset($todo_form['_token']);
        
        $todo->fill($todo_form)->save();
        
        return redirect ('admin/todo');
    }
     
    public function done(Request $request)
    {
        $todo = Todo::find($request->id);
        $todo->is_complete = 1;
        $todo->save();
        return redirect('admin/todo');
    }
    
    
    public function doneindex(Request $request)
    {
        $is_complete = 1;
        $cond_title = $request->cond_title;
        if ($cond_title != ''){
            $posts = Todo::where('title', $cond_title)->get();
        } else {
            $posts = Todo::where('is_complete',$is_complete)->get();
        }
        
        return view('admin.todo.doneindex', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    public function delete(Request $request)
    {
        $todo = Todo::find($request->id);
        $todo->delete();
        return redirect('admin/todo/doneindex');
    }
     public function undone(Request $request)
     {
         $todo = Todo::find($request->id);
        $todo->is_complete = 0;
        $todo->save();
        return redirect('admin/todo/doneindex');
     }
}
