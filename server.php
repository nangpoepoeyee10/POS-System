<?php

// Use the built-in PHP server to handle requests
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false; // Serve the requested resource as-is.
}

require_once __DIR__.'/public/index.php';
