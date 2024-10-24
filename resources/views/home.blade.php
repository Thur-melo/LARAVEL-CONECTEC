<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{url('assets/css/home.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/nav.css')}}"> 

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Conectec</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css"
    />
    <link 
    rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/fontisto/3.0.1/css/fontisto/fontisto.min.css" integrity="sha512-OCX+kEmTPN1oyWnFzjD7g/7SLd9urTeI/VUZR6nZFFN7sedDoBSaSv/FDvCF8hf1jvadHsp0y0kie9Zdm899YA==" crossorigin="anonymous" referrerpolicy="no-referrer" 
    />
</head>

<body>

@include('partials.navbar')

<!-------------------------------------------  Main Container ---------------------------------------------->
<main> 
    <div class="container"> <!-- Container geral que engloba toda a página -->

        <div class="left"> <!-- Seção da barra lateral esquerda -->
            <div class="sidebar"> <!-- Sidebar com itens de menu -->
                <a href="{{ Route('home')}}" class="menu-item active">
                    <span><i class="fa-solid fa-house"></i></span> <h3>Home</h3>
                </a>
                <a class="menu-item ">
                    <span><i class="fa-regular fa-bell"></i></span> <h3>Notificações</h3>
                </a>

                <a href="{{ Route('postagens')}}" class="menu-item">
                    <span><i class="fa-regular fa-images"></i></span> <h3>Postagens</h3>
                </a>
                <a class="menu-item" href="{{Route('chat.list')}}">
                    <span><i class="fa-regular fa-message"></i></span> <h3>Chat</h3>
                </a>

                <a class="menu-item" href="{{Route('chat.list')}}">
                    <span><i class="fa-regular fa-square-plus"></i></span> <h3>Criar</h3>
                </a>

                <a class="menu-item" href="{{Route('chat.list')}}">
                    <span><i class="fa-regular fa-user"></i></span> <h3>Perfil</h3>
                </a>
            </div> <!-- Fim da Sidebar -->
        </div> <!-- Fim da barra lateral esquerda -->

