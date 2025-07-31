<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Dashboard;
use App\Livewire\Sip\Form as SipForm;
use App\Livewire\Sip\Index as SipIndex;
use App\Livewire\Invoice\Index as InvoiceIndex;

Route::get('home', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/sips', SipIndex::class)->name('sips.index');
    Route::get('/sips/form', SipForm::class)->name('sips.form');

    Route::get('/invoices', InvoiceIndex::class)->name('invoices.index');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
});

require __DIR__.'/auth.php';