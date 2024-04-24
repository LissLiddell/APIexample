<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('students', [StudentController::class,'index']);
//Insert 
Route::post('students', [StudentController::class,'store']);
//Select
Route::get('students/{id}', [StudentController::class,'show']);
//update get file
Route::get('students/{id}/edit', [StudentController::class,'edit']);
//Apply Update
Route::put('students/{id}/edit', [StudentController::class,'update']);
