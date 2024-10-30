<?php

function basePath($path)
{
    return BASE_PATH . $path;
}

function abort($message, $code = 404)
{
    http_response_code($code);
    echo $message;
    exit();
}

function dataGet($array, $key)
{
    $keys = explode('.', $key);
    foreach ($keys as $k) {
        if (isset($array[$k])) {
            $array = $array[$k];
        } else {
            return null;
        }
    }
    return $array;
}


function view($to, $data = [], $message = null)
{
    $path = BASE_PATH . "templates/views/{$to}.php";

    if ($message !== null) {
        $data['message'] = $message;
    }

    if (file_exists($path)) {
        extract($data);
        require $path;
    } else {
        echo "View not found: " . $path;
    }
    return $path;
}
