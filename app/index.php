<?php
    
    require('vendor/autoload.php');
    require('Views/index.php');
    require('Models/connect.php');
    require('Models/Book.php');
    require('Models/Uploader.php');

    session_start();

    use NoahBuscher\Macaw\Macaw;

    Macaw::get('/', 'Controllers\pages@home');
    Macaw::get('/sign_in', 'Controllers\pages@sign_in');
    Macaw::get('/sign_up', 'Controllers\pages@sign_up');
    Macaw::get('/sign_out', 'Controllers\uploader@sign_out');
    Macaw::get('/upload', 'Controllers\pages@upload');

    Macaw::post('/sign_in', 'Controllers\uploader@sign_in');
    Macaw::post('/sign_up', 'Controllers\uploader@sign_up');
    Macaw::post('/upload', 'Controllers\books@create');

    Macaw::error(function() {
        echo '404 :: Not Found';
    });

    Macaw::dispatch();
    
?>