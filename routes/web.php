<?php

/*
|--------------------------------------------------------------------------
| Back(admin)
|--------------------------------------------------------------------------
*/
//

Route::get('site-bakimda',function(){
   return view('front.offline');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function (){


    Route::get('cikis','Back\AuthController@logout')->name('logout');

    Route::get('','Back\DashboardController@index')->name('dashboard');

    //Makale işlemleeri---------------------------------------------------
    Route::resource('makaleler','ArticleController');

    Route::get('/switch','ArticleController@switchh')->name('switch');

    Route::get('/allDelete','ArticleController@allDelete')->name('allDelete');

    Route::get('/hardDelete/{id}','ArticleController@hardDelete')->name('hardDelete');

    Route::get('makaleler/silinenler','ArticleController@trashed')->name('trashed.article');

    Route::get('/recovery/{id}','ArticleController@recoveryy')->name('kurtar');


    //Kategori İşlemleri-------------------------------------------------------

    Route::resource('categories','Back\CategoryController');
    Route::get('/category/getData','Back\CategoryController@getData')->name('category.getdata');
    Route::post('/category/update','Back\CategoryController@updatee')->name('category.updatee');



   Route::post('/category/delete','Back\CategoryController@deletecat')->name('category.deleteCategory');

///Sayfalar------------------------------------------------------------------------------------------------------

    Route::get('sayfalar','Back\PagesController@index')->name('sayfalar.index');

    Route::get('sayfalar/create','Back\PagesController@create')->name('sayfalar.create');
    Route::post('sayfalar/store','Back\Pagescontroller@store')->name('sayfalar.store');

    Route::get('sayfalar/guncelle/{id}','Back\PagesController@update')->name('sayfalar.update');
    Route::post('sayfalar/updatePost/{id}','Back\PagesController@updatePost')->name('sayfalar.updatePost');
    Route::get('sayfalar/delete/{id}','Back\PagesController@delete')->name('sayfalar.delete');

    Route::get('sayfalar/orders','Back\PagesController@orders')->name('sayfalar.orders');

    //----Ayarlar---------------------------------------------------------------------------------------

    Route::get('ayarlar','Back\ConfigController@index')->name('config.index');
    Route::post('ayarlar/update','Back\ConfigController@update')->name('config.update');



});

Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function () {

    Route::get('giris', 'Back\AuthController@login')->name('login');

    Route::post('giris', 'Back\AuthController@loginpost')->name('login.post');

    Route::get('üyelik', 'Back\AuthController@uyelik')->name('uyelik');

    Route::post('üyelik', 'Back\AuthController@uyelikpost')->name('uyelik.post');


});


/*
|--------------------------------------------------------------------------
| Front
|--------------------------------------------------------------------------
*/

Route::post('/iletisim','Front\Homepagecontroller@iletisimpost')->name('iletisim.post');


Route::get('/iletisim','Front\HomepageController@iletisim')->name('iletisim');


Route::get('/','Front\HomepageController@index')->name('homepage');

Route::get('sayfa','Front\HomepageController@index');

Route::get('/kategori/{category}','Front\HomepageController@category')->name('category');

Route::get('/{category}/{slug}','Front\HomepageController@single')->name('single');

Route::get('/{sayfaAdi}','Front\HomepageController@page')->name('page');


