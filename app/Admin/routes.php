<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
//    $router->get('/gallery', 'GalleryUploadController@galleriesList')->name('admin.galleries');
//    $router->get('/gallery/new', 'GalleryUploadController@uploadForm')->name('admin.galleries-form');
//    $router->post('/gallery', 'GalleryUploadController@uploadSubmit')->name('admin.galleries-submit');

    $gallery = [
        'index'   => 'admin.gallery',
        'create'  => 'admin.gallery.create',
        'edit'    => 'admin.gallery.edit',
        'store'   => 'admin.gallery.store',
        'update'  => 'admin.gallery.update',
        'destroy' => 'admin.gallery.delete',
    ];
    $router->resource('gallery', GalleryController::class)->names($gallery);
});
