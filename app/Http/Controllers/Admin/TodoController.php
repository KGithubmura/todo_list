<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Todo;
use App\Category;
use Auth;


use Carbon\Carbon;

class TodoController extends Controller
{
    public function add()
    {
        $categories = Category::all();
        return view('admin.todo.create',['name' => $categories]);
    }
    
    
    public function create(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, Todo::$rules);
        $todo = Todo::all();
        $categories = Category::all();
        $form = $request->all();
        
        unset($form['_token']);
        
        $todo->nowtime = Carbon::now();
        $todo->is_complete = 0;
        $todo->user_id = $user->id;
        //dd($todo);
        
        $todo->fill($form);
        
        $todo->save();
    
        
        return view('admin.todo.create',['name' => $categories]);
    }
    
    public function index(Request $request)
    {   
        $categories = Category::all();
        $is_coplete = 0;
        $cond_title = $request->cond_title;
        $sort = $request->sort;
        $category_id = $request->category_id;
        $todoQuery = Todo::where('user_id', Auth::id());
        
        if ($cond_title != ''){
            $todoQuery->where('title', $cond_title);
        } 
        
        /*if ($categories != '') {
            $todoQuery->where('category_id' , $categories);
        }*/
        
        
        if ($sort == 'asc') {
            $todoQuery->orderBy('priority' , 'asc');
        } elseif($sort == 'desc') {
            $todoQuery->orderBy('priority' , 'desc');
        } 
        
        $posts = $todoQuery->paginate(5);
        //dd($posts);
        return view('admin.todo.index', ['posts' => $posts, 'cond_title' => $cond_title,'sort' => $sort,'name' => $categories]);
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
        $sort= $request->sort;
        $posts = Todo::paginate(5);
        
        if ($cond_title != ''){
            $posts = Todo::where('title', $cond_title)->get();
            }
        if ($sort != '') {
            }if ($sort == 'asc') {
            $posts = Todo::orderBy('priority' , 'asc')->paginate(5);
            } elseif($sort == 'desc') {
            $posts = Todo::orderBy('priority' , 'desc')->paginate(5);
        } 
         
        
        return view('admin.todo.doneindex', ['posts' => $posts, 'cond_title' => $cond_title,'sort' => $sort]);
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
    
    public function categoryAdd()
    {
    
        return view('admin.category.categorycreate');
    }
    
    public function categoryCreate(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, Category::$rules);
        $categories = new Category;
        
        $name = $request->all();
        unset($name['_token']);
        $categories->fill($name);
        $categories->save();
    
        return redirect ('admin/category/category'); 
    } 
    
    public function category(Request $request)
    {
        $categories = Category::all();
        //dd($categories);
        
        
        return view('admin.category.category', ['categories' => $categories]);
    }
    
     public function categoryDelete(Request $request)
    {
        $categories = Category::find($request->id);
        $categories->delete();
        return redirect('admin/category/category');
    }
}