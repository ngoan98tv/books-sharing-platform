<?php

namespace App\Views;

class View {

    public static function render($view, $params = []) {
        extract($params);
        ob_start();
        include('Views/components/header.php');
        include('Views/'.$view.'.php');
        include('Views/components/footer.php');
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public static function create($component, $params = []) {
        extract($params);
        ob_start();
        include('Views/components/'.$component.'.php');
        $content = ob_get_contents();
        ob_end_clean();
        return $content ;
    }

}

?>