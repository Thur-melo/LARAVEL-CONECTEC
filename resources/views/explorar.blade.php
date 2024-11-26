<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{url('assets/css/nav.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/explorar.css')}}">


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
        <div class="container">
            <div class="left">
            <div class="sidebar">
                    <div class="sidebarList">

                        <a href="{{ Route('home')}}" class="menu-item ">
                            <span><i class="fa-solid fa-house"></i></span>
                            <h3>Home</h3>
                        </a>

                        <a class="menu-item active" href="{{ Route('explorar')}}">
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

                        <a class="menu-item "  href="{{ Route('home')}}"  >
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








                <div class="fileiraPreferencias-container">
                    <button class="scroll-button" type="button" onclick="scrollHorizontal('left')">←</button>

                    <div class="fileiraPreferencias">
                        <button class="categoriaCard active" onclick="mudarConteudo('all')">
                        <i class="fa-solid fa-earth-americas"></i>
                            <h2>Todos</h2>
                        </button>

                        <button class="categoriaCard" onclick="mudarConteudo('emalta')">
                        <i class="fa-solid fa-fire"></i>
                            <h2>Em Alta</h2>
                        </button>

                        <button class="categoriaCard" onclick="mudarConteudo('ads')">
                            <i class="fa-solid fa-desktop"></i>
                            <h2>Desenvolvimento de Sistemas</h2>
                        </button>

                        <button class="categoriaCard" onclick="mudarConteudo('nutri')">
                        <i class="fa-solid fa-stethoscope"></i>
                            <h2>Nutrição</h2>
                        </button>

                        <button class="categoriaCard" onclick="mudarConteudo('adm')">
                        <i class="fa-solid fa-user-tie"></i>
                            <h2>Administração</h2>
                        </button>

                        <form action="{{ route('home') }}" method="get">
                            @foreach($hashtags as $hashtag)
                            <button class="categoriaCard" name="s" value="{{ '#' . $hashtag->hashtag }}" type="submit">
                                <h2>{{'#' . $hashtag->hashtag }}</h2> <!-- Supondo que 'hashtag' seja o campo que contém o nome da hashtag -->
                            </button>
                            @endforeach
                        </form>

                    </div>








                    <button class="scroll-button" type="button" onclick="scrollHorizontal('right')">→</button>
                </div>

                <div class="feedExplorar">


                    <!-- Seção para Posts com mais Curtidas -->
                    <div class="scroll-container" id="curtidas">
                        <div id="resultado" class="resultado">
                            @foreach($posts as $post)
                            @php
                            $coresModulo = [
                            '1º' => '#CD4642',
                            '2º' => '#5169B1',
                            '3º' => '#64B467',
                            ];
                            @endphp

                            @if($post->fotoPost)
        <!-- Layout para posts com imagem -->
                            <div class="post com-imagem">
                                <div class="modulo">
                                    <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                        <p>{{ $post->user->modulo }} {{ $post->user->perfil }} </p>
                                    </div>
                                    </div>
                                    <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="Imagem do post" style="max-width: 100%; height: auto;">
                                    
                                    <div class="headerExplorar">
                                        
                                        <div class="infosExplorar">
                                        <div class="textoPostagem">
                                            <span> "{{ $post->texto }}" </span>
                                        </div>
                                        <div class="profileEInfo">
                                        <a href="{{ route('perfil', ['id' => $post->user->id]) }}">
                                            <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="Imagem de perfil" class="perfilPostImg">
                                           
                                        </a>
                                        <div class="infosEx">
                                        <p class="arrobaExplorar">{{ "@" . $post->user->arroba }}</p>
                                        <div class="horas">
                                            <p>{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                        </div>
                                        </div>
                                            
                                        

                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Layout para posts sem imagem -->
                                <div class="post sem-imagem">
                                    <div class="modulo">
                                    <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                        <p>{{ $post->user->modulo }} {{ $post->user->perfil }} </p>
                                    </div>
                                    </div>

                                    <div class="textoPostagem">
                                        <span> "{{ $post->texto }}" </span>
                                    </div>
                                    <div class="headerExplorar">
                                        <a href="{{ route('perfil', ['id' => $post->user->id]) }}">
                                            <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="Imagem de perfil" class="perfilPostImg">
                                        </a>
                                        <div class="infosExplorar">
                                            
                                            <p class="arrobaExplorar">{{ "@" . $post->user->arroba }}</p>
                                        <div class="horas">
                                        <p>{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                            
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            @endif
                            @endforeach
                        </div>
                    </div>




                </div>
            </div>


    </main>
    @include('partials.modalsair')
    <!-- Modal de Confirmação -->




    <script>
        function mudarConteudo(tipo) {
            const resultado = document.getElementById('resultado');
            resultado.innerHTML = ''; // Limpa o conteúdo atual

            if (tipo === 'all') { // Mude 'posts' para 'meusPosts'
                resultado.innerHTML += `
                  @foreach($posts as $post)
                  @if($post->fotoPost)
                            <div class="post com-imagem">
                                <div class="modulo">
                                    <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                        <p>{{ $post->user->modulo }} {{ $post->user->perfil }} </p>
                                    </div>
                                    </div>
                                    <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="Imagem do post" style="max-width: 100%; height: auto;">
                                    
                                    <div class="headerExplorar">
                                        
                                        <div class="infosExplorar">
                                        <div class="textoPostagem">
                                            <span> "{{ $post->texto }}" </span>
                                        </div>
                                        <div class="profileEInfo">
                                        <a href="{{ route('perfil', ['id' => $post->user->id]) }}">
                                            <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="Imagem de perfil" class="perfilPostImg">
                                           
                                        </a>
                                        <div class="infosEx">
                                        <p class="arrobaExplorar">{{ "@" . $post->user->arroba }}</p>
                                        <div class="horas">
                                            <p>{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                        </div>
                                        </div>
                                            
                                        

                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Layout para posts sem imagem -->
                                <div class="post sem-imagem">
                                    <div class="modulo">
                                    <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                        <p>{{ $post->user->modulo }} {{ $post->user->perfil }} </p>
                                    </div>
                                    </div>

                                    <div class="textoPostagem">
                                        <span> "{{ $post->texto }}" </span>
                                    </div>
                                    <div class="headerExplorar">
                                        <a href="{{ route('perfil', ['id' => $post->user->id]) }}">
                                            <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="Imagem de perfil" class="perfilPostImg">
                                        </a>
                                        <div class="infosExplorar">
                                            
                                            <p class="arrobaExplorar">{{ "@" . $post->user->arroba }}</p>
                                        <div class="horas">
                                        <p>{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                            
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            @endif
                            @endforeach`;
            } else if (tipo === 'emalta') {
                resultado.innerHTML = `   @foreach($postsCurtidas as $post)
                             @if($post->fotoPost)
                            <div class="post com-imagem">
                                <div class="modulo">
                                    <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                        <p>{{ $post->user->modulo }} {{ $post->user->perfil }} </p>
                                    </div>
                                    </div>
                                    <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="Imagem do post" style="max-width: 100%; height: auto;">
                                    
                                    <div class="headerExplorar">
                                        
                                        <div class="infosExplorar">
                                        <div class="textoPostagem">
                                            <span> "{{ $post->texto }}" </span>
                                        </div>
                                        <div class="profileEInfo">
                                        <a href="{{ route('perfil', ['id' => $post->user->id]) }}">
                                            <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="Imagem de perfil" class="perfilPostImg">
                                           
                                        </a>
                                        <div class="infosEx">
                                        <p class="arrobaExplorar">{{ "@" . $post->user->arroba }}</p>
                                        <div class="horas">
                                            <p>{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                        </div>
                                        </div>
                                            
                                        

                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Layout para posts sem imagem -->
                                <div class="post sem-imagem">
                                    <div class="modulo">
                                    <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                        <p>{{ $post->user->modulo }} {{ $post->user->perfil }} </p>
                                    </div>
                                    </div>

                                    <div class="textoPostagem">
                                        <span> "{{ $post->texto }}" </span>
                                    </div>
                                    <div class="headerExplorar">
                                        <a href="{{ route('perfil', ['id' => $post->user->id]) }}">
                                            <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="Imagem de perfil" class="perfilPostImg">
                                        </a>
                                        <div class="infosExplorar">
                                            
                                            <p class="arrobaExplorar">{{ "@" . $post->user->arroba }}</p>
                                        <div class="horas">
                                        <p>{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                            
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            @endif
                            @endforeach`;
            } else if (tipo === 'ads') {
                resultado.innerHTML += ` @foreach($postsAds as $post)
                             @if($post->fotoPost)
                            <div class="post com-imagem">
                                <div class="modulo">
                                    <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                        <p>{{ $post->user->modulo }} {{ $post->user->perfil }} </p>
                                    </div>
                                    </div>
                                    <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="Imagem do post" style="max-width: 100%; height: auto;">
                                    
                                    <div class="headerExplorar">
                                        
                                        <div class="infosExplorar">
                                        <div class="textoPostagem">
                                            <span> "{{ $post->texto }}" </span>
                                        </div>
                                        <div class="profileEInfo">
                                        <a href="{{ route('perfil', ['id' => $post->user->id]) }}">
                                            <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="Imagem de perfil" class="perfilPostImg">
                                           
                                        </a>
                                        <div class="infosEx">
                                        <p class="arrobaExplorar">{{ "@" . $post->user->arroba }}</p>
                                        <div class="horas">
                                            <p>{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                        </div>
                                        </div>
                                            
                                        

                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Layout para posts sem imagem -->
                                <div class="post sem-imagem">
                                    <div class="modulo">
                                    <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                        <p>{{ $post->user->modulo }} {{ $post->user->perfil }} </p>
                                    </div>
                                    </div>

                                    <div class="textoPostagem">
                                        <span> "{{ $post->texto }}" </span>
                                    </div>
                                    <div class="headerExplorar">
                                        <a href="{{ route('perfil', ['id' => $post->user->id]) }}">
                                            <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="Imagem de perfil" class="perfilPostImg">
                                        </a>
                                        <div class="infosExplorar">
                                            
                                            <p class="arrobaExplorar">{{ "@" . $post->user->arroba }}</p>
                                        <div class="horas">
                                        <p>{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                            
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            @endif
                            @endforeach`;
            } else if (tipo === 'nutri') {
                resultado.innerHTML += ` @foreach($postsNutri as $post)
                            @if($post->fotoPost)
                            <div class="post com-imagem">
                                <div class="modulo">
                                    <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                        <p>{{ $post->user->modulo }} {{ $post->user->perfil }} </p>
                                    </div>
                                    </div>
                                    <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="Imagem do post" style="max-width: 100%; height: auto;">
                                    
                                    <div class="headerExplorar">
                                        
                                        <div class="infosExplorar">
                                        <div class="textoPostagem">
                                            <span> "{{ $post->texto }}" </span>
                                        </div>
                                        <div class="profileEInfo">
                                        <a href="{{ route('perfil', ['id' => $post->user->id]) }}">
                                            <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="Imagem de perfil" class="perfilPostImg">
                                           
                                        </a>
                                        <div class="infosEx">
                                        <p class="arrobaExplorar">{{ "@" . $post->user->arroba }}</p>
                                        <div class="horas">
                                            <p>{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                        </div>
                                        </div>
                                            
                                        

                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Layout para posts sem imagem -->
                                <div class="post sem-imagem">
                                    <div class="modulo">
                                    <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                        <p>{{ $post->user->modulo }} {{ $post->user->perfil }} </p>
                                    </div>
                                    </div>

                                    <div class="textoPostagem">
                                        <span> "{{ $post->texto }}" </span>
                                    </div>
                                    <div class="headerExplorar">
                                        <a href="{{ route('perfil', ['id' => $post->user->id]) }}">
                                            <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="Imagem de perfil" class="perfilPostImg">
                                        </a>
                                        <div class="infosExplorar">
                                            
                                            <p class="arrobaExplorar">{{ "@" . $post->user->arroba }}</p>
                                        <div class="horas">
                                        <p>{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                            
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            @endif
                            @endforeach`;
            } else if (tipo === 'adm') {
                resultado.innerHTML += ` @foreach($postsAdm as $post)
                             @if($post->fotoPost)
                            <div class="post com-imagem">
                                <div class="modulo">
                                    <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                        <p>{{ $post->user->modulo }} {{ $post->user->perfil }} </p>
                                    </div>
                                    </div>
                                    <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="Imagem do post" style="max-width: 100%; height: auto;">
                                    
                                    <div class="headerExplorar">
                                        
                                        <div class="infosExplorar">
                                        <div class="textoPostagem">
                                            <span> "{{ $post->texto }}" </span>
                                        </div>
                                        <div class="profileEInfo">
                                        <a href="{{ route('perfil', ['id' => $post->user->id]) }}">
                                            <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="Imagem de perfil" class="perfilPostImg">
                                           
                                        </a>
                                        <div class="infosEx">
                                        <p class="arrobaExplorar">{{ "@" . $post->user->arroba }}</p>
                                        <div class="horas">
                                            <p>{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                        </div>
                                        </div>
                                            
                                        

                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Layout para posts sem imagem -->
                                <div class="post sem-imagem">
                                    <div class="modulo">
                                    <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                        <p>{{ $post->user->modulo }} {{ $post->user->perfil }} </p>
                                    </div>
                                    </div>

                                    <div class="textoPostagem">
                                        <span> "{{ $post->texto }}" </span>
                                    </div>
                                    <div class="headerExplorar">
                                        <a href="{{ route('perfil', ['id' => $post->user->id]) }}">
                                            <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="Imagem de perfil" class="perfilPostImg">
                                        </a>
                                        <div class="infosExplorar">
                                            
                                            <p class="arrobaExplorar">{{ "@" . $post->user->arroba }}</p>
                                        <div class="horas">
                                        <p>{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                            
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            @endif
                            @endforeach`;
            }

            // Atualizar a classe active
            const categorias = document.querySelectorAll('.categoriaCard');
            categorias.forEach(cat => cat.classList.remove('active'));
            const clickedElement = document.querySelector(`.categoriaCard[onclick*="${tipo}"]`);
            clickedElement.classList.add('active');
        }
    </script>

    <script>
        function scrollHorizontal(direction) {
            var container = document.querySelector('.fileiraPreferencias');
            var scrollAmount = 200; // Quantidade de pixels a ser movida por vez

            if (direction === 'right') {
                container.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            } else if (direction === 'left') {
                container.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="{{ asset('js/like.js') }}"></script>
    <script src="{{ asset('js/seguir.js') }}"></script>

</body>

</html>