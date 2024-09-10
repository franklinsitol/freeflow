const githubApiUrl = 'https://api.github.com/repos/franklinsitol/freeflow/contents/posts/posts.json';
const token = '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'; // Novo token de acesso pessoal

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

    const file = await response.json();
    const postResponse = await fetch(atob(file.content)); // Decodifica o conteúdo Base64

    if (!postResponse.ok) {
      throw new Error(`Error fetching post: ${postResponse.status} ${postResponse.statusText}`);
    }

    const posts = await postResponse.json();
    const postsDiv = document.getElementById('posts');
    postsDiv.innerHTML = ''; // Limpa antes de carregar os posts

    for (const post of posts) {
      const postDiv = document.createElement('div');
      postDiv.innerHTML = `<h3>${post.title}</h3><p>${post.body}</p>`;
      postsDiv.appendChild(postDiv);
    }
  } catch (error) {
    console.error(error);
    alert('Erro ao carregar posts. Verifique o console para mais detalhes.');
  }
}

getPosts();
