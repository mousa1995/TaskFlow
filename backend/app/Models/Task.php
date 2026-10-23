<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //Define mass assignable fields
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
    ];
}
