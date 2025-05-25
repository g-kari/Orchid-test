<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleGridScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\LUserLog\LUserLogEditScreen;
use App\Orchid\Screens\LUserLog\LUserLogListScreen;
use App\Orchid\Screens\MUserRole\MUserRoleEditScreen;
use App\Orchid\Screens\MUserRole\MUserRoleListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\SampleScreen;
use App\Orchid\Screens\TUser\TUserEditScreen;
use App\Orchid\Screens\TUser\TUserListScreen;
use App\Orchid\Screens\TUserRole\TUserRoleEditScreen;
use App\Orchid\Screens\TUserRole\TUserRoleListScreen;
use App\Orchid\Screens\TUserSetting\TUserSettingEditScreen;
use App\Orchid\Screens\TUserSetting\TUserSettingListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Example Screen'));

// Sample Screen
Route::screen('sample', SampleScreen::class)
    ->name('platform.sample')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Sample Screen'));

Route::screen('/examples/form/fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('/examples/form/advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');
Route::screen('/examples/form/editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('/examples/form/actions', ExampleActionsScreen::class)->name('platform.example.actions');

Route::screen('/examples/layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('/examples/grid', ExampleGridScreen::class)->name('platform.example.grid');
Route::screen('/examples/charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('/examples/cards', ExampleCardsScreen::class)->name('platform.example.cards');

// T_Users (サンプルユーザー) Routes
// Platform > System > T_Users > User
Route::screen('tusers/{tuser}/edit', TUserEditScreen::class)
    ->name('platform.systems.tusers.edit')
    ->breadcrumbs(fn (Trail $trail, $tuser) => $trail
        ->parent('platform.systems.tusers')
        ->push($tuser->user_name, route('platform.systems.tusers.edit', $tuser)));

// Platform > System > T_Users > Create
Route::screen('tusers/create', TUserEditScreen::class)
    ->name('platform.systems.tusers.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.tusers')
        ->push('作成', route('platform.systems.tusers.create')));

// Platform > System > T_Users
Route::screen('tusers', TUserListScreen::class)
    ->name('platform.systems.tusers')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('ユーザー管理', route('platform.systems.tusers')));

// L_UserLogs (ユーザーログ) Routes
// Platform > System > L_UserLogs > User Log
Route::screen('userlogs/{userlog}/edit', LUserLogEditScreen::class)
    ->name('platform.systems.userlogs.edit')
    ->breadcrumbs(fn (Trail $trail, $userlog) => $trail
        ->parent('platform.systems.userlogs')
        ->push('ID: ' . $userlog->id, route('platform.systems.userlogs.edit', $userlog)));

// Platform > System > L_UserLogs > Create
Route::screen('userlogs/create', LUserLogEditScreen::class)
    ->name('platform.systems.userlogs.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.userlogs')
        ->push('作成', route('platform.systems.userlogs.create')));

// Platform > System > L_UserLogs
Route::screen('userlogs', LUserLogListScreen::class)
    ->name('platform.systems.userlogs')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('ユーザーログ管理', route('platform.systems.userlogs')));

// M_UserRoles (ロール) Routes
// Platform > System > M_UserRoles > Role
Route::screen('userroles/{userrole}/edit', MUserRoleEditScreen::class)
    ->name('platform.systems.userroles.edit')
    ->breadcrumbs(fn (Trail $trail, $userrole) => $trail
        ->parent('platform.systems.userroles')
        ->push($userrole->role_name, route('platform.systems.userroles.edit', $userrole)));

// Platform > System > M_UserRoles > Create
Route::screen('userroles/create', MUserRoleEditScreen::class)
    ->name('platform.systems.userroles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.userroles')
        ->push('作成', route('platform.systems.userroles.create')));

// Platform > System > M_UserRoles
Route::screen('userroles', MUserRoleListScreen::class)
    ->name('platform.systems.userroles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('ロール管理', route('platform.systems.userroles')));

// T_UserRoles (ユーザーロール) Routes
// Platform > System > T_UserRoles > UserRole
Route::screen('tuserroles/{tuserrole}/edit', TUserRoleEditScreen::class)
    ->name('platform.systems.tuserroles.edit')
    ->breadcrumbs(fn (Trail $trail, $tuserrole) => $trail
        ->parent('platform.systems.tuserroles')
        ->push('ID: ' . $tuserrole->id, route('platform.systems.tuserroles.edit', $tuserrole)));

// Platform > System > T_UserRoles > Create
Route::screen('tuserroles/create', TUserRoleEditScreen::class)
    ->name('platform.systems.tuserroles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.tuserroles')
        ->push('作成', route('platform.systems.tuserroles.create')));

// Platform > System > T_UserRoles
Route::screen('tuserroles', TUserRoleListScreen::class)
    ->name('platform.systems.tuserroles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('ユーザーロール管理', route('platform.systems.tuserroles')));

// T_UserSettings (ユーザー設定) Routes
// Platform > System > T_UserSettings > UserSetting
Route::screen('tusersettings/{tusersetting}/edit', TUserSettingEditScreen::class)
    ->name('platform.systems.tusersettings.edit')
    ->breadcrumbs(fn (Trail $trail, $tusersetting) => $trail
        ->parent('platform.systems.tusersettings')
        ->push('ID: ' . $tusersetting->id, route('platform.systems.tusersettings.edit', $tusersetting)));

// Platform > System > T_UserSettings > Create
Route::screen('tusersettings/create', TUserSettingEditScreen::class)
    ->name('platform.systems.tusersettings.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.tusersettings')
        ->push('作成', route('platform.systems.tusersettings.create')));

// Platform > System > T_UserSettings
Route::screen('tusersettings', TUserSettingListScreen::class)
    ->name('platform.systems.tusersettings')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('ユーザー設定管理', route('platform.systems.tusersettings')));

// Route::screen('idea', Idea::class, 'platform.screens.idea');
