<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserActivityController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\LoggerController;
use App\Http\Controllers\Components\CommentComponentController;

Route::get('/sitemap.xml', [App\Http\Controllers\SitemapXmlController::class, 'index']);

//Components
Route::post('/dashboard/comment', [CommentComponentController::class, 'store']);

//Landing Page
Route::get('/', [HomeController::class, 'welcome']);
Route::get('/home', [HomeController::class, 'home']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/privacy', [HomeController::class, 'privacy']);
Route::get('/terms', [HomeController::class, 'terms']);

//Auth
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/sign-in', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'index']);
Route::post('register', [RegisterController::class, 'signup']);


Route::middleware('auth')->group(function () {

    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

    Route::prefix('dashboard')->group(function () {
        //Dashboard Route Section
        Route::get('/', [DashboardController::class, 'dashboard']);
        Route::get('/myprofile', [UserProfileController::class, 'show']);
        Route::get('/myprofile/edit/{id}', [UserProfileController::class, 'edit']);
        Route::put('/myprofile/update/{id}', [UserProfileController::class, 'update']);
        //Users
        Route::get('/users', [UserActivityController::class, 'users']);
        Route::get('/users/add', [UserController::class, 'add']);
        Route::post('/users/adds', [UserController::class, 'addUser']);
        Route::get('/users/delete/{id}', [UserController::class, 'delete']);
        Route::get('/users/edit/{id}', [UserController::class, 'edit']);
        Route::put('/users/update/{id}', [UserController::class, 'update']);
        Route::get('/users/show/{id}', [UserController::class, 'show']);
    });


    Route::middleware('admin')->group(function () {

        Route::get('services', [DashboardController::class, 'displaylogs']);
        //Files
        Route::get('files', [DashboardController::class, 'Showfiles']);

        //Backup
        Route::get('dashboard/backup', [BackupController::class, 'show']);
        Route::get('backup/create', [BackupController::class, 'backup']);
        Route::get('backup/download/{filename}', [BackupController::class, 'download']);
        Route::get('backup/delete/{filename}', [BackupController::class, 'Delete']);
        Route::get('backup/restore/{filename}', [BackupController::class, 'restore']);

        //User Activity
        Route::get('logActivity', [UserActivityController::class, 'logActivity']);
        Route::get('delete/{id}', [UserActivityController::class, 'delete']);

        //log profiler
        Route::get('logs', [LoggerController::class, 'index']);

        //upload pictures
        Route::get('open', [ImageUploadController::class, 'showUploadPage']);
        Route::post('upload', [ImageUploadController::class, 'fileUpload']);


        //Error logs
        Route::get('dashboard/logs', [LoggerController::class, 'logs']);
        Route::get('dashboad/logs/delete/{id}', [LoggerController::class, 'destroy']);

        
    });
    
});
