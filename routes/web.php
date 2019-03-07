<?php

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    Route::get('/', 'IndexController@index')->name('main');
    Route::group(['prefix' => 'manage'], function () {
        Route::get('/', 'Manage\IndexController@indexAction')->name('manage.home');
        Route::group(['prefix' => 'system'], function () {
            Route::resource('group', 'Manage\System\GroupController', ['as' => 'manage.system']);
            Route::resource('user', 'Manage\System\UserController', ['as' => 'manage.system']);
        });
    });
    Auth::routes();
    Route::get('/news', 'NewsController@index')->name('news');
    Route::get('/all-news', 'NewsController@allnews')->name('news.all');
    Route::get('/{rubric}/{page}', 'RubricController@listing')->where(['rubric' => '[a-z0-9\-]+', 'page' => '[0-9]+'])->name('rubric.listing');
    Route::get('/{rubric}', 'RubricController@index')->where('rubric', '[a-z0-9\-]+')->name('rubric');
    Route::get('/{rubric}/{publication}', 'PublicationController@show')->where(['rubric' => '[a-z0-9\-]+', 'publication' => '[a-z0-9\-\.]+'])->name('publication.show');

});


