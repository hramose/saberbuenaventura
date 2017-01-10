<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['prefix'=>'login'], function(){

	Route::get('/admin', 'AuthAdminController@showLoginForm');
	Route::post('/admin', 'AuthAdminController@login');

	Route::get('/institution', 'AuthInstitutionController@showLoginForm');
	Route::post('/institution', 'AuthInstitutionController@login');

	Route::get('/student', 'Auth\AuthStudentController@showLoginForm');
	Route::post('/student', 'Auth\AuthStudentController@login');
});

Route::group(['prefix'=>'ajax'], function(){

	Route::get('{id}/getCompetences', 'AreaController@getCompetencesByArea');
	Route::get('{id}/getAsignatures', 'AreaController@getAsignaturesByArea');
	Route::get('{grade}/getArea', 'AreaController@getAreaByGrade');

	Route::get('changeStatus&change={status}&preicfes={id}', 'PreicfesController@PreIcfeschangeStatus');

});


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
   
	Route::get('/', [
		'uses'	=>	'AdministratorsController@index',
		'as'	=>	'admin.main'
	]);

	Route::get('logout', [
		'uses'	=>	'AdministratorsController@logout',
		'as'	=>	'admin.logout'
	]);
    
	Route::resource('institution', 'InstitutionController');
	Route::get('institucion/{id}/destroy', [
		'uses'	=>	'InstitutionController@destroy',
		'as'	=> 'admin.institution.destroy'
	]);

	Route::resource('area', 'AreaController');
	Route::get('area/{id}/destroy', [
		'uses'	=>	'AreaController@destroy',
		'as'	=> 'admin.area.destroy'
	]);

	Route::resource('performance', 'Performance_controller');
	Route::get('performance/{id}/destroy', [
		'uses'	=>	'Performance_controller@destroy',
		'as'	=> 'admin.performance.destroy'
	]);

	Route::resource('asignature', 'AsignatureController');
	Route::get('asignature/{id}/destroy', [
		'uses'	=>	'AsignatureController@destroy',
		'as'	=> 'admin.asignature.destroy'
	]);

	Route::resource('competence', 'CompetenceController');
	Route::get('competence/{id}/destroy', [
		'uses'	=>	'CompetenceController@destroy',
		'as'	=> 'admin.competence.destroy'
	]);

	Route::resource('achievement', 'AchievementController');
	Route::get('achievement/{id}/destroy', [
		'uses'	=>	'AchievementController@destroy',
		'as'	=> 'admin.achievement.destroy'
	]);

	Route::resource('author', 'AuthorController');
	Route::get('author/{id}/destroy', [
		'uses'	=>	'AuthorController@destroy',
		'as'	=> 'admin.author.destroy'
	]);

	Route::resource('question', 'QuestionController');
	Route::get('question/{id}/destroy', [
		'uses'	=>	'QuestionController@destroy',
		'as'	=> 'admin.question.destroy'
	]);
});


Route::group(['prefix' => 'institution', 'middleware' => 'institution'], function() {
   
	Route::get('/', [
		'uses'	=>	'InstitutionController@dasboardIndex',
		'as'	=>	'institution.main'
	]);

	Route::get('logout', [
		'uses'	=>	'InstitutionController@logout',
		'as'	=>	'institution.logout'
	]);

	Route::resource('classroom', 'ClassroomController');
	Route::get('classroom/{id}/destroy', [
		'uses'	=>	'ClassroomController@destroy',
		'as'	=>	'institution.classroom.destroy'
	]);

	Route::resource('student', 'StudentController');
	Route::get('student/{id}/destroy', [
		'uses'	=>	'StudentController@destroy',
		'as'	=>	'institution.student.destroy'
	]);

	Route::resource('preicfes', 'PreicfesController');
	Route::get('preicfes/{id}/destroy', [
		'uses'	=>	'PreicfesController@destroy',
		'as'	=>	'institution.preicfes.destroy'
	]);

});	

Route::group(['prefix' => 'student', 'middleware' => 'student'], function() {
   
	Route::get('/', [
		'uses'	=>	'StudentController@dasboardIndex',
		'as'	=>	'student.main'
	]);

	Route::get('logout', [
		'uses'	=>	'StudentController@logout',
		'as'	=>	'student.logout'
	]);

	Route::resource('student', 'StudentController');

	Route::get('profile', [
		'uses'	=>	'StudentController@viewProfile',
		'as'	=>	'student.profile'
	]);

	Route::get('about', [
		'uses'	=>	'StudentController@about',
		'as'	=>	'student.about'
	]);

	Route::get('editInfo', [
		'uses'	=> 'StudentController@editInfo',
		'as'	=>	'student.editInfo'
	]);

	Route::get('editPass',[
		'uses'	=>	'StudentController@editPass',
		'as'	=>	'student.editPass'
	]);

	Route::get('preicfesAll', [
		'uses'	=>	'StudentController@preicfesAll',
		'as'	=>	'student.preicfesAll'
	]);

	Route::get('takepreicfes', [
		'uses'	=>	'StudentController@take_preicfes',
		'as'	=>	'student.take_preicfes'
	]);

	Route::get('preicfes/{id}/description',[
		'uses'	=>	'PreicfesController@descriptionTest',
		'as'	=>	'preicfes.description'
	]);

	Route::get('preicfes/{preicfes_id}/showResults',[
		'uses'	=> 'PreicfesController@showResults',
		'as'	=>	'preicfes.showResults'
	]);

	Route::get('preicfes/{id}/{area}/{area_id}',[
		'uses'	=>	'PreicfesController@preicfesTest',
		'as'	=>	'preicfes.test'
	]);

	Route::post('preicfes/saveAnwser',[
		'uses'	=> 'PreicfesController@saveAnwser',
		'as'	=>	'preicfes.saveAnwser'
	]);

	Route::post('preicfes/updateAnwser',[
		'uses'	=> 'PreicfesController@updateAnwser',
		'as'	=>	'preicfes.updateAnwser'
	]);

	Route::post('preicfes/saveTest', [
		'uses'	=>	'PreicfesController@saveTest',
		'as'	=>	'preicfes.saveTest'
	]);

	Route::get('preicfes/showResults/{id}', [
		'uses'	=>	'PreicfesController@showResults',
		'as'	=>	'preicfes.showResults'

	]);
});

Route::group(['prefix' => 'pdf'], function(){

	Route::get('results/{code}', [
		'uses'	=>	'PreicfesController@showResultsPDF',
		'as'	=>	'preicfes.showResultsPDF'
	]);
});