<?php

Route::group(['prefix' => 'mc-admin', 'as' => 'mc-admin.', 'middleware' => ['auth.admin', 'auth.permissions']], function ($router) {
	Route::get(config('newscategories.slug', 'newscategories') . '/{newscategory}/confirm-delete', ['as' => config('newscategories.slug', 'newscategories') . '.confirm-delete', 'uses' => '\MissionControl\News\Modules\NewsCategories\Controllers\AdminNewsCategoryController@confirmdelete']);
	Route::get(config('newscategories.slug', 'newscategories') . '/{newscategory}/confirm-restore', ['as' => config('newscategories.slug', 'newscategories') . '.confirm-restore', 'uses' => '\MissionControl\News\Modules\NewsCategories\Controllers\AdminNewsCategoryController@confirmrestore']);
	Route::post(config('newscategories.slug', 'newscategories') . '/{newscategory}/restore', ['as' => config('newscategories.slug', 'newscategories') . '.restore', 'uses' => '\MissionControl\News\Modules\NewsCategories\Controllers\AdminNewsCategoryController@restore']);
	Route::resource(config('newscategories.slug', 'newscategories'), '\MissionControl\News\Modules\NewsCategories\Controllers\AdminNewsCategoryController', ['except' => ['show']])->parameters([config('newscategories.slug', 'newscategories') => 'newscategory']);
});
