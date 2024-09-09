<?php
$postsDir = __DIR__ . '/posts/';
$postsFile = $postsDir . 'posts.json';

if (file_exists($postsFile)) {
    $posts = json_decode(file_get_contents($postsFile), true);
    header('Content-Type: application/json');
    echo json_encode($posts, JSON_PRETTY_PRINT);
} else {
    header('Content-Type: application/json');
    echo json_encode([]);
}
?>
