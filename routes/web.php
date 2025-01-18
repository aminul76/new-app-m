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
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\ModelTestController;
use App\Http\Controllers\Admin\CourseSubjectController;
use App\Http\Controllers\Admin\CourseTopicController;
use App\Http\Controllers\Admin\CourseSubscribeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\FackuserController;
use App\Http\Controllers\Author\AuthorModeltest;
use App\Http\Controllers\Author\ResultController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ImportController;

use App\Http\Controllers\Author\SubcribeController;

Auth::routes();


Route::get('/', [FrontendController::class, 'index']);

Route::get('/courses/{slug}', [FrontendController::class, 'courses'])->name('courses.index');

Route::get('/{q_slug}', [FrontendController::class, 'singleQuestions'])->name('single.questions');

Route::get('/courses/{courseSlug}/{subjectSlug}', [FrontendController::class, 'topic'])->name('courses.topic');



Route::get('/topics/{course_id}/{topic_id}/questions', [FrontendController::class, 'showQuestions'])->name('topics.questions');

Route::get('/model-tests/current/{courseSlug}', [AuthorModeltest::class, 'current'])->name('model-tests.current');
Route::get('/model-tests/{courseSlug}/{date}', [AuthorModeltest::class, 'dateModelTest'])->name('model-tests.date');


Route::get('/modelresultlist/{course_slug}', [ResultController::class, 'modelresultlist'])->name('modelresultlist');

Route::get('/profile/{course_slug}', [AuthorDashboardController::class, 'profile'])->name('profile');

// Route::get('import', [ImportController::class, 'index']);
// Route::post('import', [ImportController::class, 'import'])->name('import');
// Route::get('export', [ImportController::class, 'export'])->name('export');





Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::post('/ajax-login', [LoginController::class, 'ajaxLogin']);


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('author/mode-text/{course_slug}/{modeltest_id}/exam', [AuthorModeltest::class, 'examModel'])->name('author.mode-text.exam');


Route::get('author/mode-text/{course_slug}/{modeltest_id}/free', [AuthorModeltest::class, 'examFree'])->name('author.mode-text.free');



Route::get('author/merit-list/{course_slug}/{modeltest_id}', [ResultController::class, 'meritList'])->name('author.merit-list');


Route::get('/author/subcribe/view/{id}', [SubcribeController::class, 'subcribe']);
Route::get('/author/subcribe/tnxid/{id}', [SubcribeController::class, 'tnxid']);
Route::post('/author/payment/store', [SubcribeController::class, 'payment'])->name('author.payment.store');



// Ensure the namespace is correct and matches the controller file location
Route::group([
    'as' => 'author.',
    'prefix' => 'author',
    'namespace' => 'App\Http\Controllers\Author',
    'middleware' => ['auth', 'author'],
], function () {
    Route::get('dashboard', [AuthorDashboardController::class, 'index'])->name('dashboard');
    Route::post('/mode-text/{course_slug}/{modeltest_id}/submit', [AuthorModeltest::class, 'submitExam'])->name('mode-text.submit');
    Route::get('/markshet/{modeltestId}', [AuthorModeltest::class, 'showMarksheet']);
   



});






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
    Route::resource('model_tests', ModelTestController::class);
    Route::resource('course-subject', CourseSubjectController::class);
    Route::resource('course-topic', CourseTopicController::class);
    Route::resource('course-subscribes', CourseSubscribeController::class);
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
    //model test add question
    Route::get('/model-test/{id}/add-questions', [ModelTestController::class, 'showAddQuestionsForm'])->name('model-test.add-questions.form');
    Route::post('/model-test/{id}/add-questions', [ModelTestController::class, 'addQuestions'])->name('model-test.add-questions');
    // Additional Routes for AJAX Requests
    Route::get('/get-topics/{subjectId}', [AjaxController::class, 'getTopics'])->name('getTopics');
    Route::get('/get-questions/{topicId}', [AjaxController::class, 'getQuestions'])->name('get-questions');
    // routes/web.php
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::get('/fackuserimport', [FackuserController::class, 'fackusershowImportForm'])->name('fackuser.import.form');
    Route::post('/fackuserimport', [FackuserController::class, 'fackuserimport'])->name('fackuser.import');


    Route::get('/question/search', [QuestionController::class, 'searchForm'])->name('question.searchForm');
    Route::get('/question/search/results', [QuestionController::class, 'search'])->name('question.search');

});



