<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\FixedQuestionsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\SessionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home']);
Route::get('ready-to-dream', [ApplicationController::class, 'application']);
Route::get('ready-to-dream/{formCode}', [ApplicationController::class, 'savedDraft']);
Route::get('ready-to-dream/thank-you/{formCode}', [ApplicationController::class, 'thankYou']);
Route::get('ready-to-dream/pros-cons-life-hacks/{tag}', [ApplicationController::class, 'prosConsLifeHacks']);
Route::post('application/save', [ApplicationController::class, 'save']);
Route::post('application/save/update/{formCode}', [ApplicationController::class, 'updateAndSave']);
Route::post('application/save/check', [ApplicationController::class, 'checkForExistingDrafts']);
Route::post('application/complete', [ApplicationController::class, 'complete']);
Route::get('application/reminder', [ApplicationController::class, 'reminder']);
Route::get('application/delete', [ApplicationController::class, 'delete']);
//Route::get('application/get-json/{formId}', [ApplicationController::class, 'getJson']);
//Route::get('application/test-complete', [ApplicationController::class, 'testComplete']);
//Route::get('email/test', [ApplicationController::class, 'testEmail']);

/* ---------- Admin Panel ---------- */
/* Login */
Route::post('admin/sessions/store', [SessionsController::class, 'store']);
Route::get('admin/login', [SessionsController::class, 'create']);
Route::get('admin/logout', [SessionsController::class, 'destroy']);

/* Home */
Route::get('admin/home', [PageController::class, 'admin_home'])->middleware('auth', 'is.admin');

/* Questions Controller */
Route::get('admin/questions', [QuestionsController::class, 'index_admin'])->middleware('auth', 'is.admin');
Route::get('admin/questions/add', [QuestionsController::class, 'create'])->middleware('auth', 'is.admin');
Route::post('admin/questions/store', [QuestionsController::class, 'store'])->middleware('auth', 'is.admin');
Route::get('admin/questions/{id}/edit', [QuestionsController::class, 'edit'])->middleware('auth', 'is.admin');
Route::post('admin/questions/{id}/update', [QuestionsController::class, 'update'])->middleware('auth', 'is.admin');
Route::get('admin/questions/{id}/destroy', [QuestionsController::class, 'destroy'])->middleware('auth', 'is.admin');

/* Fixed Questions Controller */
Route::get('admin/fixed-questions', [FixedQuestionsController::class, 'index_admin'])->middleware('auth', 'is.admin');
Route::get('admin/fixed-questions/add', [FixedQuestionsController::class, 'create'])->middleware('auth', 'is.admin');
Route::post('admin/fixed-questions/store', [FixedQuestionsController::class, 'store'])->middleware('auth', 'is.admin');
Route::get('admin/fixed-questions/{id}/edit', [FixedQuestionsController::class, 'edit'])->middleware('auth', 'is.admin');
Route::post('admin/fixed-questions/{id}/update', [FixedQuestionsController::class, 'update'])->middleware('auth', 'is.admin');
Route::get('admin/fixed-questions/{id}/destroy', [FixedQuestionsController::class, 'destroy'])->middleware('auth', 'is.admin');
Route::post('admin/fixed-questions/toggle-active', [FixedQuestionsController::class, 'toggleActive']);

//Route::get('create-user', [SessionsController::class, 'create_user']);
//Route::get('update-password', [SessionsController::class, 'update_password']);
