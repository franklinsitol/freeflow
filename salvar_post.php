<?php
// Caminho para os diretórios
$postsDir = __DIR__ . '/posts/';
$uploadsDir = __DIR__ . '/uploads/';

// Certificar-se de que os diretórios existem
if (!file_exists($postsDir)) {
    mkdir($postsDir, 0777, true);
}

if (!file_exists($uploadsDir)) {
    mkdir($uploadsDir, 0777, true);
}

// Função para gerar um nome único para o arquivo
function generateUniqueFilename($dir, $prefix) {
    do {
        $filename = $dir . $prefix . uniqid() . '.jpg';
    } while (file_exists($filename));
    return $filename;
}

// Lê os dados do post
$conteudo = $_POST['conteudo'] ?? '';
$imagem = $_FILES['imagem'] ?? null;

if ($imagem && $imagem['error'] === UPLOAD_ERR_OK) {
    $imagemPath = generateUniqueFilename($uploadsDir, 'post_image_');
    move_uploaded_file($imagem['tmp_name'], $imagemPath);
    $imagemUrl = basename($imagemPath);
} else {
    $imagemUrl = null;
}

// Cria o arquivo JSON com a nova postagem
$postsFile = $postsDir . 'posts.json';

if (file_exists($postsFile)) {
    $posts = json_decode(file_get_contents($postsFile), true);
} else {
    $posts = [];
}

$id = count($posts) + 1;
$post = [
    'id' => $id,
    'conteudo' => $conteudo,
    'imagem' => $imagemUrl
];

$posts[] = $post;
file_put_contents($postsFile, json_encode($posts, JSON_PRETTY_PRINT));

echo 'Postagem salva com sucesso!';
?>
