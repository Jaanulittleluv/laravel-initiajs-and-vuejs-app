<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Topic;


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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/topics',[TopicController::class, 'index'])->name('topics.index');
Route::post('/topics',[TopicController::class, 'store'])->name('topics.store');
Route::get('/topics/create',[TopicController::class, 'create'])->name('topics.create');
Route::put('/topics/{topic}',[TopicController::class, 'update'])->name('topics.update');
Route::delete('/topics/{topic}',[TopicController::class, 'destroy'])->name('topics.destroy');
Route::get('/topics/{topic}/edit',[TopicController::class, 'edit'])->name('topics.edit');
Route::get('/dashboard', function () {
    $topics = Topic::all()->map(function ($topic) {
        return [
            'id' => $topic->id,
            'name' => $topic->name,
            'age' => $topic->age,
            'status' => $topic->status,
            'image' => asset('storage/' . $topic->image)
        ];
    });

    return Inertia::render('Dashboard', ['topics' => $topics]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';