<?php
// Caminho para o diretório
$postsDir = __DIR__ . '/posts/';
$postsFile = $postsDir . 'posts.json';

if (file_exists($postsFile)) {
    header('Content-Type: application/json');
    echo file_get_contents($postsFile);
} else {
    echo json_encode([]);
}
?>
