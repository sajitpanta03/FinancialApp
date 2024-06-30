<?php

function basePath($path) {
    return BASE_PATH . $path;
}

function abort($message, $code = 404) {
    http_response_code($code);
    echo $message;
    exit();
}

function dataGet($arr, $key) {
    if (!is_array($arr) || empty($key)) {
        return null;
    }

    $keysArr = explode('.', $key);
    $current = $arr;

    foreach ($keysArr as $k) {
        if (!is_array($current) || !array_key_exists($k, $current)) {
            return null;
        }
        $current = $current[$k];
    }

    return $current;
}

function view($to) {
    $path = BASE_PATH . "templates/views/{$to}.php";
    if (file_exists($path)) {
            require $path;
        } else {
            echo "View not found: " . $path;
        }
        return $path;
}

