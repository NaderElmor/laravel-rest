<?php

//except because we won't make edit or create html pages
Route::resource('meeting','MeetingController', [ 'except' => ['edit', 'create'] ]);

Route::resource('meeting/registration','RegistrationController', [ 'only' => ['store', 'destroy'] ]);

Route::post('user', ['uses' => 'AuthController@store']);

Route::post('user/signin', ['uses' => 'AuthController@signin']);



