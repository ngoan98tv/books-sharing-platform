<?php
namespace views;

function render($view, $params = []) {
    extract($params);
    ob_start();
    include('Views/header.php');
    include('Views/'.$view.'.php');
    include('Views/footer.php');
    $content = ob_get_contents();
    ob_end_clean();
    return $content ;
}

function create($component, $params = []) {
    extract($params);
    ob_start();
    include('Views/'.$component.'.php');
    $content = ob_get_contents();
    ob_end_clean();
    return $content ;
}

?>