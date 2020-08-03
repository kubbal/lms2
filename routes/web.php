<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', function() {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/teacherhome', 'HomeController@indexT')->name('teacherhome')->middleware('auth');
Route::get('/studenthome', 'HomeController@indexS')->name('studenthome')->middleware('auth');
Route::get('/contact', 'ContactController@index')->name('contact');
Route::get('/profile', 'Auth\ProfileController@index')->middleware('auth');
Route::get('/newsubject', 'SubjectController@index')->name('newsubject')->middleware('auth');
Route::post('/newsubject/create', 'SubjectController@create')->name('createsubject')->middleware('auth');
Route::get('/newsubject/edit/{id}', 'SubjectController@edit')->name('editsubject')->middleware('auth');
Route::post('/newsubject/update/{id}', 'SubjectController@update')->name('subjects.update')->middleware('auth');
Route::post('/publish', 'SubjectController@publish')->name('publish')->middleware('auth');
Route::get('/subjects/{id}', 'SubjectController@show')->name('subjects')->middleware('auth');
Route::get('/targyfelvetel', function() {
    return view('targyfelvetel');
})->name('targyfelvetel')->middleware('auth');
Route::post('/felvesz', 'TargyLeadFelveszController@felvesz')->name('felvesz')->middleware('auth');
Route::post('/lead', 'TargyLeadFelveszController@lead')->name('lead')->middleware('auth');
Route::post('/softdel', 'TargyLeadFelveszController@softdel')->name('softdel')->middleware('auth');

//2. felvonás
Route::post('/newtask', 'TaskController@index')->name('newtask')->middleware('auth');
Route::get('/newtask/{id}', 'TaskController@indexGetMethod')->name('newtask')->middleware('auth');
Route::post('/newtask/create', 'TaskController@create')->name('newtask.create')->middleware('auth');

Route::get('/tasks/{id}', 'TaskController@show')->name('showtask')->middleware('auth');
Route::get('/tasks/edit/{id}', 'TaskController@edit')->name('edittask')->middleware('auth');
Route::post('/tasks/update/{id}', 'TaskController@update')->name('tasks.update')->middleware('auth');
Route::post('/tasks/{id}', 'TaskController@bead')->name('task.bead')->middleware('auth');
Route::get('/tasklist', 'TaskController@tasklist')->name('tasklist')->middleware('auth');
Route::get('/grade/{id}', 'SolutionController@edit')->name('grade')->middleware('auth');
Route::post('/grade/update/{id}', 'SolutionController@update')->name('grade.update')->middleware('auth');
Route::get('download/{filename}', function($filename)
{
    $file_path = storage_path() . '/app/' . $filename;
    if (file_exists($file_path))
    {
        return Response::download($file_path, $filename, [
            'Content-Length: '. filesize($file_path)
        ]);
    }
    else
    {
        exit('Requested file does not exist on our server!');
    }
})
->where('filename', '[A-Za-z0-9\-\_\.]+');