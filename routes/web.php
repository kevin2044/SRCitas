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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Specialty
Route::get('/specialty', 'SpecialtyController@index');
Route::get('/specialty/create', 'SpecialtyController@create');
Route::post('/specialty', 'SpecialtyController@store');
Route::get('/specialty/{specialty}/edit', 'SpecialtyController@edit');
Route::put('/specialty/{specialty}', 'SpecialtyController@update');
Route::delete('/specialty/{specialty}', 'SpecialtyController@destroy');

//Doctors
Route::get('/doctor', 'DoctorController@index');
Route::get('/doctor/create', 'DoctorController@create');
Route::post('/doctor', 'DoctorController@store');
Route::get('/doctor/{doctor}/edit', 'DoctorController@edit');
Route::put('/doctor/{doctor}', 'DoctorController@update');
Route::delete('/doctor/{doctor}', 'DoctorController@destroy');

//Patients
Route::get('/patient', 'PatientController@index');
Route::get('/patient/create', 'PatientController@create');
Route::post('/patient', 'PatientController@store');
Route::get('/patient/{patient}/edit', 'PatientController@edit');
Route::put('/patient/{patient}', 'PatientController@update');
Route::delete('/patient/{patient}', 'PatientController@destroy');
