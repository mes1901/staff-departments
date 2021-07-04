<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\FileController;

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

Route::get('employees', [EmployeeController::class, 'getAllEmployees']);
Route::get('departments', [DepartmentController::class, 'getAllDepartments']);
Route::post('upload-file', [FileController::class, 'saveFile']);
