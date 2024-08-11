<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Author\DashboardController as AuthorDashboardController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

use App\Http\Controllers\Admin\YearController;

use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\QuestionImortConroller;
use App\Http\Controllers\Admin\ImportLabalController;


use App\Http\Controllers\ImportController;


Route::get('import', [ImportController::class, 'index']);
Route::post('import', [ImportController::class, 'import'])->name('import');
Route::get('export', [ImportController::class, 'export'])->name('export');

Route::get('import', function () {
    return view('import');
});






Route::get('/', function () {
    return view('welcome');
});



Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::post('/ajax-login', [LoginController::class, 'ajaxLogin']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');




Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers\Admin',
    'middleware' => ['auth', 'admin'],
], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    //curd route
    Route::resource('years', YearController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('topics', TopicController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('options', OptionController::class);

    //import
    Route::get('year-exam-index', [QuestionImortConroller::class, 'YearExamIndex'])->name('yearexam.index');
    Route::post('year-exam-index', [QuestionImortConroller::class, 'YearExam'])->name('yearexam');

    Route::get('explan-exam-index', [QuestionImortConroller::class, 'explanExamIndex'])->name('explan.index');
    Route::post('explan-exam-index', [QuestionImortConroller::class, 'explanExam'])->name('explan.exam');

    //import label
    Route::get('import-label-index', [ImportLabalController::class, 'LabelIndex'])->name('label.index');
    Route::delete('import-label/{id}', [ImportLabalController::class, 'labeldestroy'])
    ->name('import-label.destroy');
    Route::get('import-label-subject/{id}', [ImportLabalController::class, 'LabelSubject'])->name('label.subject');

    Route::post('import-label-subject', [ImportLabalController::class, 'LabelSubjectTopic'])->name('label.subject.topic');

    Route::post('/questions/update-topics', [ImportLabalController::class, 'storeTopics'])->name('updateTopics');


});



// Ensure the namespace is correct and matches the controller file location
Route::group([
    'as' => 'author.',
    'prefix' => 'author',
    'namespace' => 'App\Http\Controllers\Author',
    'middleware' => ['auth', 'author'],
], function () {
    Route::get('dashboard', [AuthorDashboardController::class, 'index'])->name('dashboard');
});
