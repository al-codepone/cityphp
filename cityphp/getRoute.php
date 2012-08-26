<?php

function getRoute(array $routes, $key = 'r') {
    foreach($routes as $route => $script) {
        if($route == $_GET[$key]) {
            return $script;
        }
    }
}

?>
