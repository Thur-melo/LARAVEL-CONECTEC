document.getElementById('createPostForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    const formData = new FormData(this);

    fetch('{{ route("posts.store") }}', { // URL da rota
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Fecha o modal após o envio
            const modalElement = document.getElementById('modalPost');
            if (modalElement) {
                let modalInstance = bootstrap.Modal.getInstance(modalElement);
                modalInstance.hide();
            }

            // Exibe o SweetAlert de confirmação
            Swal.fire({
                title: "Post publicado!",
                text: data.message,
                icon: "success",
                confirmButtonText: "Ok"
            });

            // Limpa o formulário
            document.getElementById('createPostForm').reset();
            document.getElementById('imagePreview').style.display = 'none';
        } else {
            // Exibe erro caso a resposta não seja bem-sucedida
            Swal.fire({
                title: "Erro",
                text: data.error || "Houve um problema ao publicar seu post.",
                icon: "error",
                confirmButtonText: "Ok"
            });
        }
    })
    .catch(error => {
        console.error("Erro:", error);
        Swal.fire({
            title: "Erro",
            text: "Houve um problema ao publicar seu post.",
            icon: "error",
            confirmButtonText: "Ok"
        });
    });
});
