<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::get("/csrf", function(){
//     return response()->json(csrf_token());
// });
Route::get("/students", [StudentController::class, "index"]);
Route::post("/students", [StudentController::class, "store"]);
Route::get("/groups", [GroupController::class, "index"]);
Route::post("/delete-student", [StudentController::class, "destroy"]);

Route::get("/instructors", [InstructorController::class, "index"]);
Route::post("/instructors", [InstructorController::class, "store"]);
Route::post("/delete-instructor", [InstructorController::class, "destroy"]);
