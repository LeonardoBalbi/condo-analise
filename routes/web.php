<?php

use App\Http\Controllers\AnalysisController;
use Illuminate\Support\Facades\Route;

// Redirect home to the analysis dashboard
Route::get('/', [AnalysisController::class, 'index'])->name('analysis.index');

// Route to process the analysis
Route::post('/analisar', [AnalysisController::class, 'store'])->name('analysis.store');
