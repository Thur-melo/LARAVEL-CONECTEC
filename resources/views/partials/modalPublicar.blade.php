

<div class="modal" tabindex="-1" id="modalPost">
        <form action="{{ route('home')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Criar uma nova publicação</h4>
                    </div>
                    <div class="modal-body">

                        <!-- <div class="publicarInput">
                            <h5 lass="modal-title">Título da publicação</h5>
                            <p> Para postagem ser enviada são necessário pelo menos 10 caracteres. </p>
                            <input type="text" class="form-control" name="texto" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                            </div> -->

                        <div class="publicarInput">
                            <h5 class="modal-title" style="font-weight:600">Descrição da publicação</h5>
                            <p style="font-weight:500; color:#AFAFAF; font-size:10pt"> Para postagem ser enviada são necessário pelo menos 10 caracteres. </p>
                            <textarea class="form-control" aria-label="With textarea" name="texto" placeholder="Faça sua pergunta aqui..." required></textarea>
                        </div>
                        <div class="publicarInput" style="margin-top:10px">
                            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="fotoPost" accept="image/*" onchange="previewImage(event)">
                        </div>

                        <select class="form-select" style="margin-top:10px" aria-label="Default select example" name="tipo">
                            <option value="Duvida">Dúvida</option>
                            <option value="Aula">Aula</option>
                            <option value="Informacao">Informação</option>
                            <option value="Estagio">Estágio</option>
                        </select>
                        <div class="previewModal">
                            <img id="imagePreview" src="" alt="Prévia da Imagem" style="display: none;">
                        </div>
                    </div>




                    <div class="modal-footer" id="mf">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="postarBotao">Publicar</button>
                    </div>
                </div>
        </form>
    </div>