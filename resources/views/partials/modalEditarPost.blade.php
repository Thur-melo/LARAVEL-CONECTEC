<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <style>
        #postImage {
            width: 100%;
            max-width: auto;
            max-height: 650px;
            height: 100%;
            object-fit: contain;
        }

        .modal-dialog {
            max-width: 40%;
            width: auto;
            /* Define a largura que você preferir */

        }

        .modal-body {
            background-color: #ffffff;
        }

        .modal.show .modal-dialog {
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .modal-header {
            background-color: white;
            color: #3f3950;

        }

        .modal-header h5 {
            font-weight: 600;
            font-size: 17pt;
        }

        .voce {
            color: #3f3950;

        }

        .horasPost {
            margin-top: 1%
        }

        #fez {
            color: gray;
        }

        .titleConteudo {
            margin-top: 2%;
            color: #07beff;
        }

        .titleConteudo h2 {
            font-weight: 600;
            font-size: 15pt
        }

        .imgPost {
            margin-top: 2%;
            border-bottom: 1px solid #bebebe
        }

        .imgPost img {
            border-radius: 0.4rem;
        }

        .iconsInt {
            background-color: pink;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            padding: 8px 10px;
            border-radius: 25px;
        }

        .iconsInt {
            color: white;
        }

        .like {
            background-color: #e75a47;
        }

        .coment {
            background-color: #5482e6;
        }

        .salvos {
            background-color: #eed364;
        }

        .headerModal {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .iconsCont {
            width: 55%;
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-top: 2%;

        }
    </style>
    <div class="modal fade" id="postModal2" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="headerModal">
                        <h5 class="modal-title" id="postModalLabel">Editar Postagem</h5>
                        <div class="horasPost">
                            <span class="voce">Você </span><span id="fez">pode editar o conteúdo públicado </span><span class="voce" id="postHora"></span>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('post.update', ['postID' => ':postID']) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="postID" name="postID"> <!-- Campo oculto que vai armazenar o ID do post -->
                    <div class="modal-body">
                        <!-- Conteúdo do post -->
                        <input type="text" id="postContent" name="texto" class="form-control">

                        <!-- Imagem do post -->
                        <img id="postImage" src="" alt="Imagem do post" style="display: none;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar alterações</button>
                    </div>
                </form>


            </div>
        </div>
        <script>
            var postModal2 = document.getElementById('postModal2');
            postModal2.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // O botão que acionou o modal
                var postContent = button.getAttribute('data-post');
                var postImage = button.getAttribute('data-image');
                var postHora = button.getAttribute('data-hora');
                var postID = button.getAttribute('data-id'); // Capturando o ID do post

                var modalContent = postModal2.querySelector('#postContent');
                var modalImage = postModal2.querySelector('#postImage');
                var modalHora = postModal2.querySelector('#postHora');
                var modalID = postModal2.querySelector('#postID'); // Agora você tem o ID do post

                // Preenchendo o conteúdo do modal
                modalContent.value = postContent;
                modalHora.textContent = postHora;

                // Exibindo a imagem, se existir
                if (postImage) {
                    modalImage.src = postImage;
                    modalImage.style.display = 'block';
                } else {
                    modalImage.style.display = 'none';
                }

                // Definindo o valor do campo oculto postID
                modalID.value = postID;

                // Atualiza a URL da ação do formulário para incluir o postID correto
                var form = postModal2.querySelector('form');
                form.action = form.action.replace(':postID', postID);
            });
        </script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</body>

</html>