<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{
	public function index()
	{
		$tasks = Task::orderBy('id', 'desc')->get();

		return response()->json($tasks, 200);
	}

	public function store(Request $request)
	{
		// Validamos los campos
		$request->validate([
			"project_id"	=> "required",
			"title"			=> "required|max:50|unique:tasks",
			'status'		=> 'required|max:20'
		]);

		// Guardamos
		$task = new Task();
		$task->project_id    = $request->project_id;
		$task->title         = strtoupper($request->title);
		$task->description   = $request->description;
		$task->status        = strtoupper($request->status);
		$task->save();

		return response()->json(["message" => "Proyecto registrado"], 201);
	}

	public function show(string $id)
	{
		$task = Task::find($id);

		return response()->json($task, 200);
	}

	public function update(Request $request, string $id)
	{
		// Validamos los campos
		$request->validate([
			"title"         => "required|max:50|unique:projects",
			'start_date'    => 'required|date|after:tomorrow',
			'end_date'      => 'required|date|after:start_date'
		]);

		$task = Task::find($id);
		$task->title		= $request->title;
		$task->description	= $request->description;
		$task->start_date   = $request->start_date;
		$task->end_date     = $request->end_date;
		$task->update();

		return response()->json(["message" => "Proyecto actualizado"], 200);
	}

	public function destroy(string $id)
	{
		$task = Task::find($id);
		$task->delete();

		return response()->json(["message" => "Proyecto eliminado"], 200);
	}
}
