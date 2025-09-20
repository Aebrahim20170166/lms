<?php

use App\Domains\Cities\V1\Controllers\CityController;
use App\Domains\Countries\V1\Controllers\CountryController;
use App\Domains\Courses\V1\Controllers\CourseController;
use App\Domains\Levels\V1\Controllers\LevelController;
use App\Domains\Roles\V1\Controllers\RoleController;
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

Route::apiResource('roles', RoleController::class);
// api resource for countries and cities are defined in their respective modules
Route::apiResource('countries', CountryController::class);
Route::apiResource('cities', CityController::class);

Route::apiResource('levels', LevelController::class);
Route::apiResource('courses', CourseController::class);
