<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

// Rutas Auth
Route::prefix('/v1/auth')->group(function () {
	Route::post('/login', [AuthController::class, "funLogin"]);
	Route::post('/register', [AuthController::class, "funRegistro"]);

	Route::middleware('auth:sanctum')->group(function () {
		Route::get('/perfil', [AuthController::class, "funPerfil"]);
		Route::post('/logout', [AuthController::class, "funSalir"]);
	});
});

Route::middleware('auth:sanctum')->group(function () {
	Route::apiResource("usuario", UsuarioController::class);
	Route::apiResource("project", ProjectController::class);
	Route::apiResource("task", TaskController::class);
});

// Creo esta ruta para las entradas no autorizadas
Route::get("no-autorizado", function () {
	return ["message" => "No tienes permiso para acceder a esta direccion"];
})->name("login");
