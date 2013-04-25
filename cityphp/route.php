<?php

function route(array $routes, $basePath = '', $key = 'r') {
    foreach($routes as $route => $script) {
        if($route == $_GET[$key]) {
            return $basePath . $script;
        }
    }
}

?>
