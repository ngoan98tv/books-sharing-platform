<?php
    
    require('vendor/autoload.php');

    session_start();

    use NoahBuscher\Macaw\Macaw;

    Macaw::get('/',         'App\Controllers\PageController@home');
    Macaw::get('/sign_in',  'App\Controllers\PageController@sign_in');
    Macaw::get('/sign_up',  'App\Controllers\PageController@sign_up');
    Macaw::get('/sign_out', 'App\Controllers\PageController@sign_out');
    Macaw::get('/upload',   'App\Controllers\PageController@upload');
    Macaw::get('/update',   'App\Controllers\PageController@update');
    Macaw::get('/search',   'App\Controllers\BookController@search');

    Macaw::post('/sign_in', 'App\Controllers\UploaderController@sign_in');
    Macaw::post('/sign_up', 'App\Controllers\UploaderController@sign_up');
    Macaw::post('/upload',  'App\Controllers\BookController@create');
    Macaw::post('/delete',  'App\Controllers\BookController@delete');
    Macaw::post('/update',  'App\Controllers\BookController@update');

    Macaw::error(function() {
        echo '404 :: Not Found';
    });

    Macaw::dispatch();
    
?>