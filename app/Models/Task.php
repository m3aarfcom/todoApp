<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;


    protected $fillable = ['title', 'description', 'user_id', 'due_date', 'status', 'priority'];


    public function getStatusNameAttribute()
    {
        $names = [
            '' => 'undefined',
            0 => 'Not Started',
            1 => 'In Progress',
            2 => 'Completed',
        ];

        return $names[$this->status];
    }
    public function getStatusColorAttribute()
    {
        $colors = [
            0 => 'warning',
            1 => 'danger',
            2 => 'success',
        ];

        return $colors[$this->status];
    }
    public function getPriorityColorAttribute()
    {
        $colors = [
            'high' => 'danger',
            'low' => 'success',
            'medium' => 'warning',
        ];

        return $colors[$this->priority];
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'tasks_users');
    }
}
