<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Todo;
use App\Category;
use Auth;
use Storage;


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
        $todo = new Todo;
        $categories = new Category;
    
        $form = $request->all();
        
        unset($form['_token']);
        
        $todo->nowtime = Carbon::now();
        $todo->is_complete = 0;
        $todo->user_id = $user->id;
        //dd($todo);
        
        $todo->fill($form);
        
        $todo->save();
    
        
        return redirect('/admin/todo'); // todos
    }
    
    public function index(Request $request)
    {   
        $category = Category::all();
        $todos = Todo::all();
        $category->name = "priority";
        $categories = optional(Category::find($request->id));
        $id = $categories->id;
        $cond_title = $request->cond_title;
        $sort = $request->sort;
        $todoQuery = Todo::where('user_id', Auth::id());
        
        
        if ($cond_title != ''){
            $todoQuery->where('title', $cond_title);
        } 
        
        if ($sort == 'asc') {
            $todoQuery->orderBy('priority' , 'asc');
        } elseif($sort == 'desc') {
            $todoQuery->orderBy('priority' , 'desc');
        } 
        
        if ($id != ''){
            $todoQuery->where('category_id', $id);
        } 
        
        foreach ($todos as $todo) {
            if($todo->is_complete == 0) {
             $todoQuery->where('is_complete', 0);
            }
        }
        
        $posts = $todoQuery->paginate(5);
        
        return view('admin.todo.index', ['posts' => $posts, 'cond_title' => $cond_title,'sort' => $sort,'name' => $categories,'id =>$id']);
    }
    
    public function edit(Request $request)
    {
        $categories = Category::all();
        $todo = Todo::find($request->id);
        if (empty($todo)) {
            abort(404);
        }
        return view('admin.todo.edit',['todo_form' => $todo, 'name' => $categories]);
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
        $todos = Todo::all();
        $categories = optional(Category::find($request->id));
        $cond_title = $request->cond_title;
        $sort= $request->sort;
        $id = $categories->id;
        $todoQuery = Todo::where('user_id', Auth::id());
        
        
        
        if ($cond_title != ''){
            $todoQuery->where('title', $cond_title);
        } 
        
        if ($sort == 'asc') {
            $todoQuery->orderBy('priority' , 'asc');
        } elseif($sort == 'desc') {
            $todoQuery->orderBy('priority' , 'desc');
        } 
        
        if ($id != ''){
            $todoQuery->where('category_id', $id);
        } 
        
        foreach ($todos as $todo) {
            if($todo->is_complete == 1) {
             $todoQuery->where('is_complete', 1);
            }
        }
        
        $posts = $todoQuery->paginate(5);
        
        
        return view('admin.todo.doneindex', ['posts' => $posts, 'cond_title' => $cond_title,'sort' => $sort,'id =>$id', 'name' => $categories]);
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
    
    public function categoryEdit(Request $request)
    {
        $categories = Category::find($request->id);
        if (empty($categories)) {
            abort(404);
        }
        return view('admin.category.categoryedit',['category_form' => $categories]);
    }
    
    
    public function categoryUpdate(Request $request)
    {
        $this->validate($request, Category::$rules);
    
        $categories = Category::find($request->id);
        $category_form = $request->all();
        unset($category_form['_token']);
        
        $categories->fill($category_form);
        $categories->save();
        
        return redirect ('admin/category/category');
    }
    
    public function categoryDelete(Request $request)
    {
        $categories = Category::find($request->id);
        $categories->delete();
        return redirect('admin/category/category');
    }
}