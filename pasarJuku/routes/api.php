<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/hello', function () {
  return "Hello World!";
});

// Mengelompokkan rute dengan prefix api/users
// Route::prefix('users')->group(function () {
//     // Mendapatkan semua pengguna
//     Route::get('/', [UserController::class, 'index']); 

//     // Mendapatkan detail pengguna berdasarkan ID
//     Route::get('/{userID}', [UserController::class, 'show']);

//     // Menambahkan pengguna baru
//     Route::post('/', [UserController::class, 'store']);

//     // Mengupdate pengguna berdasarkan ID
//     Route::put('/{userID}', [UserController::class, 'update']);

//     // Menghapus pengguna berdasarkan ID
//     Route::delete('/{userID}', [UserController::class, 'destroy']);
// });
