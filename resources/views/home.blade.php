<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{url('assets/css/home.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/nav.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/modalDenunciaPost.css')}}">



    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Conectec</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/fontisto/3.0.1/css/fontisto/fontisto.min.css" integrity="sha512-OCX+kEmTPN1oyWnFzjD7g/7SLd9urTeI/VUZR6nZFFN7sedDoBSaSv/FDvCF8hf1jvadHsp0y0kie9Zdm899YA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>




<body>

    @include('partials.navbar')

    <!-------------------------------------------  NavAbar -------------------------------------------------------------------------------------->

    <main>
        <div class="container">
            <div class="left">
                <div class="sidebar">
                    <div class="sidebarList">

                        <a href="{{ Route('home')}}" class="menu-item active">
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
                            <span>{{ $naoLidasCount }}</span>
                            @endif
                        </a>

                        <a href="{{ Route('postagens')}}" class="menu-item">
                            <span><i class="fa-regular fa-images"></i></span>
                            <h3>Postagens</h3>
                        </a>
                        <a class="menu-item " href="{{Route('chat.list')}}">
                            <span><i class="fa-regular fa-message"></i></span>
                            <h3>Chat</h3>
                        </a>

                        <a class="menu-item " data-bs-toggle="modal" data-bs-target="#modalPost">
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



            <!-------------------------------------------  Posts -------------------------------------------------------------------------------------->

            <div class="meio">
                <!-- Formulário de criar post -->
                @if($users->isEmpty())
                <form class="criarPost">
                    <div class="profileImgPost">
                        <img src="{{ asset('storage/' . $user->urlDaFoto) }}" alt="">
                    </div>
                    <input type="text" placeholder="Faça uma pergunta" id="create-post" data-bs-toggle="modal" data-bs-target="#modalPost">
                    <button type="button" class="postarBotao" data-bs-toggle="modal" data-bs-target="#modalPost"> Publicar
                    </button>
                </form>
                <!-- Fim do formulário de criar post -->


                <div>
                    <!-- Resultados de usuários -->
                   
                    @else
                    <div>
                    <div class="userSearch">
                        <h3>Usuários</h3>
                        @foreach ($users as $user)
                        <div class="usersLista">
                            <div class="usersImg">
                                <a href="{{ route('perfil', ['id' => $user->id]) }}"> <img src="{{ asset('storage/' . $user->urlDaFoto) }}" alt="" class="perfilPostImg"> </a>
                            </div>
                            <div class="info">
                                <h3>{{ $user->name }}</h3>

                                <p>{{ "@". $user->arroba}} </p>
                            </div>
                            <div class="btnSeguirCont">
                                <button class="follow-btn"
                                    data-user-id="{{ $user->id }}"
                                    data-action="{{ Auth::user()->seguindo()->where('seguindo_id', $user->id)->exists() ? 'unfollow' : 'follow' }}">
                                    {{ Auth::user()->seguindo()->where('seguindo_id', $user->id)->exists() ? 'Seguindo' : 'Seguir' }}
                                </button>

                            </div>


                        </div>

                        @endforeach
                        <!-- Link para ver todos os usuários com a busca -->
                        <a href="{{ route('buscar.usuarios', ['s' => request('s')]) }}">
                            <h6>Ver todos</h6>
                        </a>
                    </div>
                    @endif

                </div>
                <!-- Loop de postagens -->
                @foreach($posts as $post)

                @php
                $coresModulo = [
                '1º' => '#CD4642',
                '2º' => '#5169B1',
                '3º' => '#64B467',
                ];
                @endphp

                <div class="feeds">
                    <div class="feed">
                        <!-- Seção de informações do usuário -->
                        <div class="user">
                            <div class="profileImg">
                                @if(isset($post->user->id)) <a href="{{ route('perfil', ['id' => $post->user->id]) }}"> <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="" class="perfilPostImg"> </a> @else {{ dd($post->user) }} @endif


                            </div>
                            <div class="info">
                                <div class="infoHeader" style="display:flex; align-items:center; justify-content:space-between; width:100%">
                                    <h3>{{ '@' . $post->user->arroba }} <span class="publiSpan"> • fez uma nova publicação</span></h3>

                                    <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                        <p>{{ $post->user->modulo }} {{ $post->user->perfil }} </p>
                                    </div>
                                </div>
                                <p class="horaPost">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <!-- Fim da seção de informações do usuário -->

                        <!-- Tipo de post -->
                        <!-- <div class="tipoCont">
                <div class="tipo-div">
                    <p>{{ $post->tipo_post }}</p>
                </div>
            </div>  -->
                        <!-- Fim do tipo de post -->

                        <!-- Texto do post -->
                        <div class="textoPost">
                            {{ $post->texto }}


                        </div>
                        <!-- Fim do texto do post -->

                        <!-- Imagem do post -->
                        <div class="imgPost">
                            <a href="{{ asset('storage/' . $post->fotoPost) }}" data-lightbox="gallery" data-title="Descrição da imagem">
                                <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="" style="max-width: 100%; height: auto;">
                            </a>
                        </div>
                        <!-- Fim da imagem do post -->

                        <!-- Botões de ação (Curtir, Comentar, Salvar) -->
                        <div class="action-button">
                            <div class="interaction-button">
                                <span class="like-btn @if($post->likes()->where('user_id', Auth::id())->exists()) liked @endif" data-post-id="{{ $post->id }}">
                                    @if($post->likes()->where('user_id', Auth::id())->exists())
                                    <i class="fas fa-heart liked"></i>
                                    @else
                                    <i class="far fa-heart"></i>
                                    @endif
                                </span>
                                <span class="likes-count">{{ $post->likes()->count() }}</span>

                                <a href="{{ route('comentarios', $post->id) }}">
                                    <button class="comentarioCotn">
                                        <i class="uil uil-comment"></i>
                                    </button>
                                </a>
                            </div>

                            <div class="icons-group">
                                <div class="bookmark">
                                    <span><i class="uil uil-bookmark"></i></span>
                                </div>


                                {{-- aqui --}}


                                <!-- Link que abre o modal -->
                                <a class="iconDenuncia" href="javascript:void(0);" onclick="openModal({{ $post->id }})">
                                    <span class="material-symbols-outlined">
                                        emergency_home
                                        </span>
                                </a>
                            </div>

                            <!-- Modal -->
                            <div id="modal-denuncia" class="modal" style="display: none;">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal()">&times;</span>
                                    <h2>Denunciar Post</h2>
                                    <p>Deseja realmente denunciar o post de ID {{ '@' . $user->arroba }}?</p> 
                                    <input type="text" id="motivo" placeholder="Motivo da denúncia">
                                    <div class="modal-footer">
                                        <button class="btn btn-danger" onclick="closeModal()">Cancelar</button>
                                        <button class="postarBotao" onclick="confirmarDenuncia()">Confirmar</button>
                                    </div>
                                    <input type="hidden" id="user-id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" id="post-id" value="{{ $post->id }}">

                                </div>
                            </div>

                            <!-- Estilos para o modal -->
                           

                            <!-- Scripts para abrir e fechar o modal -->
                            <script>
                                function openModal(postId) {
                                    document.getElementById('modal-denuncia').style.display = 'flex';
                                }

                                function closeModal() {
                                    document.getElementById('modal-denuncia').style.display = 'none';
                                }

                                function confirmarDenuncia() {
                                    const userId = document.getElementById('user-id').value; // ID do usuário que fez a denúncia
                                    const postId = document.getElementById('post-id').value; // ID do post denunciado
                                    const motivo = document.getElementById('motivo').value; // Motivo da denúncia

                                    fetch("{{ route('denunciar') }}", {
                                            method: "POST",
                                            headers: {
                                                "Content-Type": "application/json",
                                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                            },
                                            body: JSON.stringify({
                                                user_id: userId,
                                                post_id: postId,
                                                motivo: motivo
                                            })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            alert(data.message); // Exibe a mensagem de sucesso
                                            closeModal(); // Fecha o modal
                                        })
                                        .catch(error => {
                                            console.error("Erro:", error);
                                            alert("Ocorreu um erro ao registrar a denúncia.");
                                        });
                                }
                            </script>


                            {{-- aqui --}}
                        </div>
                        <!-- Fim dos botões de ação -->
                    </div>
                </div>
                @endforeach
                <!-- Fim do loop de postagens -->

            </div>
            
            @include ('partials.emAlta')
                                


            <div class="amigosCont">
                <div class="amigosHeader">
                    <h2>Sugestões</h2>

                </div>

                <div class="listaSuges">
                    @foreach($usuariosSugestoes as $usuariosSuge)
                    <div class="sugestoes">

                        <div class="infoUserCont">
                            <div class="profileImgSuge" href="{{ route('perfil', ['id' => $usuariosSuge->id]) }}">
                                <img src="{{ asset('storage/' . $usuariosSuge->urlDaFoto) }}" alt="">
                            </div>

                            <div class="inforUserSuge" href="{{ route('perfil', ['id' => $usuariosSuge->id]) }}">
                                <span>{{ $usuariosSuge->name }}</span>
                                <span>{{ $usuariosSuge->modulo }} {{ $usuariosSuge->perfil }}</span>
                            </div>
                        </div>

                        <div class="btnSeguirCont">
                            <button class="follow-btn"
                                data-user-id="{{ $usuariosSuge->id }}"
                                data-action="{{ Auth::user()->seguindo()->where('seguindo_id', $usuariosSuge->id)->exists() ? 'unfollow' : 'follow' }}">
                                {{ Auth::user()->seguindo()->where('seguindo_id', $usuariosSuge->id)->exists() ? 'Seguindo' : 'Seguir' }}
                            </button>

                        </div>

                    </div>

                    @endforeach
                </div>


            </div>
        </div>


    </main>


    @include('partials.modalsair')



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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('status'))
    <script>
        Swal.fire({
            title: "Sucesso!",
            text: "{{ session('status') }}",
            icon: "success",
            confirmButtonText: "Ok",
            confirmButtonColor: "#07beff"
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            title: "Erro",
            text: "{{ session('error') }}",
            icon: "error",
            confirmButtonText: "Ok"
        });
    </script>
    @endif



    <!-- Modal de Confirmação -->



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


    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="{{ asset('js/like.js') }}"></script>
    <script src="{{ asset('js/seguir.js') }}"></script>
</body>

</html>