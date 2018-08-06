<?php

/* ================== Homepage ================== */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::auth();

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'Backend\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/

$as = "";
if(\Idea\Ideaadmin\Helpers\BackendHelper::laravel_ver() == 5.5) {
	$as = config('laraadmin.adminRoute').'.';
	
	// Routes for Laravel 5.5
	Route::get('/logout', 'Auth\LoginController@logout');
}

Route::group(['as' => $as, 'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {
	
	/* ================== Dashboard ================== */
	
	Route::get(config('laraadmin.adminRoute'), 'Backend\DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/dashboard', 'Backend\DashboardController@index');
	
	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', 'Backend\UsersController');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'Backend\UsersController@dtajax');
	
	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', 'Backend\UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', 'Backend\UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'Backend\UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'Backend\UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'Backend\UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'Backend\UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'Backend\UploadsController@delete_file');
	
	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', 'Backend\RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'Backend\RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', 'Backend\RolesController@save_module_role_permissions');
	
	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', 'Backend\PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', 'Backend\PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', 'Backend\PermissionsController@save_permissions');
	
	/* ================== Departments ================== */
	Route::resource(config('laraadmin.adminRoute') . '/departments', 'Backend\DepartmentsController');
	Route::get(config('laraadmin.adminRoute') . '/department_dt_ajax', 'Backend\DepartmentsController@dtajax');
	
	/* ================== Employees ================== */
	Route::resource(config('laraadmin.adminRoute') . '/employees', 'Backend\EmployeesController');
	Route::get(config('laraadmin.adminRoute') . '/employee_dt_ajax', 'Backend\EmployeesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/change_password/{id}', 'Backend\EmployeesController@change_password');
	
	/* ================== Organizations ================== */
	Route::resource(config('laraadmin.adminRoute') . '/organizations', 'Backend\OrganizationsController');
	Route::get(config('laraadmin.adminRoute') . '/organization_dt_ajax', 'Backend\OrganizationsController@dtajax');

	/* ================== Backups ================== */
	Route::resource(config('laraadmin.adminRoute') . '/backups', 'Backend\BackupsController');
	Route::get(config('laraadmin.adminRoute') . '/backup_dt_ajax', 'Backend\BackupsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/create_backup_ajax', 'Backend\BackupsController@create_backup_ajax');
	Route::get(config('laraadmin.adminRoute') . '/downloadBackup/{id}', 'Backend\BackupsController@downloadBackup');
});
