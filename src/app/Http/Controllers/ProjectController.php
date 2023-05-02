<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $with = $request->get('with', []);
        $filter   = $request->get('filter', '');
        $order_by = $request->get('order_by', 'title');
        $order    = $request->get('order', 'asc');
        $paginate = $request->get('paginate', false);
        
        $query    = Project::query()->with($with);
        $query    = $query->where('title', 'like', "%$filter%");
        $query    = $query->orderBy($order_by, $order);
        $projects = $paginate ? $query->paginate() : $query->get();

        return response()->json([
            "success" => true,
            "data"    => $projects,
        ]);
    }

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
        ]);

        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->created_by = Auth::id();
        $project->save();

        return response()->json([
            "success" => true,
            "data"    => $project,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return response()->json([
            "success" => true,
            "data"    => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            "title"       => "required",
            "description" => "required",
        ]);

        $project->title = $request->title;
        $project->description = $request->description;
        $project->save();

        return response()->json([
            "success" => true,
            "data"    => $project
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json([
            "success" => true,
            "data"    => $project
        ]);
    }
}
