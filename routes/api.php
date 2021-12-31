<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

    
 Route::get('/students', [App\Http\Controllers\StudentController::class, 'getStudents']); //route for showing all the students
 Route::post('/student/add', [App\Http\Controllers\StudentController::class, 'addStudent']); //route for adding a student
 Route::patch('/student/update/{id}', [App\Http\Controllers\StudentController::class, 'updateStudent']); //route for updating a student details
 Route::delete('/student/delete/{id}', [App\Http\Controllers\StudentController::class, 'deleteStudent']); //route for deleting a student record
 Route::get('student/search/{name}',[App\Http\Controllers\StudentController::class, 'searchStudent']); // route for searching student 

 Route::get('/subjects', [App\Http\Controllers\SubjectController::class, 'getSubjects']); //route for showing all the subjects
 Route::post('/subject/add', [App\Http\Controllers\SubjectController::class, 'addSubject']); //route for adding a subject
 Route::patch('/subject/update/{id}', [App\Http\Controllers\SubjectController::class, 'updateSubject']); //route for updating a Subject details
 Route::delete('/subject/delete/{id}', [App\Http\Controllers\SubjectController::class, 'deleteSubject']); //route for deleting a Subject record
 Route::get('subject/search/{name}',[App\Http\Controllers\SubjectController::class, 'searchSubject']); // route for searching student 

