<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskProvider extends Model
{
    protected $table = 'task_providers';

    protected $fillable = ['task_id','provider_id','description','money'];
}
