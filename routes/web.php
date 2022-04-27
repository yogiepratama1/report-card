<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum', config('jetstream.auth_session'), 'verified'
])->group(function () {
    // CRUD
    Route::get('/dashboard', [ReportController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [ReportController::class, 'store'])->name('report.store');
    Route::get('/dashboard/{report:id}', [ReportController::class, 'show'])->name('report.show');
    Route::get('/dashboard/{report:id}/edit', [ReportController::class, 'edit'])->name('report.edit');
    Route::put('/dashboard/{report:id}/update', [ReportController::class, 'update'])->name('report.update');
    Route::delete('/dashboard/{report:id}', [ReportController::class, 'destroy'])->name('report.destroy');

    /******************************** */
    // Mathematics
    Route::get('/calculate', [ServiceController::class, 'calculate_final'])->name('report.calculate_final');
    // Nested If
    Route::get('/calculate/grade', [ServiceController::class, 'calculate_grade'])->name('report.calculate_grade');

    // Generate Random Report
    Route::post('/generate', [ServiceController::class, 'generate_random_report'])->name('report.generate');

    Route::get('/fill', [ServiceController::class, 'fill_blank_uas'])->name('report.fill_blank_uas');

    Route::post('/count', [ServiceController::class, 'count_characters'])->name('characters.count');
});
