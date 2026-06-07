<?php

use App\Livewire\TodoList;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    // Sekarang, halaman dashboard diisi oleh Todo List kamu dan AMAN dari akses publik
    Route::get('/dashboard', TodoList::class)->name('dashboard');

    // Rute profile bawaan Breeze
    Route::view('profile', 'profile')->middleware(['auth'])->name('profile');
});


require __DIR__.'/auth.php';
