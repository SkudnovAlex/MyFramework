<?php

function debug($ar) {
    echo "<pre>"; print_r($ar); echo "</pre>";
}

function redirect ($http = false) {
    if ($http) {
        $redirect = $http;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    header("Location: $redirect");
    exit;
}