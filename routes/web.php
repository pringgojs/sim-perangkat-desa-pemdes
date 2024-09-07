<?php

use App\Livewire\Pages\User\Form;
use App\Livewire\Pages\User\Index;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SSOTokenController;
use App\Livewire\Pages\Database\UserAccount;
use App\Http\Controllers\CheckRoleController;
use App\Livewire\Pages\Report\PendingApproval;
use App\Livewire\Pages\Profile\Index as ProfileIndex;
use App\Livewire\Pages\Village\Index as VillageIndex;
use App\Livewire\Pages\Database\Index as DatabaseIndex;
use App\Livewire\Pages\Dashboard\Index as DashboardIndex;
use App\Livewire\Pages\VillageStaff\Edit as VillageStaffEdit;
use App\Livewire\Pages\VillageType\Index as VillageTypeIndex;
use App\Livewire\Pages\Notification\Index as NotificationIndex;
use App\Livewire\Pages\VillageStaff\Index as VillageStaffIndex;
use App\Livewire\Pages\Tools\RemoveBacklinks\Index as RemoveBacklinksIndex;

Route::get('/', function () {
    return redirect('check-role');
    // return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    /** admin */
    // Route::middleware([
    //     'role:administrator'
    // ])->group(function () {
        Route::get('report/pending-approval', PendingApproval::class)->name('pending-approval')->middleware('role:administrator');
        Route::get('check-role', [CheckRoleController::class, 'index'])->name('check-role');
        Route::get('notification', NotificationIndex::class)->name('notification.index');
        Route::get('profile', ProfileIndex::class)->name('profile.index')->middleware('role:operator');
        Route::get('village-staff/{id}/edit', VillageStaffEdit::class)->name('village-staff.edit');
        Route::get('village-staff', VillageStaffIndex::class)->name('village-staff.index');
        Route::get('village-type', VillageTypeIndex::class)->name('village-type.index');
        Route::get('village', VillageIndex::class)->name('village.index');
        Route::get('user', Index::class)->name('user.index')->middleware('role:administrator');
        Route::get('dashboard', DashboardIndex::class)->name('dashboard.index');
        Route::get('/phpmyadmin', [SSOTokenController::class, 'phpMyAdmin'])->name('phpmyadmin');

    // });

    /** para perangkat desa */
    // Route::middleware([
    //     'role:operator'
    // ])->group(function () {
        // Route::get('village-staff', VillageStaffIndex::class)->name('village-staff.index');
        // Route::get('dashboard', DashboardIndex::class)->name('dashboard.index');
    // });
});
