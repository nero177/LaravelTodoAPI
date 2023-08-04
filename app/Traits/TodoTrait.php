<?php

namespace App\Traits;

use App\Models\Todo;

trait TodoTrait{
    public $nestedTodosDone = true;

    public function checkIfNestedTodosDone(Todo $todo){
        $nestedTodos = $todo->todos;

        foreach($nestedTodos as $nestedTodo){
            if($nestedTodo->done == false){
                $this->nestedTodosDone = false;
            }

            $this->checkIfNestedTodosDone($nestedTodo);
        }

        return $this->nestedTodosDone;
    }
}