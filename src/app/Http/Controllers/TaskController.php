<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"       => "required",
            "description" => "required",
            "status"      => "required",
            "project_id"  => "required|exists:projects,id",
        ]);

        $task = new Task();
        $task->title       = $request->title;
        $task->description = $request->description;
        $task->status      = $request->status;
        $task->project_id  = $request->project_id;
        $task->save();

        return response()->json([
            "success" => true,
            "data"    => $task
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response()->json([
            "success" => true,
            "data"    => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            "title"       => "required",
            "description" => "required",
            "status"      => "required",
            "project_id"  => "required|exists:projects,id",
        ]);

        $task->title       = $request->title;
        $task->description = $request->description;
        $task->status      = $request->status;
        $task->project_id  = $request->project_id;
        $task->save();

        return response()->json([
            "success" => true,
            "data"    => $task,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            "success" => true,
            "data"    => $task,
        ]);
    }
}
