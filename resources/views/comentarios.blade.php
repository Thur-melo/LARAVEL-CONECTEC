<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{url('assets/css/nav.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/comentarios.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Comentarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css" />
    <link rel="stylesheet" href="{{url('assets/css/modalDenunciaPost.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

                        <a href="{{ Route('postagens')}}" class="menu-item">
                            <span><i class="fa-regular fa-images"></i></span>
                            <h3>Postagens</h3>
                        </a>
                        <a class="menu-item " href="{{Route('chat.list')}}">
                            <span><i class="fa-regular fa-message"></i></span>
                            <h3>Chat</h3>
                        </a>

                        <a class="menu-item "  href="{{ Route('home')}}">
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


            @php
            $coresModulo = [
            '1º' => '#CD4642',
            '2º' => '#5169B1',
            '3º' => '#64B467',
        ];
            @endphp



            <div class="meio">
    <!-- Início da estrutura de feeds -->
    <div class="feeds">
        <!-- Início do feed individual -->
        <div class="feed">

            <!-- Início da seção de usuário -->
            <div class="user">
                <!-- Início da imagem de perfil do usuário -->
                <div class="profileImg">
                    <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="">
                </div>
                <!-- Fim da imagem de perfil do usuário -->

                <!-- Início das informações do usuário -->
                <div class="info">
                    <!-- Início do cabeçalho das informações -->
                    <div class="infoHeader" style="display:flex; align-items:center; justify-content:space-between; width:100%">
                        <h3>{{ '@' . $post->user->arroba }} <span class="publiSpan"> • fez uma nova publicação</span></h3>

                        <!-- Início da div do módulo do usuário -->
                        <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                            <p>{{ $post->user->modulo }} {{ $post->user->perfil }}</p>
                        </div>
                        <!-- Fim da div do módulo do usuário -->
                    </div>
                    <!-- Fim do cabeçalho das informações -->

                    <p class="horaPost">{{ $post->created_at->diffForHumans() }}</p>
                </div>
                <!-- Fim das informações do usuário -->
            </div>
            <!-- Fim da seção de usuário -->

       
            <!-- Fim da div do tipo de conteúdo -->

            <!-- Início da div de texto do post -->
            <div class="textoPost">
                {{ $post->texto }}
            </div>
            <!-- Fim da div de texto do post -->

            <!-- Início da div de imagem do post -->
            <div class="imgPost">
                <a href="{{ asset('storage/' . $post->fotoPost) }}" data-lightbox="gallery" data-title="Descrição da imagem">
                    <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="" style="max-width: 100%; height: auto;">
                </a>
            </div>
            <!-- Fim da div de imagem do post -->

            <!-- Início dos botões de ação -->
            <div class="action-button">
                <!-- Início dos botões de interação -->
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
                <!-- Fim dos botões de interação -->


                <!-- Início do botão de salvar -->
               <div class="icons-group">
                                <span class="salvo-btn @if($post->salvos()->where('user_id', Auth::id())->exists()) salvo @endif" data-post-id="{{ $post->id }}">
                                    @if($post->salvos()->where('user_id', Auth::id())->exists())
                                    <i class="fa-solid fa-bookmark salvo"></i>
                                    @else
                                    <i class="fa-regular fa-bookmark"></i>
                                    @endif
                                </span>


                                {{-- aqui --}}


                                <!-- Link que abre o modal -->
                                <a class="iconDenuncia" href="javascript:void(0);" onclick="openModal({{ $post->id }})">
                                    <span class="material-symbols-outlined">
                                        emergency_home
                                        </span>
                                </a>
                            </div>
                <!-- Fim do botão de salvar -->
            </div>
            <!-- Fim dos botões de ação -->

            <!-- Início do cabeçalho dos comentários -->
            <div class="headerComentarios">
                @csrf

                <!-- Início do filtro de data dos comentários -->
                <div class="dataFiltro">
                    <form method="GET" action="{{ route('comentarios.show', ['id' => $post->id]) }}">
                        <select name="sortOrder" onchange="this.form.submit()">
                            <option value="desc" {{ request('sortOrder') == 'desc' ? 'selected' : '' }}>Mais recente</option>
                            <option value="asc" {{ request('sortOrder') == 'asc' ? 'selected' : '' }}>Mais antigo</option>
                        </select>
                    </form>
                </div>
                <!-- Fim do filtro de data dos comentários -->
            </div>
            <!-- Fim do cabeçalho dos comentários -->

            <!-- Início do formulário de criação de comentários -->
            <form action="{{ route('comentarios.store', $post->id) }}" method="POST" class="criarPost">
                @csrf
                <div class="filtroComentarios">
                    <textarea name="texto" placeholder="Faça um comentário..." required></textarea>
                    
                    <div class="btnComentario">
                        <button type="submit" class="postarBotao" >Comentar</button>
                    </div>
                </div>
            </form>
            <!-- Fim do formulário de criação de comentários -->

            <!-- Início da seção de comentários -->
            <div id="comentariosSection">
            
                @foreach($comentarios as $comentario)
                <div class="comentarioContainer">
                    <!-- Início das informações do usuário no comentário -->
                    <div class="user" style="align-items: center;">
                        <div class="profileImg" style="width: 50px; height: 50px;">
                            <img src="{{ asset('storage/' . $comentario->user->urlDaFoto) }}" alt="{{ $comentario->user->name }}">
                        </div>
                        
                        <div class="info">
                            <div class="infoHeader" style="display:flex; align-items:center; justify-content:space-between; width:100%">
                            <h3>{{ '@' . $comentario->user->arroba }} <span class="publiSpan"> • Comentou na publicação de {{$post->user->arroba}}</span></h3>
                                <div class="modulo-div" style="background-color: {{ $coresModulo[$comentario->user->modulo] ?? 'defaultColor' }};">
                                    <p>{{ $comentario->user->modulo }} {{ $post->user->perfil }}</p>
                                </div>
                            </div>
                            <p class="horaPost">{{ $comentario->created_at->diffForHumans() }}</p>
                        </div>

                    </div>
                    <!-- Fim das informações do usuário no comentário -->

                    <p>{{ $comentario->texto }}</p>
                </div>
                @endforeach
            </div>
            <!-- Fim da seção de comentários -->

        </div>
        <!-- Fim do feed individual -->
    </div>
    <!-- Fim da estrutura de feeds -->
</div>
            @include ('partials.emAlta')

            <!-- comentarios -->


            







        </div>

        <div id="modal-denuncia" class="modal" style="display: none;">
                                <div class="modal-content" id="denunciaContent"> 
                                    <span class="close" onclick="closeModal()">&times;</span>
                                    <h2>Denunciar Post</h2>
                                    <p>Deseja realmente denunciar o post de {{ '@' . $post->user->arroba }}?</p> 
                                    <input type="text" id="motivo" placeholder="Motivo da denúncia">
                                    <div class="modal-footer">
                                        <button class="btn btn-danger" onclick="closeModal()">Cancelar</button>
                                        <button class="btn btn-info"style="color: white;" onclick="confirmarDenuncia()">Confirmar</button>
                                    </div>
                                    <input type="hidden" id="user-id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" id="post-id" value="{{ $post->id }}">

                                </div>
                            </div>

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
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Denúncia registrada!',
                                                text: data.message,
                                                confirmButtonText: 'Ok'
                                            }).then(() => {
                                                closeModal(); // Fecha o modal após o alerta
                                            });
                                        })
                                        .catch(error => {
                                            console.error("Erro:", error);
                                            Swal.fire({
                                                icon: 'error',  
                                                title: 'Erro',
                                                text: 'Ocorreu um erro ao registrar a denúncia.',
                                                confirmButtonText: 'Ok'
                                            });
                                        });
                                }

                            </script>

        <script src="{{ asset('js/like.js') }}"></script>
        <script src="{{ asset('js/seguir.js') }}"></script>
        <script src="{{ asset('js/salvo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
      



@include('partials.modalsair')
</body>

</html>