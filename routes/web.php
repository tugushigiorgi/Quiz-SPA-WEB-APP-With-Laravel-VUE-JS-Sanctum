<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\usercontroller;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

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



    Route::get('/register', function () {
        return view('register');
    });

    Route::post('/register',  [usercontroller::class,'register' ]) ;
    Route::get('/login', function () {
        return view('login') ;
    })->name('login') ;
    Route::post('/login',[usercontroller::class,'UserLogin' ]  ) ->name('login');

    Route::post('/',[QuizController::class,'indexpage']);

    Route::get('/', function () {   return view('home');}) ;

Route::middleware(   ['auth:sanctum'] )->group(function () {






    Route::get('/createquiz', function () {
        return view('Createquiz');
    });

    Route::get("/logout",[usercontroller::class,'userLogOut']);
    Route::delete('/deletequiz/{id}',[QuizController::class,'deleteQuiz']);
    Route::get('/result/{point}', function () {
        return view('result');
    });
    Route::get('/submition', function () {
        return view('submition');
    });








    Route::post('/createquiz', [ QuizController::class,'CreatenewQuiz']);


    Route::get('/quizpage/{id}', function () {
        return view('QuizPage');
    });
//to get first
    Route::post('/quizpage/{id}', [ QuizController::class,'assignquiz']);

//to get next answer
    Route::post('quizpage/{id}/next/{position}' ,[ QuizController::class,'getnextanswer']);

    Route::post("/checkanswer/{id}",[QuizController::class,'answerchecker']);



    Route::get('/updatequiz/{id}', function () {
        return view('updatequiz');
    });


    Route::post('/updatequiz/{id}', [QuizController::class,"getdataForUpdatePage"] );

    Route::put('/updatequiz/{id}', [QuizController::class,"UpdateQuiz"] );


    Route::post('makequizpublish/{id}',[QuizController::class,"MakeQuizPublished"]);

    Route::post('makequiz_un_publish/{id}',[QuizController::class,"MakeQuizUNPublished"]);



}) ;




