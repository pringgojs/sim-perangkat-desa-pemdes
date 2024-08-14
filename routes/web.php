<?php

use App\Livewire\Pages\User\Form;
use App\Livewire\Pages\User\Index;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SSOTokenController;
use App\Livewire\Pages\Database\UserAccount;
use App\Livewire\Pages\Village\Index as VillageIndex;
use App\Livewire\Pages\Database\Index as DatabaseIndex;
use App\Livewire\Pages\Dashboard\Index as DashboardIndex;
use App\Livewire\Pages\VillageType\Index as VillageTypeIndex;
use App\Livewire\Pages\Tools\RemoveBacklinks\Index as RemoveBacklinksIndex;

Route::get('/', function () {
    return redirect('dashboard');
    // return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    /** admin */
    Route::middleware([
        'role:administrator'
    ])->group(function () {
        Route::get('village-type', VillageTypeIndex::class)->name('village-type.index');
        Route::get('village', VillageIndex::class)->name('village.index');
        Route::get('user', Index::class)->name('user.index');
        Route::get('database/account', UserAccount::class)->name('database.account');
        Route::get('database', DatabaseIndex::class)->name('database.index');
        Route::get('remove-backlinks', RemoveBacklinksIndex::class)->name('remove-backlinks.index');
        Route::get('dashboard', DashboardIndex::class)->name('dashboard.index');
        Route::get('/phpmyadmin', [SSOTokenController::class, 'phpMyAdmin'])->name('phpmyadmin');

    });
});
