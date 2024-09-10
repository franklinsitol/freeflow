const githubApiUrl = 'https://api.github.com/repos/franklinsitol/freeflow/contents/posts';
const token = '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'; // Novo token de acesso pessoal

// Função para carregar posts existentes
async function getPosts() {
  try {
    const response = await fetch(githubApiUrl, {
      headers: {
        Authorization: `token ${token}`,
      },
    });

    if (!response.ok) {
      throw new Error(`Error fetching posts: ${response.status} ${response.statusText}`);
    }

    const files = await response.json();
    const postsDiv = document.getElementById('posts');
    postsDiv.innerHTML = ''; // Limpa antes de carregar os posts

    for (const file of files) {
      const postResponse = await fetch(file.download_url);
      if (!postResponse.ok) {
        throw new Error(`Error fetching post: ${postResponse.status} ${postResponse.statusText}`);
      }
      const post = await postResponse.json();

      const postDiv = document.createElement('div');
      postDiv.innerHTML = `<h3>${post.title}</h3><p>${post.body}</p>`;
      postsDiv.appendChild(postDiv);
    }
  } catch (error) {
    console.error(error);
    alert('Erro ao carregar posts. Verifique o console para mais detalhes.');
  }
}

// Função para enviar um novo post
async function submitPost() {
  const title = document.getElementById('postTitle').value;
  const body = document.getElementById('postContent').value;

  const newPost = {
    title,
    body,
  };

  const fileName = `post-${Date.now()}.json`;
  const fileContent = btoa(JSON.stringify(newPost)); // Codifica o post para base64

  try {
    const response = await fetch(`${githubApiUrl}/${fileName}`, {
      method: 'PUT',
      headers: {
        Authorization: `token ${token}`,
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        message: `Novo post: ${title}`,
        content: fileContent,
      }),
    });

    if (!response.ok) {
      throw new Error(`Error creating post: ${response.status} ${response.statusText}`);
    }

    alert('Post criado com sucesso!');
    closeModal();
    getPosts();
  } catch (error) {
    console.error(error);
    alert('Erro ao criar post. Verifique o console para mais detalhes.');
  }
}

// Funções para controlar o modal de novo post
document.getElementById('newPostBtn').addEventListener('click', function() {
  document.getElementById('newPostModal').style.display = 'block';
});

function closeModal() {
  document.getElementById('newPostModal').style.display = 'none';
}

// Carrega os posts ao iniciar a página
getPosts();
