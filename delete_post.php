<?php
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $postId = $_GET['id'];

    // Caminho do arquivo do post
    $postFilePath = 'posts/' . $postId . '.json';

    // Verificar se o arquivo existe e excluí-lo
    if (file_exists($postFilePath)) {
        unlink($postFilePath);
        echo 'Postagem excluída com sucesso.';
    } else {
        echo 'Postagem não encontrada.';
    }
}
?>
