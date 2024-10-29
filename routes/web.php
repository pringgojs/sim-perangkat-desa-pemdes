<?php

use App\Livewire\Pages\User\Form;
use App\Livewire\Pages\User\Index;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Role\RolePermission;
use App\Http\Controllers\SSOTokenController;
use App\Livewire\Pages\Database\UserAccount;
use App\Livewire\Pages\VillageStaff\History;
use App\Livewire\Pages\VillageStaff\Pensiun;
use App\Http\Controllers\CheckRoleController;
use App\Livewire\Pages\Role\Index as RoleIndex;
use App\Livewire\Pages\VillagePositionType\Edit;
use App\Livewire\Pages\VillagePositionType\Create;
use App\Livewire\Pages\Profile\Index as ProfileIndex;
use App\Livewire\Pages\Village\Index as VillageIndex;
use App\Livewire\Pages\Database\Index as DatabaseIndex;
use App\Livewire\Pages\Dashboard\Index as DashboardIndex;
use App\Livewire\Pages\Statistic\Index as StatisticIndex;
use App\Livewire\Pages\Permission\Index as PermissionIndex;
use App\Livewire\Pages\VillageStaff\Edit as VillageStaffEdit;
use App\Livewire\Pages\VillageType\Index as VillageTypeIndex;
use App\Livewire\Pages\Notification\Index as NotificationIndex;
use App\Livewire\Pages\VillageStaff\Index as VillageStaffIndex;
use App\Livewire\Pages\PendingApproval\Index as PendingApprovalIndex;
use App\Livewire\Pages\Tools\RemoveBacklinks\Index as RemoveBacklinksIndex;
use App\Livewire\Pages\StatisticStatusData\Index as StatisticStatusDataIndex;
use App\Livewire\Pages\VillagePositionType\Index as VillagePositionTypeIndex;

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
        Route::get('village-position-type/{id}/edit', Edit::class)->name('village-position-type.edit');
        Route::get('village-position-type/create', Create::class)->name('village-position-type.create');
        Route::get('village-position-type', VillagePositionTypeIndex::class)->name('village-position-type.index');
        Route::get('statistic-status-data', StatisticStatusDataIndex::class)->name('statistic-status-data')->middleware('role:administrator');
        Route::get('statistic', StatisticIndex::class)->name('statistic')->middleware('role:administrator');
        Route::get('pending-approval', PendingApprovalIndex::class)->name('pending-approval')->middleware('role:administrator');
        Route::get('check-role', [CheckRoleController::class, 'index'])->name('check-role');
        Route::get('notification', NotificationIndex::class)->name('notification.index');
        Route::get('profile', ProfileIndex::class)->name('profile.index')->middleware('role:operator');
        Route::get('village-staff/pensiun', Pensiun::class)->name('village-staff.pensiun');
        Route::get('village-staff/{id}/history', History::class)->name('village-staff.history');
        Route::get('village-staff/{id}/edit', VillageStaffEdit::class)->name('village-staff.edit');
        Route::get('village-staff', VillageStaffIndex::class)->name('village-staff.index');
        Route::get('village-type', VillageTypeIndex::class)->name('village-type.index');
        Route::get('village', VillageIndex::class)->name('village.index');
        Route::get('permission', PermissionIndex::class)->name('permission.index');
        Route::get('role/{id}/permission', RolePermission::class)->name('role.permission');
        Route::get('role', RoleIndex::class)->name('role.index');
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
