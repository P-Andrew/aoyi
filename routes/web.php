<?php
Route::group(['namespace'=>'Admin','middleware'=>['shopkeeper'],],function(){
    Route::get('admin','IndexController@index')->name('admin');
    Route::resource('category','CategoryController');
    Route::resource('dish','DishController');
    Route::resource('ground','GroundController');
    Route::resource('area','AreaController');
    Route::resource('house','GreenhouseController');
    Route::resource('order','OrderController');
    Route::resource('record','RecordController');
    Route::resource('packaged','PackageController');
    Route::any('/uploads','UploadsController@index');
    Route::post('/configure','IndexController@configure')->name('configure');
    Route::get('/userback','IndexController@userInfo')->name('userback');
    Route::get('/admininvoice','IndexController@adminInvoice')->name('admininvoice');
});

Route::group(['namespace'=>'Home','middleware'=>['user']],function(){
    Route::get('/','IndexController@index')->name('index');
    Route::get('/site','IndexController@house')->name('site');
    Route::get('/site/{id}','IndexController@ground')->name('site.ground');
    Route::get('/confirm/{id}','IndexController@payInfo')->name('confirm');
    Route::get('/pay/{id}','IndexController@confirmPay')->name('confirmpay');
    Route::post('/pay','IndexController@pay')->name('pay');
    Route::get('/crop','CropController@index')->name('crop');
    Route::get('/choose/{id}','CropController@choose')->name('choose');
    Route::post('/croping','CropController@crop')->name('croping');
    Route::get('/user','UserController@index')->name('user');
    Route::group(['middleware'=>[\ShareBuy\Middlewares\UserHasMobile::class]],function(){
        Route::get('/site','IndexController@house')->name('site');
        Route::get('/harvest','CropController@show')->name('harvest');
        Route::post('/address','CropController@address')->name('address');
    });
    Route::get('/harvestrecord','UserController@harvestRecord')->name('harvestrecord');
    Route::get('/croprecord','UserController@cropRecord')->name('croprecord');
    Route::get('/orderecord','UserController@orderRecord')->name('orderecord');
    Route::get('/package','UserController@package')->name('package');
    Route::post('/complete','UserController@complete')->name('complete');
    Route::get('/callback','UserController@callback')->name('back');
    Route::post('/feedback','UserController@feedback')->name('feedback');
    Route::get('/information','UserController@information')->name('information');
    Route::get('/about','UserController@about')->name('about');
    Route::get('/cards','UserController@cards')->name('cards');
    Route::get('/help','UserController@help')->name('help');
    Route::get('/invoice','UserController@invoice')->name('invoice');
    Route::get('/radio/{id}','IndexController@radio')->name('radio');
    Route::get('/showdish','CropController@showDish')->name('showdish');
    Route::get('/scalevideo','CropController@scaleVideo')->name('scalevideo');
    Route::get('/application','UserController@application')->name('application');
    Route::post('/send','UserController@send')->name('send');
});




