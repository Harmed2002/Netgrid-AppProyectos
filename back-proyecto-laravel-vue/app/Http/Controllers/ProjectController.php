<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class ProjectController extends Controller
{
	public function index(Request $request)
	{
		$user_id = Auth::user()->id;
		// $projects = Project::where('user_id', $user_id)->orderBy('id', 'desc')->get();

		// return response()->json($projects, 200);

        $limit = isset($request->limit) ? $request->limit : 10;

		$projects = Project::where('user_id', $user_id)->orderBy('id', 'desc')->with("tasks")->paginate($limit);

		return response()->json($projects, 200);
	}

	public function store(Request $request)
	{
		// Validamos los campos
		$request->validate([
			"title"         => "required|max:50|unique:projects",
			'start_date'    => 'required|date|after:tomorrow',
			'end_date'      => 'required|date|after:start_date'
		]);

		// Guardamos
		$user_id = Auth::user()->id;
		$project = new Project();
		$project->title         = strtoupper($request->title);
		$project->description   = $request->description;
		$project->start_date    = substr($request->start_date, 0, 10);
		$project->end_date      = substr($request->end_date, 0, 10);
		$project->user_id       = $user_id;
		$project->save();

		return response()->json(["message" => "Proyecto registrado"], 201);
	}

	public function show(string $id)
	{
		$project = Project::find($id);

		return response()->json($project, 200);
	}

	public function update(Request $request, string $id)
	{
		// Validamos los campos
		$request->validate([
			"title"         => "required|max:50|unique:projects",
			'start_date'    => 'required|date|after:tomorrow',
			'end_date'      => 'required|date|after:start_date'
		]);

		$project = Project::find($id);
		$project->title			= $request->title;
		$project->description	= $request->description;
		$project->start_date    = $request->start_date;
		$project->end_date      = $request->end_date;
		$project->update();

		return response()->json(["message" => "Proyecto actualizado"], 200);
	}

	public function destroy(string $id)
	{
		$project = Project::find($id);
		$project->delete();

		return response()->json(["message" => "Proyecto eliminado"], 200);
	}
}
