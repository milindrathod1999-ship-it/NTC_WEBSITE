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
    $type = $mime[$ext] ?? 'application/octet-stream';
    $size = filesize($file);

    // Support HTTP range requests — required for video playback in browsers
    if (isset($_SERVER['HTTP_RANGE'])) {
        preg_match('/bytes=(\d+)-(\d*)/', $_SERVER['HTTP_RANGE'], $m);
        $start = intval($m[1]);
        $end   = isset($m[2]) && $m[2] !== '' ? intval($m[2]) : $size - 1;
        $length = $end - $start + 1;
        http_response_code(206);
        header('Content-Type: ' . $type);
        header('Content-Length: ' . $length);
        header('Content-Range: bytes ' . $start . '-' . $end . '/' . $size);
        header('Accept-Ranges: bytes');
        $fp = fopen($file, 'rb');
        fseek($fp, $start);
        echo fread($fp, $length);
        fclose($fp);
    } else {
        header('Content-Type: ' . $type);
        header('Content-Length: ' . $size);
        header('Accept-Ranges: bytes');
        readfile($file);
    }
    return true;
}

http_response_code(404);
echo '404 Not Found';
