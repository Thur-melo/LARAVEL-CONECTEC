document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.salvo-btn').forEach(function(button) {
        button.addEventListener('click', function(event) {
            const clickedButton = this;
            console.log("Botão clicado:", clickedButton);
            const id = clickedButton.getAttribute('data-post-id');
            let likeCountSpan = null;

            console.log("ID do post:", id);

            let sibling = clickedButton.nextElementSibling;
            while (sibling) {
                if (sibling.classList && sibling.classList.contains('salvos-count')) {
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

           

            fetch(`/posts/${id}/salvo`, {
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
                
                if (data.status === 'salved') {
                    clickedButton.classList.add('salvo');
                
                    icon.classList.remove('far'); // Remove o estilo do ícone não preenchido
                    icon.classList.add('fas');
                } else {
                    clickedButton.classList.remove('salvo');
                    
                    icon.classList.remove('fas'); // Remove o estilo do ícone não preenchido
                    icon.classList.add('far');
                }
            })
            .catch(error => console.error('Erro:', error));
        });
    });
});


