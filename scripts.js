// scripts.js
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { getFirestore, collection, addDoc, getDocs, onSnapshot } from "firebase/firestore";

// Configuração do Firebase
const firebaseConfig = {
  apiKey: "AIzaSyAkvcWKEOSxy5ONnRhjFWunoHGb_hcxdms",
  authDomain: "freeflow-17f32.firebaseapp.com",
  projectId: "freeflow-17f32",
  storageBucket: "freeflow-17f32.appspot.com",
  messagingSenderId: "408661719473",
  appId: "1:408661719473:web:48aaefb4f9aec6c0d22590",
  measurementId: "G-FBX0JHGS47"
};

// Inicialize o Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const db = getFirestore(app);

// Referência à coleção de posts
const postsCollection = collection(db, "posts");

// Função para carregar posts
async function loadPosts() {
  const postsSnapshot = await getDocs(postsCollection);
  const postsContainer = document.getElementById('feed');
  postsContainer.innerHTML = ''; // Limpar o feed

  postsSnapshot.forEach((doc) => {
    const post = doc.data();
    const postElement = document.createElement('div');
    postElement.classList.add('post');
    postElement.innerHTML = `
      <div class="post-content">${post.content}</div>
      ${post.image ? `<img src="${post.image}" class="post-image" />` : ''}
      <div class="countdown">${post.countdown || ''}</div>
      <div class="actions">
        <button class="like-button">Curtir</button>
        <button class="comment-button">Comentar</button>
        <button class="move-to-top">Mover para o topo</button>
      </div>
    `;
    postsContainer.appendChild(postElement);
  });
}

// Função para adicionar um novo post
document.getElementById('submit-post').addEventListener('click', async () => {
  const postContent = document.getElementById('post-input').value;
  const postImage = document.getElementById('preview-image').src;

  if (postContent) {
    try {
      await addDoc(postsCollection, {
        content: postContent,
        image: postImage,
        countdown: '24 horas restantes' // Ajuste conforme necessário
      });
      document.getElementById('post-input').value = '';
      document.getElementById('preview-image').src = '';
      loadPosts();
    } catch (e) {
      console.error('Erro ao adicionar o post: ', e);
    }
  }
});

// Função para exibir o modal de comentários
document.querySelectorAll('.comment-button').forEach(button => {
  button.addEventListener('click', () => {
    document.getElementById('comment-modal').style.display = 'flex';
  });
});

// Fechar o modal de comentários
document.getElementById('close-modal').addEventListener('click', () => {
  document.getElementById('comment-modal').style.display = 'none';
});

// Carregar posts ao iniciar
loadPosts();

