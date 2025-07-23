<?php
function encryptPath($plaintext) {
    $key = 'netflix-1234567890123456'; // 32 bytes key สำหรับ AES-256
    $iv = substr(hash('sha256', 'your-iv-string'), 0, 16); // 16 bytes IV

    $encrypted = openssl_encrypt($plaintext, 'AES-256-CBC', $key, 0, $iv);
    return base64_encode($encrypted);
}

$path = 'content/avengers-endgame.mp4';
$token = encryptPath($path);

echo "Token: " . $token;