<!-------------------------------------------  Posts -------------------------------------------------------------------------------------->
        <div class="meio"> <!-- Seção principal de posts -->
            <form class="criarPost"> <!-- Formulário de criar post -->
                <div class="profileImgPost">
                    <img src="{{ asset('storage/' . $user->urlDaFoto) }}" alt="">
                </div>
                <input type="text" placeholder="Faça uma pergunta" id="create-post" data-bs-toggle="modal" data-bs-target="#modalPost">
                <button type="button" class="postarBotao" data-bs-toggle="modal" data-bs-target="#modalPost">Publicar</button>
            </form> <!-- Fim do formulário de criar post -->

            @foreach($posts as $post)

            @php
                $coresModulo = [
                    '1º' => '#CD4642',
                    '2º' => '#5169B1',
                    '3º' => '#64B467',
                ];
            @endphp

            <div class="feeds"> <!-- Seção de feeds -->
                <div class="feed"> <!-- Cada post individual -->

                    <div class="user"> <!-- Informações do usuário do post -->
                        <div class="profileImg"> <!-- Imagem de perfil do usuário -->
                            <a href="{{ route('profile', ['id' => $post->user->id]) }}">
                                <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="" class="perfilPostImg">
                            </a>
                        </div>
                        <div class="info"> <!-- Informações sobre o usuário e o post -->
                            <div class="infoHeader" style="display:flex; align-items:center; justify-content:space-between; width:100%">
                                <h3>{{ '@' . $post->user->name }}</h3>

                                <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                    <p>{{ $post->user->modulo }} {{ $post->user->perfil }}</p>
                                </div>
                            </div>
                            <p class="horaPost">{{ $post->created_at->diffForHumans() }}</p>
                        </div> <!-- Fim das informações do post -->
                    </div> <!-- Fim da seção do usuário -->

                    <div class="tipoCont"> <!-- Tipo de post -->
                        <div class="tipo-div">
                            <p>{{ $post->tipo_post }}</p>
                        </div>
                    </div> <!-- Fim do tipo de post -->

                    <div class="textoPost"> <!-- Conteúdo do post -->
                        {{ $post->texto }}
                    </div> <!-- Fim do conteúdo do post -->

                    <div class="imgPost"> <!-- Imagem do post -->
                        <a href="{{ asset('storage/' . $post->fotoPost) }}" data-lightbox="gallery" data-title="Descrição da imagem">
                            <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="" style="max-width: 100%; height: auto;">
                        </a>
                    </div> <!-- Fim da imagem do post -->

                    <div class="action-button"> <!-- Botões de interação -->
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
                                <i class="uil uil-comment"></i>
                            </a>
                        </div>
                        <div class="bookmark">
                            <span><i class="uil uil-bookmark"></i></span>
                        </div>
                    </div> <!-- Fim dos botões de interação -->

                </div> <!-- Fim do post individual -->
            </div> <!-- Fim da seção de feeds -->

            @endforeach

        </div> <!-- Fim da seção principal de posts -->
             <div class="right">
                    <div class="emAltaCont">

                        <div class="headerAlta">
                            <h2>Em alta</h2>
                        </div>

                        <div class="listaAlta">
                            <div class="cursoAlta">
                                <span class="cursoLista">DS- Progamação e algoritimos</span>
                                <span class="assuntoAlta">#JavaOuPython</span>
                                <span class="qtdsPostAlta">129 Posts</span>
                            </div>

                            <div class="cursoAlta">
                                <span class="cursoLista">Nutrição- Comidas e massinhas</span>
                                <span class="assuntoAlta">#ComoFazerArrozSemPanelaEeAguaKkkkj</span>
                                <span class="qtdsPostAlta">2 Posts</span>
                            </div>

                            <div class="cursoAlta">
                                <span class="cursoLista">ADM- Caixa de mercado e uber</span>
                                <span class="assuntoAlta">#ComoImprimirDinheirokkkkj</span>
                                <span class="qtdsPostAlta">1.200 Posts</span>
                            </div>

                            <div class="cursoAlta">
                                <span class="cursoLista">Outros- Geral</span>
                                <span class="assuntoAlta">#NaoSeiOqColocarAqui</span>
                                <span class="qtdsPostAlta">532 Posts</span>
                            </div>
                        </div>

                    </div>
            
              </div> 


              

    </div> <!-- Fim do container geral -->

</main> <!-- Fim do main -->

@include('partials.modalsair')

<!-------------------------------------------  Modal -------------------------------------------------------------------------------------->

<div class="modal" tabindex="-1" id="modalPost">
    <form action="{{ route('home') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Criar uma nova publicação</h4>
                </div>
                <div class="modal-body">
                    <div class="publicarInput">
                        <h5 class="modal-title" style="font-weight:600">Descrição da publicação</h5>
                        <p style="font-weight:500; color:#AFAFAF; font-size:10pt">Para postagem ser enviada são necessários pelo menos 10 caracteres.</p>
                        <textarea class="form-control" aria-label="With textarea" name="texto" placeholder="Faça sua pergunta aqui..." required></textarea>
                    </div>
                    <div class="publicarInput" style="margin-top:10px">
                        <input type="file" id="file-input" name="fotoPost" accept="image/*" style="display:none" />
                        <label for="file-input">
                            <i class="fas fa-camera"></i> Adicionar Foto
                        </label>
                    </div>
                    <div class="publicarInput" style="margin-top:10px">
                        <label for="tipo_post">Selecione o tipo de publicação:</label>
                        <select class="form-select" aria-label="Selecione o tipo de publicação" id="tipo_post" name="tipo_post">
                        @foreach($preferenciasLista as $preferencia)
                                <option value="{{ $preferencia->name }}">{{ $preferencia->name }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Fechar</button>
                    <button class="btn btn-primary" type="submit">Publicar</button>
                </div>
            </div>
        </div>
    </form>
</div> <!-- Fim do modal -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-0FXbuKXKHmnD+fJ2NUCRsZ0mjMRiNGvbapG1lB+2sCniUX9cUGMBigvWuOYyVCV9" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

</body>
</html>
