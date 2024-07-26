<?php

use App\Http\Controllers\CodeExecutionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageUsersController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/manage-users', function () {
        return view('superadmin-views.users.manage-users');
    })->name('manage-users');


    Route::prefix('superadmin')->group(function () {
        Route::prefix('manageusers')->group(function () {
            Route::post('jxFetchGridData', [ManageUsersController::class, 'fetchGridData']);
            Route::post('jxBecomeUser', [ManageUsersController::class, 'jxBecomeUser']);
        });
    });

    Route::any('revert', [ManageUsersController::class, 'revertToSuperadmin'])->name('revert.superadmin');
    Route::post('/api/run', [CodeExecutionController::class, 'runCode']);

});
