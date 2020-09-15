<?php


//Route::get('/', 'PagesController@welcome');
//Route::get('wishlist', 'PagesController@wishlist');
//Route::get('manage', 'PagesController@manage');

Route::resource('/','PagesController');
