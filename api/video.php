<?php
$key = 'netflix-1234567890123456';
$iv = substr(hash('sha256', 'your-iv-string'), 0, 16);

function decryptPath($ciphertext) {
    global $key, $iv;
    $data = base64_decode($ciphertext);
    return openssl_decrypt($data, 'AES-256-CBC', $key, 0, $iv);
}

if (!isset($_GET['token'])) {
    http_response_code(400);
    echo 'Missing token';
    exit;
}

$token = $_GET['token'];
$filepath = decryptPath($token);

if (!$filepath || !file_exists($filepath)) {
    http_response_code(404);
    echo 'File not found';
    exit;
}

$filesize = filesize($filepath);
$start = 0;
$length = $filesize - 1;
$end = $length;
$fp = fopen($filepath, 'rb');

if (isset($_SERVER['HTTP_RANGE'])) {
    // parse range header
    preg_match('/bytes=(\d+)-(\d*)/', $_SERVER['HTTP_RANGE'], $matches);
    $start = intval($matches[1]);
    if (!empty($matches[2])) {
        $end = intval($matches[2]);
    }
    $length = $end - $start + 1;

    header('HTTP/1.1 206 Partial Content');
    header("Content-Range: bytes $start-$end/$filesize");
} else {
    header('HTTP/1.1 200 OK');
}

header('Content-Type: video/mp4');
header("Content-Length: $length");
header('Accept-Ranges: bytes');

fseek($fp, $start);
$bufferSize = 8192;
while (!feof($fp) && ($pos = ftell($fp)) <= $end) {
    if ($pos + $bufferSize > $end) {
        $bufferSize = $end - $pos + 1;
    }
    echo fread($fp, $bufferSize);
    flush();
}
fclose($fp);
exit;