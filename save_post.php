<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $image = '';

    // Verificar se uma imagem foi enviada
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = uniqid() . '-' . $_FILES['image']['name'];
        $imagePath = 'uploads/' . $imageName;

        // Mover o arquivo para o diretório uploads
        if (move_uploaded_file($imageTmpPath, $imagePath)) {
            $image = $imageName;
        } else {
            echo 'Erro ao fazer o upload da imagem.';
            exit;
        }
    }

    // Criar um array para o post
    $post = [
        'id' => uniqid(),
        'content' => $content,
        'image' => $image,
        'timestamp' => time(),
    ];

    // Salvar o post como um arquivo JSON
    $postFilePath = 'posts/' . $post['id'] . '.json';
    file_put_contents($postFilePath, json_encode($post));

    echo 'Postagem salva com sucesso.';
}
?>
