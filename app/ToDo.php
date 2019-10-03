<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    public $table = 'to_dos';
    public $fillable = ['name', 'isCompleted'];
    public $timestamps = false;
}
