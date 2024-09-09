<?php
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Caminho para os diretórios
    $postsDir = __DIR__ . '/posts/';
    $uploadsDir = __DIR__ . '/uploads/';

    // Lê a entrada JSON
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'] ?? null;

    if ($id) {
        $postsFile = $postsDir . 'posts.json';

        if (file_exists($postsFile)) {
            $posts = json_decode(file_get_contents($postsFile), true);
            $posts = array_filter($posts, function ($post) use ($id) {
                return $post['id'] !== $id;
            });

            file_put_contents($postsFile, json_encode($posts, JSON_PRETTY_PRINT));

            echo 'Postagem excluída com sucesso!';
        } else {
            echo 'Arquivo de postagens não encontrado!';
        }
    } else {
        echo 'ID não fornecido!';
    }
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    echo 'Método não permitido!';
}
?>
