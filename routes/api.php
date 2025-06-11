<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


use App\Http\Controllers\Api\SchoolGradeController;

Route::get('/school-grades', [SchoolGradeController::class, 'index']);
Route::post('/school-grades', [SchoolGradeController::class, 'store']);
Route::get('/school-grades/{id}', [SchoolGradeController::class, 'show']);
Route::put('/school-grades/{id}', [SchoolGradeController::class, 'update']);
Route::delete('/school-grades/{id}', [SchoolGradeController::class, 'destroy']);


use App\Http\Controllers\Api\OfficialLanguageSchoolStudentController;

Route::get('/official-language-students', [OfficialLanguageSchoolStudentController::class, 'index']);
Route::post('/official-language-students', [OfficialLanguageSchoolStudentController::class, 'store']);
Route::get('/official-language-students/{id}', [OfficialLanguageSchoolStudentController::class, 'show']);
Route::put('/official-language-students/{id}', [OfficialLanguageSchoolStudentController::class, 'update']);
Route::delete('/official-language-students/{id}', [OfficialLanguageSchoolStudentController::class, 'destroy']);