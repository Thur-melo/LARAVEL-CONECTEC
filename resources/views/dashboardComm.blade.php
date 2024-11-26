<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="{{url('assets/css/salvos.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/nav.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/postagens.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/modalEditPost.css')}}">


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Conectec</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontisto/3.0.1/css/fontisto/fontisto.min.css" integrity="sha512-OCX+kEmTPN1oyWnFzjD7g/7SLd9urTeI/VUZR6nZFFN7sedDoBSaSv/FDvCF8hf1jvadHsp0y0kie9Zdm899YA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    @include('partials.navbar')
   

    <main>
        <div class="container">
            <div class="left">
                <div class="sidebar">
                    <div class="sidebarList">

                        <a href="{{ Route('home')}}" class="menu-item ">
                            <span><i class="fa-solid fa-house"></i></span>
                            <h3>Home</h3>
                        </a>

                        <a class="menu-item " href="{{ Route('explorar')}}">
                            <span><i class="fa-regular fa-compass"></i></span>
                            <h3>Explorar</h3>
                        </a>

                        <a class="menu-item" href="{{ Route('notificacoes.index')}}">
                            <span><i class="fa-regular fa-bell"></i></span>
                            <h3>Notificações</h3>
                            @if($naoLidasCount > 0)
                            <span class="badge rounded-pill text-bg-danger">{{$naoLidasCount}}</span>
                            @endif
                        </a>

                        <a href="{{ Route('postagens')}}" class="menu-item active">
                            <span><i class="fa-regular fa-images"></i></span>
                            <h3>Postagens</h3>
                        </a>
                        <a class="menu-item " href="{{Route('chat.list')}}">
                            <span><i class="fa-regular fa-message"></i></span>
                            <h3>Chat</h3>
                        </a>

                        <a class="menu-item " href="{{ Route('home')}}">
                            <span><i class="fa-regular fa-square-plus"></i></i></span>
                            <h3>Criar</h3>
                        </a>



                    </div>

                    <a href="{{ route('profile', ['id' => $user->id]) }}" class="menu-item">
                        <div class="imgPerfilSide">
                            <img src="{{ asset('storage/' . $user->urlDaFoto) }}" alt="">
                            <div class="sidePerfilNames">
                                <h3>{{$user->name }}</h3>
                                <span class="arrobaSide">{{ '@'. $user->arroba}}</span>
                            </div>
                        </div>
                    </a>


                </div>
            </div>



            <!-------------------------------------------  Minhas perguntas -------------------------------------------------------------------------------------->

            <div class="meio">
                <div class="cardsCont">
                    <a  class="cardsPosta "  href="{{ Route('postagens')}}">
                        <div class="cardPosta">
                            <h2>{{$postsCount}}</h2>
                            <span>Postangens</span>
                        </div>
                        <i class="fa-regular fa-images"></i>
</a>

                    <div class="cardsPosta active2">
                        <div class="cardPosta">
                            <h2>{{$numComentarios}}</h2>
                            <span>Comentarios</span>
                        </div>
                        <i class="fa-regular fa-comment"></i>
                    </div>


            <div  class="cardsPosta" >
                    
                        <div class="cardPosta">
                            <h2>{{$qntSalvos}}</h2>
                            <span>Salvos</span>
                        </div>
                        <i class="fa-regular fa-bookmark"></i>
                    {{-- </div> --}}
                </div>

                </div>




                 
                @include('partials.modalsair')


                <div id="resultado" class="resultado">
                <div class="containerTabela">
                    <h2>Meus Comentários</h2>

    

                    <div class="headerTabela">
                        <div>Data de Publicação</div>
                        <div> Conteúdo</div>
                        <div>Imagem do post</div>
                        <div>Comentário</div>
                        <div>Operações</div>
                    </div>

                    @foreach($comentarios as $comm)
                    <div class="question-row">
                        <div>{{ $comm->created_at->diffForHumans() }}</div>
                        <div class="content-preview">{{$comm->post->texto}}</div>
                        <div>
                            <div class="statusPost">
                              
                                    <div class="imagemLittle">
                                    <a href="{{ asset('storage/' .  $comm->post->fotoPost) }}" data-lightbox="gallery" data-title="Descrição da imagem">
                                        <img src="{{ asset('storage/' . $comm->post->fotoPost) }}" style=" height: 50px; width: 100px;
" >
                                        </a>



                                </div>
                            </div>

                        </div>

                        <div class="conteudoPost"> {{ $comm->texto}}</div>
                        <div class="icons">

                            
                        <form id="deleteForm-{{ $comm->id }}" action="{{ route('comentarios.destroy', $comm->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-button" data-post-id="{{ $comm->id }}" data-type="comment">
                                    <i class="fa-regular fa-trash-can"></i> <!-- Ícone de lixeira -->
                                </button>
                            </form>
                            



                            <a href="{{ route('comentarios', $comm->post->id) }}">
                                <i class="fa-regular fa-eye"></i>
                            </a>

                            {{-- <i class="fa-regular fa-pen-to-square edit-button" data-bs-toggle="modal" data-bs-target="#postModal2" data-id="{{ $post->id }}" data-post="{{ $post->texto }}" data-hora="{{ $post->created_at->diffForHumans() }}" @if(!empty($post->fotoPost))
                                data-image="{{ asset('storage/' . $post->fotoPost) }}"
                                @endif"></i>  --}}

                        </div>

                    </div>
                    @endforeach
                </div>
                </div>

    </main>


    @include('partials.modalEditarPost ')
    @include('partials.modalMostrarPost ')

    <script>
        //-----------------------------------------Modal de confirmção do DELETE------------------------------------------------------------------


        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.getAttribute('data-post-id');
                const deleteForm = document.getElementById(`deleteForm-${postId}`);

                Swal.fire({
                    title: "Voçê tem certeza que quer deletar esse post?",
                    text: "",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#07beff",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Deletar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submete o formulário de exclusão
                        deleteForm.submit();

                        Swal.fire({
                            title: "Excluido!",
                            text: "Seus post foi excluido com sucesso!",
                            icon: "success",
                            confirmButtonColor: "#07beff",
                        });
                    }
                });
            });
        });

    
        // -----------------------------------------Modal de confirmção do DELETE------------------------------------------------------------------
    </script>



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

        @if(session('showModal'))
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();
        });
        @endif
    </script>


    <!-- Script para os MODAIS LEGAIS tmnc bootrape -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Script para os MODAIS LEGAIS tmnc bootrape -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    
</body>

</html>