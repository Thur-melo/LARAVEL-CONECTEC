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
#postImage{
    width: 100%;
    max-width:auto;
    max-height: 650px;
    height:100%;  
    object-fit:contain;
}
.modal-dialog {
    max-width: 40%;
    width: auto; /* Define a largura que você preferir */
    
}
.modal-body{
    background-color:#ffffff;
}
.modal.show .modal-dialog {
    display: flex;
    align-items: center;
    justify-content: center;
   
}
.modal-header{
    background-color: white;
    color: #3f3950;
   
}
.modal-header h5{
    font-weight:600;
    font-size:17pt;
}
.voce{
    color:#3f3950;
    
}
.horasPost{
    margin-top:1%
    
}
#fez{
    color:gray;
}
.titleConteudo{
    margin-top:2%;
    color:#07beff;
}
.titleConteudo h2{
    font-weight:600;
    font-size:15pt
}
.imgPost{
    margin-top:2%;
    border-bottom: 1px solid #bebebe
}
.imgPost img{
    border-radius:0.4rem;
}
.iconsInt{
    background-color:pink;
    display:flex;
    align-items: center;
    justify-content: center;
    gap:5px;
    padding:8px 10px;
    border-radius:25px;
}
.iconsInt{
    color:white;
}
.like{
    background-color:#e75a47;
}
.coment{
    background-color:#5482e6;
}
.salvos{
    background-color:#eed364;
}
.headerModal{
    display: flex;
    flex-direction:column;
    justify-content:flex-start;
}
.iconsCont{
    width: 55%;
    display:flex;
    align-items: center;
    justify-content: space-between;
    
    margin-top:2%;
    
}
</style>
<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="headerModal">
                    <h5 class="modal-title" id="postModalLabel">Visualizar Postagem</h5>
                    <div class="horasPost">
                        <span class="voce">Você </span><span id="fez">fez esse post: </span><span class="voce" id="postHora"></span>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Área para exibir imagem e texto do post -->
                
                 <div class="titleConteudo">
                    <h2>Conteudo</h2>
                 </div>
                 <div class="conteudo">
                    <span id="postContent"></span>
                 </div>
                 @if(!empty($post->fotoPost))
                 <div class="imgPost">
                 
                    <img id="postImage" alt="">
                   
                 </div>
                 @endif
                 <div class="interacoesCont">
                    <div class="titleConteudo">
                        <h2>Interações</h2>
                    </div>
                    <div class="iconsCont">
                        <div class="iconsInt like">
                             <i class="fas fa-heart"></i><span>curtidas 10</span>
                        </div>
                        <div class="iconsInt coment">
                            <i class="fa-solid fa-comment"></i><span>comentários 10</span>
                        </div>
                        <div class="iconsInt salvos">
                            <i class="fa-solid fa-bookmark"></i><span>salvos 10</span>
                        </div>
                    </div>
                 </div>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
  
    // Evento para preencher o modal com dados do post quando ele for exibido
    var postModal = document.getElementById('postModal');
postModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var postContent = button.getAttribute('data-post');
    var postImage = button.getAttribute('data-image');
    var postHora = button.getAttribute('data-hora');
    var modalContent = postModal.querySelector('#postContent');
    var modalImage = postModal.querySelector('#postImage');
    var modalHora = postModal.querySelector('#postHora');
    modalContent.textContent = postContent;
    modalHora.textContent = postHora;
    // Verifica se há uma imagem; se não houver, esconde o elemento de imagem
    if (postImage) {
        modalImage.src = postImage;
        modalImage.style.display = 'block';
    } else {
        modalImage.style.display = 'none';
    }
});
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</body>
</html>