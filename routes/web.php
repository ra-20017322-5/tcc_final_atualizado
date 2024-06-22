<?php
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


#Somente usuarios authenticados
Route::middleware('auth')
    ->prefix('admin')
    ->group(function(){
    
        #'/users' rota usada no navegador pode ser alterada.    name('users.index') rota usada dentro do laravel
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
        Route::get('/users/show/{user}', [UserController::class, 'show'])->name('users.show');
        Route::delete('/users/delete/{user}', [UserController::class, 'delete'])->name('users.delete');
        
        Route::get('/assets/create', [UserController::class, 'create'])->name('assets.create');
        Route::get('/assets/edit/{id}', [UserController::class, 'edit'])->name('assets.create');
        Route::get('/assets', [UserController::class, 'index'])->name('assets.index');
        Route::post('/assets', [UserController::class, 'store'])->name('assets.store');
        
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/', function () {return view('welcome');});
Route::get('/cadeiraderodas', function () {return view('assets_wheel');});




Route::get('/admin', function () {
    return view('admin/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('admin/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';
