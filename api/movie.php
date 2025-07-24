<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../class/database.php';

function encodeToken($path)
{
    $key = 'netflix-1234567890123456';
    $iv = substr(hash('sha256', 'your-iv-string'), 0, 16);
    $cipher = openssl_encrypt($path, 'AES-256-CBC', $key, 0, $iv);
    return base64_encode($cipher);
}

$MOVIE = $DATABASE->fetchAll("SELECT * FROM movies");

foreach ($MOVIE as &$movie) {
    // แปลง images จาก string ให้เป็น array
    if (isset($movie['images']) && is_string($movie['images'])) {
        $movie['images'] = json_decode($movie['images'], true);
    }

    // เข้ารหัส video_token แทน video_url
    $movie['video_token'] = encodeToken($movie['video_url']);
    unset($movie['video_url']);
}
unset($movie);

unset($movie);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $found = null;
    foreach ($MOVIE as $movie) {
        if ($movie['id'] === $id) {
            $found = $movie;
            break;
        }
    }
    if ($found) {
        echo json_encode($found);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Movie not found']);
    }
} else {
    echo json_encode($MOVIE);
}

?>