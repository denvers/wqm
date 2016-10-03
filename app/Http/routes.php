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

//Route::get('/', function () {

//    // Initiate crawl
//    $crawler = new \Arachnid\Crawler('https://www.dtcmedia.nl', 4);
//    $crawler->traverse();
//
//    // Get link data
//    $links = $crawler->getLinks();
//
//
//
//    return view('denver', ['links' => $links]);
//});


Route::get('/', 'MonitorsController@index');
Route::get('/monitor/show/{id}', 'MonitorsController@show');
Route::get('/monitor/destroy/{id}', 'MonitorsController@destroy');
Route::post('/', 'MonitorsController@store');