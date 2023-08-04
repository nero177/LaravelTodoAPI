<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Illuminate\Http\Request;
use App\Services\TodoService;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $todoService = new TodoService();
        return $todoService->index($request);        
    }

    public function store(StoreTodoRequest $request)
    {
        $validated = $request->validated();
        $todoService = new TodoService();
        return response($todoService->store($validated), 200);
    }

    public function update(UpdateTodoRequest $request, $id){
        $validated = $request->validated();
        $todoService = new TodoService();
        return response($todoService->update($validated, $id), 200);
    }

    public function destroy(Request $request, $id){
        $todoService = new TodoService();
        return ['message' => $todoService->destroy($id)];
    }
}