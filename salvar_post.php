<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conteudo = $_POST['conteudo'] ?? '';
    $imagem = '';

    // Verifica se uma imagem foi enviada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nomeImagem = uniqid() . '.' . $extensao;
        move_uploaded_file($_FILES['imagem']['tmp_name'], 'uploads/' . $nomeImagem);
        $imagem = 'uploads/' . $nomeImagem;
    }

    // Cria o post em formato de array
    $post = [
        'conteudo' => $conteudo,
        'imagem' => $imagem
    ];

    // Salva o post como um arquivo JSON
    $nomeArquivo = 'posts/' . uniqid() . '.json';
    file_put_contents($nomeArquivo, json_encode($post));

    echo 'Post salvo com sucesso!';
}
?>

