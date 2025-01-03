<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{url('assets/css/profile.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/nav.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/postPadrão.css')}}">


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Conectec Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontisto/3.0.1/css/fontisto/fontisto.min.css" integrity="sha512-OCX+kEmTPN1oyWnFzjD7g/7SLd9urTeI/VUZR6nZFFN7sedDoBSaSv/FDvCF8hf1jvadHsp0y0kie9Zdm899YA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>




<body>

    @include('partials.navbar')

    <!-------------------------------------------  NavAbar -------------------------------------------------------------------------------------->

    <main>
                    @php
                    $coresModulo = [
                            '1º' => '#CD4642',
                            '2º' => '#5169B1',
                            '3º' => '#64B467',
                            ];
                            @endphp
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
                            <h3>Notificações  @if($naoLidasCount > 0)
                                <span class="badge rounded-pill text-bg-danger">
                                    {{ $naoLidasCount }}
                                    
                                </span>
                            @endif</h3>
                            
                        </a>

                        <a href="{{ Route('postagens')}}" class="menu-item">
                            <span><i class="fa-regular fa-images"></i></span>
                            <h3>Postagens</h3>
                        </a>
                        <a class="menu-item " href="{{Route('chat.list')}}">
                            <span><i class="fa-regular fa-message"></i></span>
                            <h3>Chat</h3>
                        </a>

                        <a class="menu-item "  href="{{ Route('home')}}" >
                            <span><i class="fa-regular fa-square-plus"></i></i></span>
                            <h3>Criar</h3>
                        </a>


                    </div>

                    <a href="{{ route('profile', ['id' => $user->id]) }}" class="menu-item active">
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
                <div class="perfilContainer">
                    <div class="fundo">
                        <img src="{{ asset('storage/' . $user->urlDoBanner) }}" id="banner">
                    </div>


                    <img src="{{ asset('storage/' . $user->urlDaFoto) }}" class="profileImg" id="icon">


                    <div class="infoContainer">
                        <div class="rowEditarPerfil">
                            <button type="button" class="botaoEditar"
                                data-bs-toggle="modal" data-bs-target="#profileModal">
                                Editar Perfil
                            </button>


                        </div>
                        <div class="rowNomeUser">
                            <div class="nomeecurso">
                                <h1 class="username">{{ $user->name}}</h1>
                                
                                <div class="modulo-div" style="background-color: {{ $coresModulo[$user->modulo] ?? 'defaultColor' }};">
                                        <p>{{ $user->modulo }} {{ $user->perfil }} </p>
                                    </div>
                            </div>
                            
                            <p class="arroba"> {{ '@' . $user->arroba }} </p>
                            
                           
                        </div>

                        <div class="rowBio">
                            <div class="bio">
                                <p>{{ $user->bio }}</p>
                            </div>
                        </div>

                        <div class="footerPerfil">
                            <div class="itensData">
                                <span class="material-symbols-outlined">
                                    calendar_month
                                </span>
                                <p>{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="itensFollow">
                                <p>{{$seguindo}} Seguindo</p>
                                <p>{{$myseguidores}} Seguidores</p>
                              
                            </div>
                        </div>

                        <div class="categoriaFooter">
                            <div class="categoria active" onclick="mudarConteudo('meusPosts')">Meus Posts</div>
                            <div class="categoria" onclick="mudarConteudo('salvos')">Salvos</div>
                            <div class="categoria " onclick="mudarConteudo('curtidas')">Curtidas</div>
                        </div>


                    </div>

                </div>


                <div id="resultado" class="resultado">
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
                            <div class="user">
                                <div class="profileImg">
                                    <a href="{{ route('perfil', ['id' => $post->user->id]) }}">
                                        <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="" class="perfilPostImg">
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="infoHeader" style="display:flex; align-items:center; justify-content:space-between; width:100%">
                                        <h3>{{ '@' . $post->user->name }} <span class="publiSpan"> • fez uma nova publicação</span></h3>
                                        <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                            <p>{{ $post->user->modulo }} {{ $post->user->perfil }}</p>
                                        </div>
                                    </div>
                                    <p class="horaPost">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <div class="textoPost">{{ $post->texto ?? 'Post não disponível' }}</div>

                            @if($post->fotoPost)
                                <div class="imgPost">
                                    <a href="{{ asset('storage/' . $post->fotoPost) }}" data-lightbox="gallery" data-title="Descrição da imagem">
                                        <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="" style="max-width: 100%; height: auto;">
                                    </a>
                                </div>
                            @endif

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
                                <span class="salvo-btn @if($post->salvos()->where('user_id', Auth::id())->exists()) salvo @endif" data-post-id="{{ $post->id }}">
                                    @if($post->salvos()->where('user_id', Auth::id())->exists())
                                    <i class="fa-solid fa-bookmark salvo"></i>
                                    @else
                                    <i class="fa-regular fa-bookmark"></i>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            </div>
            @include ('partials.emAlta')
        </div>



    </main>
    @include('partials.modalsair')
    <!-- Modal de Confirmação -->
    @include('partials.modalEditarPerfil')



    <script>
        function mudarConteudo(tipo) {
            const resultado = document.getElementById('resultado');
            resultado.innerHTML = ''; // Limpa o conteúdo atual

            if (tipo === 'meusPosts') { // Mude 'posts' para 'meusPosts'
                resultado.innerHTML += `
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
                            <div class="user">
                                <div class="profileImg">
                                    <a href="{{ route('perfil', ['id' => $post->user->id]) }}">
                                        <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="" class="perfilPostImg">
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="infoHeader" style="display:flex; align-items:center; justify-content:space-between; width:100%">
                                        <h3>{{ '@' . $post->user->name }} <span class="publiSpan"> • fez uma nova publicação</span></h3>
                                        <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                            <p>{{ $post->user->modulo }} {{ $post->user->perfil }}</p>
                                        </div>
                                    </div>
                                    <p class="horaPost">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <div class="textoPost">{{ $post->texto ?? 'Post não disponível' }}</div>

                            @if($post->fotoPost)
                                <div class="imgPost">
                                    <a href="{{ asset('storage/' . $post->fotoPost) }}" data-lightbox="gallery" data-title="Descrição da imagem">
                                        <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="" style="max-width: 100%; height: auto;">
                                    </a>
                                </div>
                            @endif

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
                                <div class="bookmark">
                                    <span><i class="uil uil-bookmark"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach`;
            } else if (tipo === 'salvos') {
                resultado.innerHTML = ` @foreach($postSalvos as $post)
                @php
        $coresModulo = [
            '1º' => '#CD4642',
            '2º' => '#5169B1',
            '3º' => '#64B467',
        ];
    @endphp
                    <div class="feeds">
                        <div class="feed">
                            <div class="user">
                                <div class="profileImg">
                                    <a href="{{ route('perfil', ['id' => $post->user->id]) }}">
                                        <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="" class="perfilPostImg">
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="infoHeader" style="display:flex; align-items:center; justify-content:space-between; width:100%">
                                        <h3>{{ '@' . $post->user->name }} <span class="publiSpan"> • fez uma nova publicação</span></h3>
                                        <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                            <p>{{ $post->user->modulo }} {{ $post->user->perfil }}</p>
                                        </div>
                                    </div>
                                    <p class="horaPost">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <div class="textoPost">{{ $post->texto ?? 'Post não disponível' }}</div>

                            @if($post->fotoPost)
                                <div class="imgPost">
                                    <a href="{{ asset('storage/' . $post->fotoPost) }}" data-lightbox="gallery" data-title="Descrição da imagem">
                                        <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="" style="max-width: 100%; height: auto;">
                                    </a>
                                </div>
                            @endif

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
                                <div class="bookmark">
                                    <span><i class="uil uil-bookmark"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach`;
            } else if (tipo === 'curtidas') {
                resultado.innerHTML += ` @foreach($postCurtidas as $post)
                @php
        $coresModulo = [
            '1º' => '#CD4642',
            '2º' => '#5169B1',
            '3º' => '#64B467',
        ];
    @endphp
                    <div class="feeds">
                        <div class="feed">
                            <div class="user">
                                <div class="profileImg">
                                    <a href="{{ route('perfil', ['id' => $post->user->id]) }}">
                                        <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="" class="perfilPostImg">
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="infoHeader" style="display:flex; align-items:center; justify-content:space-between; width:100%">
                                        <h3>{{ '@' . $post->user->name }} <span class="publiSpan"> • fez uma nova publicação</span></h3>
                                        <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                            <p>{{ $post->user->modulo }} {{ $post->user->perfil }}</p>
                                        </div>
                                    </div>
                                    <p class="horaPost">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <div class="textoPost">{{ $post->texto ?? 'Post não disponível' }}</div>

                            @if($post->fotoPost)
                                <div class="imgPost">
                                    <a href="{{ asset('storage/' . $post->fotoPost) }}" data-lightbox="gallery" data-title="Descrição da imagem">
                                        <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="" style="max-width: 100%; height: auto;">
                                    </a>
                                </div>
                            @endif

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
                                <div class="bookmark">
                                    <span><i class="uil uil-bookmark"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach`;
            }

            // Atualizar a classe active
            const categorias = document.querySelectorAll('.categoria');
            categorias.forEach(cat => cat.classList.remove('active'));
            const clickedElement = document.querySelector(`.categoria[onclick*="${tipo}"]`);
            clickedElement.classList.add('active');
        }
    </script>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="{{ asset('js/like.js') }}"></script>
    <script src="{{ asset('js/salvo.js') }}"></script>
    <script src="{{ asset('js/seguir.js') }}"></script>

</body>

</html>