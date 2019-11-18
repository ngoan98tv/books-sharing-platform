<?php

    require('vendor/autoload.php');

    use NoahBuscher\Macaw\Macaw;

    Macaw::get('/', 'Controllers\demo@index');
    Macaw::get('page', 'Controllers\demo@page');
    Macaw::get('view/(:num)', 'Controllers\demo@view');

    Macaw::dispatch();

?>