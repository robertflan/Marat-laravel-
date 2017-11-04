<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('register/verify/{activationCode}', 'Auth\RegisterController@activate')->name('activation_path');

Route::get('/', 'FrontEndController@index')->name('home');

Route::get('/application', 'FrontEndController@createApplication')->name('application');
Route::post('/application/store', 'FrontEndController@storeApplication')->name('application/store');

Route::get('/application/{job_id}', 'FrontEndController@createApplication')->name('application/{job_id}');

Route::get('dashboard/login', 'Dashboard\DashboardController@login')->middleware('guest')->name('dashboard-login');

Route::get('jobs/{id}', 'FrontEndController@jobPage')->name('job_page');


Route::middleware(['auth'])->prefix('my')->group(function () {
	Route::get('profile', 'FrontEndController@showMyProfile')->name('my_profile');
	Route::get('profile/edit', 'FrontEndController@editMyProfile')->name('edit_my_profile');
	Route::post('profile', 'FrontEndController@updateMyProfile')->name('update_my_profile');
	Route::get('change_password', 'Auth\ChangePasswordController@changePasswordForm');
	Route::post('change_password/save/{id}', 'Auth\ChangePasswordController@changePassword');
});

Route::middleware(['dashboard', 'can:access-admin'])->namespace('Dashboard')->prefix('dashboard')->group(function () {
	Route::get('/', 'DashboardController@home')->name('dashboard-home');

	Route::resource('companies', 'CompanyController');
	Route::resource('categories', 'CategoryController');
	Route::resource('locations', 'LocationController');
	Route::resource('jobs', 'JobController');
	Route::resource('users', 'UserController');
	Route::resource('document_groups', 'DocumentGroupController');
	Route::resource('document_types', 'DocumentTypeController');
	Route::resource('questionnaire', 'QuestionnaireController');
	Route::post('answers/{application}/{questionnaire}', 'QuestionnaireController@answers')->name('questionnaire.answers');

	Route::post('applicants/{application}/status', 'ApplicationController@update_status');
	Route::post('applicants/{application}/doc_upload', 'ApplicationController@upload_document');
	Route::get('applicants/data', 'ApplicationController@data');
	Route::get('applicants/{id}/contracts/{key}', 'ApplicationController@getDocumentList');
	Route::resource('applicants', 'ApplicationController');
});
