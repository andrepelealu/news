<?php

Route::group(['prefix' => 'mc-admin', 'as' => 'mc-admin.', 'middleware' => ['auth.admin', 'auth.permissions']], function ($router) {
	Route::get(config('news.slug', 'news') . '/{news}/confirm-delete', ['as' => config('news.slug', 'news') . '.confirm-delete', 'uses' => '\MissionControl\News\Modules\News\Controllers\AdminNewsController@confirmDelete']);
	Route::get(config('news.slug', 'news') . '/{news}/confirm-restore', ['as' => config('news.slug', 'news') . '.confirm-restore', 'uses' => '\MissionControl\News\Modules\News\Controllers\AdminNewsController@confirmRestore']);
	Route::post(config('news.slug', 'news') . '/{news}/restore', ['as' => config('news.slug', 'news') . '.restore', 'uses' => '\MissionControl\News\Modules\News\Controllers\AdminNewsController@restore']);
	Route::post(config('news.slug', 'news') . '/search', ['as' => config('news.slug', 'news') . '.search', 'uses' => '\MissionControl\News\Modules\News\Controllers\AdminNewsController@search']);
	Route::resource(config('news.slug', 'news'), '\MissionControl\News\Modules\News\Controllers\AdminNewsController', ['except' => ['show']])->parameters([config('news.slug', 'news') => 'news']);
});

Route::get(config('news.slug', 'news'), ['as' => config('news.slug', 'news') . '.index', 'uses' => '\MissionControl\News\Modules\News\Controllers\NewsController@index']);
Route::get(config('news.slug', 'news') . '/archive/{year}/{month}', ['as'   => config('news.slug', 'news') . '.archive', 'uses' => '\MissionControl\News\Modules\News\Controllers\NewsController@archive']);
Route::get(config('news.slug', 'news') . '/{slug}', ['as'   => config('news.slug', 'news') . '.show', 'uses' => '\MissionControl\News\Modules\News\Controllers\NewsController@show']);