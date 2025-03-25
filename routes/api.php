<?php

use App\Http\Controllers\FilmSessionController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\HallSchemaController;
use App\Http\Middleware\CorsMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

//client part
Route::get('/session/{session_id}', [FilmSessionController::class, 'getSessionInfo']);
Route::get('/films', [FilmController::class, 'getFilmsByDay']);
Route::post('/create-ticket', [TicketController::class, 'createTicket']);

//admin part
Route::get('/halls', [HallController::class, 'index']);
Route::post('/hall', [HallController::class, 'create']);
Route::get('/hall/{id}', [HallController::class, 'read']);
Route::patch('/hall/{id}', [HallController::class, 'update']);
Route::delete('/hall/{id}', [HallController::class, 'delete']);

Route::post('/price', [PriceController::class, 'create']);
Route::get('/price/{hall_id}', [PriceController::class, 'read']);
Route::patch('/price/{hall_id}', [PriceController::class, 'update']);

Route::get('/hall-schema/{hall_id}', [HallSchemaController::class, 'read']);

Route::get('/admin/films', [FilmController::class, 'getFilms']);
Route::post('/admin/film', [FilmController::class, 'create']);

Route::get('/admin/sessions', [FilmSessionController::class, 'getSessionsByDay']);
Route::post('/admin/session', [FilmSessionController::class, 'create']);
Route::patch('/admin/sessions/toggle-sale', [FilmSessionController::class, 'togglesale']);

//auth
Route::post('register', [RegisteredUserController::class, 'store']);
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::middleware('auth:sanctum')->get('user', function () {
    return auth()->user();
});
