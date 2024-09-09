<?php
$diretorio = 'posts/';
$arquivos = glob($diretorio . '*.json');
$posts = [];

// Coleta todos os posts
foreach ($arquivos as $arquivo) {
    $post = json_decode(file_get_contents($arquivo), true);
    $posts[] = $post;
}

// Retorna os posts como JSON
header('Content-Type: application/json');
echo json_encode($posts);
?>

