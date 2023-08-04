<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use Filterable;
    protected $fillable = ['title', 'description', 'priority', 'parent_todo_id', 'user_id', 'completed_at'];
    
    public function todos(){
        return $this->hasMany(self::class, 'parent_todo_id');
    }

    use HasFactory;
}
