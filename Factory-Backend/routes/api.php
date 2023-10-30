<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'system', 'as' => 'api.admin.'], function () {
    Route::group(['namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
        Route::POST('image-store', 'ImageApiController@StoreImage');
    });
});

Route::group(['prefix' => 'admin', 'as' => 'api.admin.', 'namespace' => 'Api\V1\Admin'], function () {
    Route::group(['middleware' => ['auth:api']], function () {
        Route::GET('/user', function (Request $request) {
            return $request->user();
        });

        // Permissions
        Route::apiResource('permissions', 'PermissionsApiController', ['except' => ['store', 'update', 'destroy']]);

        // Roles
        Route::apiResource('roles', 'RolesApiController', ['except' => ['destroy']]);

        // Users
        Route::apiResource('users', 'UsersApiController');
        Route::POST('updatePassword', 'UsersApiController@updatePassword');

        // User Login Log
        Route::apiResource('user-login-logs', 'UserLoginLogApiController');

        // Language
        Route::apiResource('languages', 'LanguageApiController');

        // Image
        Route::POST('images/media', 'ImageApiController@storeMedia')->name('images.storeMedia');
        Route::POST('images/user-ic-receipt', 'ImageApiController@store_user_ic_request');
        Route::POST('images/user-avater-receipt', 'ImageApiController@store_user_avater_request');
        Route::apiResource('images', 'ImageApiController');

        // Notice Board
        Route::POST('notice-boards/media', 'NoticeBoardApiController@storeMedia')->name('notice-boards.storeMedia');
        Route::apiResource('notice-boards', 'NoticeBoardApiController');
        Route::GET('get-banner/{type}', 'NoticeBoardApiController@get_banner');

        // Countries
        Route::apiResource('countries', 'CountriesApiController');

        // Item Category
        Route::apiResource('itemCategories', 'ItemCategoryApiController');
        Route::POST('active-itemCategory/{id}', 'ItemCategoryApiController@active_item_cateory');
        Route::GET('getCategoryList', 'ItemCategoryApiController@getCategoryList');
        Route::GET('getCategoryListByCompany', 'ItemCategoryApiController@getItemCateByCompanyId');

        // Item
        Route::apiResource('items', 'ItemApiController');
        Route::POST('active-item/{id}', 'ItemApiController@activeItem');
        Route::POST('searchItem', 'ItemApiController@searchItem');
        Route::GET('searchItemByBarcode/{barcode}', 'ItemApiController@searchItemByBarcode');
        Route::GET('getItemByCateID/{itemCategoryID}', 'ItemApiController@getItemByItemCategory');
        Route::GET('getItemQuantity', 'ItemApiController@countQuantityItem');
        Route::GET('getItemOfStock', 'ItemApiController@getItemOfStockRecord');

        Route::apiResource('stock-histories', 'StockHistoryApiController');
        Route::GET('get-stockHistoryGroupByDate', 'StockHistoryApiController@getStockListGroupByDate');
        Route::GET('get-stockHistoryById/{id}', 'StockHistoryApiController@getStockHistoryById');
    });
});

Route::group(['prefix' => 'users', 'as' => 'api.users.', 'namespace' => 'Api\V1\Users'], function () {

    // Client Register and Login
    Route::POST('user-register', 'UsersApiController@register');
    Route::POST('user-login', 'UsersApiController@login');

    Route::group(['middleware' => ['auth:api', 'scope:view-user']], function () {
        Route::GET('/user', function (Request $request) {
            return $request->user();
        });
    });
});
