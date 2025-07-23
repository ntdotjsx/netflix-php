<?php
header('Content-Type: application/json; charset=utf-8');

function encodeToken($path) {
    return base64_encode($path);
}

$movies = [
    [
        'id' => 1,
        'title' => 'The Shawshank Redemption',
        'year' => 1994,
        'genre' => 'Drama',
        'trailer' => 'https://www.youtube.com/watch?v=6hB3S9bIaco',
        'video_token' => encodeToken('content/shawshank.mp4')
    ],
    [
        'id' => 2,
        'title' => 'Inception',
        'year' => 2010,
        'genre' => 'Sci-Fi',
        'trailer' => 'https://www.youtube.com/watch?v=YoHD9XEInc0',
        'video_token' => encodeToken('content/inception.mp4')
    ],
    [
        'id' => 3,
        'title' => 'Interstellar',
        'year' => 2014,
        'genre' => 'Adventure',
        'trailer' => 'https://www.youtube.com/watch?v=zSWdZVtXT7E',
        'video_token' => encodeToken('content/interstellar.mp4')
    ],
];

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $found = null;
    foreach ($movies as $movie) {
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
    echo json_encode($movies);
}