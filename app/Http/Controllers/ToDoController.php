<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ToDo;

class ToDoController extends Controller
{

    public  function read()
    {
        $todo = ToDo::all();

        return response()->json($todo);
    }


    public function create(Request $request)
    {
        $todo = new ToDo();
        $todo->name = $request->input('name');
        $todo->isCompleted = $request->input('isCompleted');
        $todo->save();

        return response()->json($todo);
    }



    public function show($id)
    {
        $todo = ToDo::findOrFail($id);
        return response()->json($todo);
    }


    public function update(Request $request, $id)
    {
        $todo = ToDo::findOrFail($id);
        $todo->name = $request->input('name');
        $todo->isCompleted = $request->input('isCompleted');
        $todo->save();

        return response()->json($todo);

    }


    public function delete($id)
    {
        $todo = ToDo::findOrFail($id);
        $todo->delete();
        return response()->json($todo);
    }
}
