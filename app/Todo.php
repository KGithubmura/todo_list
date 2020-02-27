<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $guarded = array('id');
    public static $rules = array(
        //'category_id' => 'required',
        'title' => 'required',
        'deadline_date' => 'required',
        'priority' => 'required',
    );
    
    public function category()
    {
        return $this->belongsTo('App\Category')->withDefault();
    }
    
}
