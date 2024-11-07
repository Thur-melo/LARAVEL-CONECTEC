<!-- Modal -->
<div class="modal fade custom-modal" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;"> <!-- Ajuste a largura conforme necessário -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Editar Perfil - {{"@$user->arroba"}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <link rel="stylesheet" href="{{url('assets/css/modalEditarPerfil.css')}}">

                <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data" id="formPerfil">
                    @csrf
                    <div class="fundo">
                        <img src="{{ asset('storage/' . $user->urlDoBanner) }}" class="banner" id="bannerPreview"  alt="Prévia do Banner">
                    </div>
                    <div class="imgsEbtns">

                        <img src="{{ asset('storage/' . $user->urlDaFoto) }}" class="profileImg" id="imagePreview" alt="Prévia da Imagem">

                        <label for="urlDoBanner" id="btnEditBanner" class="btnModalEdit">
                            <span class="material-symbols-outlined">
                                add_a_photo
                            </span> </label>
                            <input type="file" id="urlDoBanner" name="urlDoBanner" accept="image/*" onchange="previewBanner(event)" style="display: none;">

                            
                        <label for="urlDaFoto" id="btnEditIcon" class="btnModalEdit"><span class="material-symbols-outlined">
                                add_a_photo
                            </span></label>
                        <input type="file" id="urlDaFoto" name="urlDaFoto" accept="image/*" onchange="previewImage(event)" style="display: none;">
                    </div>

                    <div class="imgContainerEdit">

                        <div class="inputsCont">

                            <div class="inputsGrupos">
                                <div class="inputForm" id="InputLeft">
                                    <label for="Nome">
                                        Nome
                                    </label>
                                    <div class="inputText">
                                        <input type="text" id="nome" name="name" class="form-control" value="{{ $user->name }}" required>
                                    </div>
                                </div>
                                <div class="inputForm" id="InputRight">
                                    <label for="Modulo">
                                        Modulo
                                    </label>
                                    <div class="inputText">
                                        <input class="form-control" id="disabledInput" type="text" value="{{ $user->modulo}}" disabled>
                                    </div>
                                </div>


                            </div>


                            <div class="linha">
                                <div class="bioForm">
                                    <label for="Bio">
                                        Bio
                                    </label>
                                    <textarea name="bio" id="bio" cols="50" rows="4" placeholder="bio">{{ $user->bio }}</textarea>
                                </div>
                            </div>



                            <div class="inputsGrupos">


                                <div class="inputForm" id="InputLeft">
                                    <label for="senha">
                                        Email
                                    </label>
                                    <div class="inputText">
                                        <input class="form-control" id="disabledInput" type="text" value="{{ $user->email }}" disabled>
                                    </div>
                                </div>

                                <div class="inputForm" id="InputRight">
                                    <label for="Perfil">
                                        Perfil
                                    </label>
                                    <div class="inputText">
                                        <input class="form-control" id="disabledInput" type="text" value="{{ $user->perfil }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" id="saveProfile">Salvar mudanças</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        var image = document.getElementById('imagePreview');
        var file = event.target.files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                image.src = e.target.result;
                image.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    }

    function previewBanner(event) {
        var image = document.getElementById('bannerPreview');
        var file = event.target.files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                image.src = e.target.result;
                image.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    }
</script>