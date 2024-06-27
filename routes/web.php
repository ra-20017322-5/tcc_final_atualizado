<?php
use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\AssetGaleryController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Route::get('admin/users', function () {
//     return view('admin/users/index');
// })->middleware(['auth', 'verified'])->name('users.index');

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
        
        Route::get('/assets/create', [AssetController::class, 'create'])->name('assets.create');
        Route::get('/assets/edit/{id}', [AssetController::class, 'edit'])->name('assets.edit');
        Route::put('/assets/edit/{id}', [AssetController::class, 'update'])->name('assets.update');
        Route::get('/assets', [AssetController::class, 'index'])->name('assets.index');
        Route::post('/assets', [AssetController::class, 'store'])->name('assets.store');
        Route::delete('/assets/delete/{id}', [AssetController::class, 'delete'])->name('assets.delete');
        
        Route::get('/assets_galery/{id}', [AssetGaleryController::class, 'index'])->name('assets_galery.index');
        Route::post('/assets_galery/{id}', [AssetGaleryController::class, 'store'])->name('assets_galery.store');
        
        Route::get('/assets_contract/{id}', [AssetGaleryController::class, 'index'])->name('assets_contract.index');
        Route::post('/assets_contract/{id}', [AssetGaleryController::class, 'store'])->name('assets_contract.store');
        
        Route::get('/uploads/{id}', [AssetGaleryController::class, 'upload'])->name('uploads.upload');
        Route::post('/uploads/{id}', [AssetGaleryController::class, 'store'])->name('uploads.store');
        
        Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index');
        Route::post('/contracts/{id}', [ContractController::class, 'store'])->name('contracts.store');
        
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
