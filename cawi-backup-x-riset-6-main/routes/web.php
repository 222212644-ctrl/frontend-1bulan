<?php

use App\Livewire\KBLI;
use App\Livewire\PetaUsaha;
use App\Livewire\Wilkerstat;
use App\Livewire\TabelDinamis;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Riset4q2Controller;

Route::get('/', KBLI::class)->name('home');

Route::get('/petausaha', PetaUsaha::class)->name('petausaha');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/tabeldinamis', TabelDinamis::class)->name('tabeldinamis');

Route::post('/riset4q2/store', [Riset4q2Controller::class, 'store'])->name('riset4q2.store');
require __DIR__ . '/auth.php';
require __DIR__ . '/auth.php';
