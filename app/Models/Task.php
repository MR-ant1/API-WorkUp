<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'taskName',
        'taskDescription',
        'deadline_date',
        'userId',
        'projectId',
        'managerId',
        'is_completed',
    ];
}
