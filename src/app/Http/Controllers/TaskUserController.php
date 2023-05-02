<?php

namespace App\Http\Controllers;

use App\Models\TaskUser;
use Illuminate\Http\Request;

class TaskUserController extends Controller
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
            "task_id" => "required|exists:tasks,id",
            "user_id" => "required|exists:users,id"
        ]);

        $taskUser = TaskUser::updateOrCreate($request->all());
        
        return response()->json([
            "success" => true,
            "data"    => $taskUser,
            "message" => "Successfully added",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskUser $taskUser)
    {
        $taskUser->delete();

        return response()->json([
            "success" => true,
            "message" => "Successfully deleted",
        ]);
    }
}
