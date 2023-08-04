<?php

namespace App\Services;

use App\Models\Todo;
use App\Http\Resources\TodoResource;
use App\Traits\TodoTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;


class TodoService{
    use TodoTrait;

    public function index(Request $request){
        return TodoResource::collection(Todo::filter($request->all())->get());
    }
    public function store($data){
        $user_id = auth()->user()->id;

        $todo = new Todo();

        foreach ($data as $name => $value){
            $todo->$name = $value;
        }

        $todo->user_id = $user_id;
        $todo->save();

        return $todo;
    }

    public function update($data, $id){
        $todo = Todo::findOrFail($id);
        
        foreach ($data as $key => $value) {
            $todo->$key = $value;
        }

        if(isset($data['done'])){
            $done = $data['done'];

            if($done == true && $this->checkIfNestedTodosDone($todo)){
                $todo->done = true;
                $todo->completed_at = Carbon::now()->format('Y-m-d H:i');
            } else {
                $todo->done = 0;
                $todo->completed_at = null;
            }
        }
       
        $todo->save();
        return $todo;
    }

    public function destroy($id){
        $todo = Todo::findOrFail($id);

        if($todo->done == true){
            return 'cannot delete completed task';
        }

        $todo->delete();
        return 'Todo with id: '.$id.' deleted.';
    }
}