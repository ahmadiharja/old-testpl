<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\dashboard;
use App\Http\Controllers\account;
use App\Http\Controllers\displays;
use App\Http\Controllers\settings;
use App\Http\Controllers\facility;
use App\Http\Controllers\workgroup;
use App\Http\Controllers\workstation;
use App\Http\Controllers\tasks;
use App\Http\Controllers\qualityAssurance;
use App\Http\Controllers\histories;
use App\Http\Controllers\users;
use App\Http\Controllers\settings_app;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\reports;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\export;
use App\Http\Controllers\update;
use App\Http\Controllers\tree;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [account::class, 'login']);

Route::get('login', [account::class, 'login'])->name('login');
Route::post('login', [account::class, 'login']);
Route::get('signup', [account::class, 'signup']);
Route::post('create-account', [account::class, 'create_account']);
Route::get('forgot-password', [account::class, 'forgot_password']);
Route::post('reset-password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('logout', [account::class, 'logout']);

// Password reset form
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Handle the reset password form submission
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/verify-user/{code}', [account::class, 'activateUser'])->name('activate.user');

  //Route::get('/verify-user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');
  //Resend
  //Route::get('/auth/resend', 'Auth\LoginController@resend');
  //Route::post('/auth/re-activation', 'Auth\RegisterController@reauthenticated');
  // Notification mail
  //Route::get('/email/notification', 'Auth\RegisterController@RegisterEmailNotification');

Route::group(['middleware' => 'auth'], function(){
    Route::post('update-sidebar', [dashboard::class, 'update_sidebar']);
    
  Route::get('dashboard', [dashboard::class, 'dashboard']);
  Route::get('search', [dashboard::class, 'search']);
  Route::get('d-fail', [dashboard::class, 'd_fail']);
  Route::get('d-ok', [dashboard::class, 'd_ok']);
  Route::get('due-tasks', [dashboard::class, 'due_tasks']);
  Route::get('list-due-tasks', [dashboard::class, 'list_due_tasks']);
  Route::get('list-displays-failed', [dashboard::class, 'list_displays_failed']);

  Route::post('create-build', [update::class, 'create_build']);
  
  Route::get('load-tree/{WORKSTATION}/{LEAF}', [tree::class, 'load_tree']);
  Route::post('load-tree/{WORKSTATION}/{LEAF}', [tree::class, 'load_tree']);
    
  Route::get('displays', [displays::class, 'displays']);
  Route::post('displays', [displays::class, 'displays']);
  Route::get('list-displays', [displays::class, 'list_displays']);
  Route::get('list-displays-tasks', [displays::class, 'list_displays_tasks']);
  Route::post('list-displays', [displays::class, 'list_displays']);
  Route::post('displaysettings/{id}', [displays::class, 'load_display_settings']);
  Route::post('displaysettings/save/{id}', [displays::class, 'save_display_settings']);
  Route::post('displaysettings/save/finance/{id}', [displays::class, 'save_display_fn']);
  
  Route::get('display-calibration', [displays::class, 'display_calibration']);
  Route::post('display-calibration', [displays::class, 'display_calibration']);

  Route::get('list-tasks', [tasks::class, 'list_tasks']);
  Route::get('list-tasks2', [tasks::class, 'list_tasks2']);
  Route::post('create-task', [tasks::class, 'edit_task']);
  Route::post('edit-task', [tasks::class, 'edit_task']);
  Route::post('update-task', [tasks::class, 'update_task']);
  Route::post('delete-task', [tasks::class, 'delete_task']);
  
  Route::post('delete-display', [displays::class, 'delete_display']);
  
  Route::post('fetch-groups', [displays::class, 'fetch_workgroups']);
  Route::post('fetch-workstations', [displays::class, 'fetch_workstations']);
  Route::post('fetch-displays', [displays::class, 'fetch_displays']);
  Route::post('fetch-displays-checklist', [displays::class, 'fetch_displays_checklist']);
  
  Route::get('display-settings/{ID}', [displays::class, 'display_settings']);
  Route::post('display-settings/{ID}', [displays::class, 'display_settings']);
  
  Route::post('fetch-data-settings', [displays::class, 'fetch_data_settings']);
  
  Route::get('site-settings', [settings::class, 'site_settings']);
  Route::post('site-settings', [settings::class, 'site_settings']);
    Route::get('subscription', [settings::class, 'subscription']);
  Route::post('subscription', [settings::class, 'subscription']);
  
  Route::get('profile-settings', [settings::class, 'profile_settings']);
  Route::post('profile-settings', [settings::class, 'profile_settings']);
  Route::post('remove-image', [settings::class, 'remove_image']);
  
  Route::get('alert-settings', [settings::class, 'alert_settings']);
  Route::post('alert-settings', [settings::class, 'alert_settings']);

  Route::get('build-version', [settings::class, 'build_version']);
  Route::post('build-version', [settings::class, 'build_version']);

  Route::get('list-alerts', [settings::class, 'list_alerts']);
  Route::post('list-alerts', [settings::class, 'list_alerts']);
  Route::post('sendtestmail', [settings::class, 'sendTestEmail']);
  //Route::post('alert-store', [settings::class, 'alert_store']);
  Route::post('alert-form', [settings::class, 'form']);
  Route::post('delete-alert', [settings::class, 'delete_alert']);
  Route::post('errorlimit-update', [settings::class, 'errorlimit_update']);
  Route::post('errorsmtp-update', [settings::class, 'errorsmtp_update']);
  Route::post('update-alert', [settings::class, 'update_alert']);

  Route::get('application-settings/{ID}', [settings::class, 'application_settings']);
  Route::get('global-settings', [settings::class, 'global_settings']);
  Route::get('app-settings/{ID}', [settings_app::class, 'app_settings']);
  Route::get('app-settings/get/categories', [settings_app::class, 'getCategories']);
  Route::post('app-settings/save/app/{id}', [settings_app::class, 'saveapp']);
  Route::post('app-settings/save/location/{id}', [settings_app::class, 'savelocation']);
  Route::post('app-settings/save/dc/{id}', [settings_app::class, 'savedc']);
  Route::post('app-settings/save/qa/{id}', [settings_app::class, 'saveqa']);
  
  Route::get('facility-info', [facility::class, 'facility_information']);
  Route::post('facility-info', [facility::class, 'facility_information']);
  Route::get('facility-info/{ID}', [facility::class, 'facility_information']);
  Route::post('facility-info/{ID}', [facility::class, 'facility_information']);
  Route::post('fetch-description', [facility::class, 'fetch_description'] );
  Route::post('fetch-location', [facility::class, 'fetch_location']);
  Route::post('fetch-timezone', [facility::class, 'fetch_timezone']);
  Route::get('facilities-management', [facility::class, 'facilities_management']);
  Route::post('facilities-management', [facility::class, 'facilities_management']);
  Route::get('list-facilities', [facility::class, 'list_facilities']);
  Route::post('facility-form', [facility::class, 'form']);
  Route::post('delete-facility', [facility::class, 'delete']);
  
  Route::get('workgroups', [workgroup::class, 'workgroups']);
  Route::post('workgroups', [workgroup::class, 'workgroups']);
  Route::post('workgroup-form', [workgroup::class, 'form']);
  Route::get('list-workgroups', [workgroup::class, 'list_workgroups']);
  Route::post('delete-workgroup', [workgroup::class, 'delete_workgroup']);
  Route::get('workgroups-info/{ID}', [workgroup::class, 'workgroups_info']);
  //Route::get('application-settings', [workgroup::class, 'application_settings']);
  //Route::post('application-settings', [workgroup::class, 'application_settings']);
  
  Route::get('workstations', [workstation::class, 'workstations']);
  Route::post('workstations', [workstation::class, 'workstations']);
  Route::get('list-workstations', [workstation::class, 'list_workstations']);
  Route::post('workstation-form', [workstation::class, 'form']);
  Route::post('delete-workstation', [workstation::class, 'delete_workstation']);
  Route::get('workstations-info/{ID}', [workstation::class, 'workstations_info']);
  
  Route::get('quality-assurance', [qualityAssurance::class, 'quality_assuarance']);
  Route::post('quality-assurance', [qualityAssurance::class, 'quality_assuarance']);
  Route::post('fetch-groups2', [qualityAssurance::class, 'fetch_workgroups2']);
  Route::post('fetch-workstations2', [qualityAssurance::class, 'fetch_workstations2']);
  Route::post('fetch-displays-checklist2', [qualityAssurance::class, 'fetch_displays_checklist2']);

  Route::get('/calendar/events', [CalendarController::class, 'events']);
  
  Route::get('histories/{ID}', [histories::class, 'view_histories']);
  Route::get('/graph/spect/{history_id}/{step_id}/{graph_id}', [export::class, 'generateSpectralGraph']);
  Route::get('/graph/image/{history_id}/{step_id}/{graph_id}', [export::class, 'convertGraphToImage']);

  Route::get('histories-reports', [histories::class, 'histories']);
  Route::post('histories-reports', [histories::class, 'histories']);
  Route::get('list-histories', [histories::class, 'list_histories']);
  Route::post('list-histories', [histories::class, 'list_histories']);
  Route::post('histories/export/pdf', [export::class, 'exportPDF']);

  Route::get('reports/display-calibration', [reports::class, 'exportDisplayCalibration']);
  Route::get('reports/displays', [reports::class, 'exportDisplays']);
  Route::get('reports/all-tasks', [reports::class, 'exportAllTasks']);
  Route::get('reports/histories-reports', [reports::class, 'exportHistoriesReports']);
  Route::get('reports/workgroups', [reports::class, 'exportWorkgroups']);
  Route::get('reports/workstations', [reports::class, 'exportWorkstations']);
  
  Route::get('users-management', [users::class, 'users_management']);
  Route::post('users-management', [users::class, 'users_management']);
  Route::get('users-list', [users::class, 'users_list']);
  Route::post('user-form', [users::class, 'user_form']);
  Route::post('delete-user', [users::class, 'delete']);
  Route::post('update-user', [users::class, 'update_user']);
  
});