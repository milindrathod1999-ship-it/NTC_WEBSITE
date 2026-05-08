<?php
/**
 * PHP development router — replaces serve.mjs
 * Usage: php -S localhost:8000 serve.php
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($uri === '/') {
    $uri = '/index.php';
}

$file = __DIR__ . $uri;

// Let PHP handle .php files natively
if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
    return false;
}

// Serve static files (images, fonts, videos, css, js, etc.)
if (is_file($file)) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $mime = [
        'css'   => 'text/css',
        'js'    => 'application/javascript',
        'json'  => 'application/json',
        'png'   => 'image/png',
        'jpg'   => 'image/jpeg',
        'jpeg'  => 'image/jpeg',
        'gif'   => 'image/gif',
        'svg'   => 'image/svg+xml',
        'ico'   => 'image/x-icon',
        'woff'  => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf'   => 'font/ttf',
        'webp'  => 'image/webp',
        'mp4'   => 'video/mp4',
        'pdf'   => 'application/pdf',
    ];
    if (isset($mime[$ext])) {
        header('Content-Type: ' . $mime[$ext]);
    }
    readfile($file);
    return true;
}

http_response_code(404);
echo '404 Not Found';
