document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.like-btn').forEach(function(button) {
        button.addEventListener('click', function(event) {
            const clickedButton = this;
            console.log("Botão clicado:", clickedButton);
            const id = clickedButton.getAttribute('data-post-id');
            let likeCountSpan = null;

            console.log("ID do post:", id);

            let sibling = clickedButton.nextElementSibling;
            while (sibling) {
                if (sibling.classList && sibling.classList.contains('likes-count')) {
                    likeCountSpan = sibling;
                    break;
                }
                sibling = sibling.nextElementSibling;
            }

            console.log("Elemento likes-count:", likeCountSpan);

            if (!id) {
                console.error('Post ID não encontrado!');
                return;
            }

            if (!likeCountSpan) {
                console.error('Span de contagem de likes não encontrado!');
                return;
            }

            fetch(`/posts/${id}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro na resposta da rede.');
                }
                return response.json();
            })
            .then(data => {
                console.log("Resposta da API:", data);
                const icon = clickedButton.querySelector('i');
                likeCountSpan.textContent = data.likesCount;
                if (data.status === 'liked') {
                    clickedButton.classList.add('liked');
                
                    icon.classList.remove('far'); // Remove o estilo do ícone não preenchido
                    icon.classList.add('fas');
                } else {
                    clickedButton.classList.remove('liked');
                    
                    icon.classList.remove('fas'); // Remove o estilo do ícone não preenchido
                    icon.classList.add('far');
                }
            })
            .catch(error => console.error('Erro:', error));
        });
    });
});


