<?php

use Illuminate\Support\Facades\Route;

Route::get('reboot', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    file_put_contents(storage_path('logs/laravel.log'),'');
    Artisan::call('key:generate');
    Artisan::call('config:cache');
    return '<center><h1>System Rebooted!</h1></center>';
});

Route::get('migrate',function(){
    Artisan::call('migrate');
    return redirect('/');
});

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

//For All Admins and Students
Route::group(['middleware'=>'auth'],function(){

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/subjects', 'SubjectController@index');
    
    Route::get('/exam-papers', 'ExamPaperController@index');
    Route::get('/exam-papers/{data}', 'ExamPaperController@show');

});

//CheckPermission 1 for Admin
Route::group(['middleware'=>['auth','CheckPermission:1']],function(){

    //Subject Admin Portion
    Route::get('/subjects/create', 'SubjectController@create');
    Route::post('/subjects', 'SubjectController@store')->name('subjects.store');
    Route::get('/subjects/{id}/edit', 'SubjectController@edit');
    Route::put('/subjects/{id}', 'SubjectController@update')->name('subjects.update');
    Route::delete('/subjects/{id}', 'SubjectController@destroy');

	Route::resource('/questions', 'QuestionController');

    //Exam Paper Admin Portion
    Route::delete('/exam-papers/{id}', 'ExamPaperController@destroy');
    Route::post('/exam-papers', 'ExamPaperController@store')->name('exam-papers.store');
    Route::post('/assign-student', 'ExamPaperController@assignStudent');
});


//CheckPermission 2 for Students
Route::group(['middleware'=>['auth','CheckPermission:2']],function(){
    Route::post('/submit-answers', 'ExamPaperController@submitAnswers')->name('submit-answers');
});

