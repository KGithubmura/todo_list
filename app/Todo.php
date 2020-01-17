<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $guarded = array('id');
    public static $rules = array(
        'title' => 'required',
        'deadline_date' => 'required',
        'priority' => 'required',
    );
}
