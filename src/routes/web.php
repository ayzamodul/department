<?php


Route::group(['prefix' => 'yonetim/sube','namespace'=>'ayzamodul\department\Http\Controllers','middleware' => ['web','auth']], function () {


    Route::group(['prefix'=>'/'], function () {
        Route::get('/','SubeController@Home');
        Route::any('/subeList/{il_id}','SubeController@subeList')->name('subeList')->middleware('permission:sube-goruntule');
        Route::any('/getsubeList/{il_id}','SubeController@getsubeList')->name('getsubeList');
        Route::get('/tumSubeler','SubeController@tumSubeler')->name('sube.tumSubeler');
        Route::any('/show/{id}','SubeController@show')->name('sube.show')->middleware('permission:sube-goruntule');
        Route::post('/edit','SubeController@edit')->name('sube.edit')->middleware('permission:sube-ekleDuzenle');
        Route::post('/update','SubeController@update')->name('sube.update')->middleware('permission:sube-ekleDuzenle');
        Route::post('/delete','SubeController@delete')->name('sube.delete')->middleware('permission:sube-sil');
        Route::any('/create','SubeController@create')->name('sube.create')->middleware('permission:sube-ekleDuzenle');
        Route::get('/newsube','SubeController@indexsube')->name('sube.subeindex')->middleware('permission:sube-ekleDuzenle');

        Route::post('newPersonal','PersonelController@newPersonal')->name('sube.newPersonal')->middleware('permission:personel-ekleDuzenle');

    });

    Route::group(['prefix'=>'/personel'], function () {
        Route::post('/edit','PersonelController@edit')->name('personel.edit')->middleware('permission:personel-ekleDuzenle');
        Route::post('/update','PersonelController@update')->name('personel.update')->middleware('permission:personel-ekleDuzenle');
        Route::post('/delete','PersonelController@delete')->name('personel.delete')->middleware('permission:personel-sil');
        Route::any('/create','PersonelController@create')->name('personel.create')->middleware('permission:personel-ekleDuzenle');
        Route::get('/index','PersonelController@show')->name('personel.show')->middleware('permission:personel-goruntule');
        Route::get('/newpersonel','PersonelController@indexpersonel')->name('personel.indexpersonel')->middleware('permission:personel-ekleDuzenle');

    });
    Route::group(['prefix'=>'/unvan'], function () {

        Route::get('/show','UnvanController@show')->name('unvan.show')->middleware('permission:sube-goruntule');
        Route::any('/edit/{id}','UnvanController@edit')->name('unvan.edit')->middleware('permission:sube-ekleDuzenle');
        Route::any('/update/{id}','UnvanController@update')->name('unvan.update')->middleware('permission:sube-ekleDuzenle');
        Route::post('/delete','UnvanController@delete')->name('unvan.delete')->middleware('permission:sube-ekleDuzenle');
        Route::post('/create','UnvanController@create')->name('unvan.create')->middleware('permission:sube-ekleDuzenle');
        Route::get('/datatable', 'UnvanController@dataTable');
        Route::post('/ajax', 'UnvanController@load')->middleware('permission:sube-ekleDuzenle');
    });


});
