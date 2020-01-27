<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {

    Route::resource('project', 'ProjectsController')
        ->except(['create', 'edit', 'update']);

    Route::get('/project/{project}/commits', 'ProjectsController@commits')
        ->where([
            'project' => '[0-9]+',
        ])
        ->name('project.commits')
    ;

    Route::post('/project/{project}/delete-commits', 'ProjectsController@deleteCommits')
        ->where([
            'project' => '[0-9]+',
        ])
        ->name('project.delete.commits')
    ;
//    Route::post('projects', 'ProjectsController@store');


//    Route::post('execute-handle/{handleId}', 'HandleSubscriptionController@execute')
//        ->where([
//            'handleId' => '[0-9]+',
//        ])
//        ->name('handle_subscription')
//    ;

});
