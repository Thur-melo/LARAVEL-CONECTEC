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

                        <a href="{{ Route('home')}}" class="menu-item">
                            <span><i class="fa-solid fa-house"></i></span>
                            <h3>Home</h3>
                        </a>

                        <a class="menu-item active" href="">
                            <span><i class="fa-regular fa-compass"></i></span>
                            <h3>Explorar</h3>
                        </a>

                        <a class="menu-item ">
                            <span><i class="fa-regular fa-bell"></i></span>
                            <h3>Notificações</h3>
                        </a>

                        <a href="{{ Route('postagens')}}" class="menu-item">
                            <span><i class="fa-regular fa-images"></i></span>
                            <h3>Postagens</h3>
                        </a>
                        <a class="menu-item " href="{{Route('chat.list')}}">
                            <span><i class="fa-regular fa-message"></i></span>
                            <h3>Chat</h3>
                        </a>




                    </div>

                    <a href="{{ route('profile', ['id' => $user->id]) }}" class="menu-item ">
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

                <div class="feedExplorar">
                    <!-- Seção para Posts com mais Curtidas -->
                    <div class="fileira">
                        <h2>Posts com Mais Curtidas</h2>
                        <div class="scroll-container" id="curtidas">
                            @foreach($postsCurtidas as $post)
                            <div class="post">
                           
                           <div class="headerExplorar">
                                                               @if(isset($post->user->id)) <a href="{{ route('perfil', ['id' => $post->user->id]) }}"> <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="" class="perfilPostImg"> </a> @else {{ dd($post->user) }} @endif
                                                               <a href="{{ route('comentarios', $post->id) }}" style="text-decoration: none;">
                       <h3> {{ $post->texto }}
                       </div>
                     
                           </h3>
                           <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="" style="max-width: 100%; height: auto;">
                       </div>
                       </a>
                            @endforeach
                        </div>
                    </div>

                      <!-- Seção para Posts com Mais Comentários -->
                      <div class="fileira">
                        <h2>Posts com Mais Comentários</h2>
                        <div class="scroll-container" id="comentarios">
                            @foreach($postsComentarios as $post)
                            <div class="post">
                           
                                <div class="headerExplorar">
                                                                    @if(isset($post->user->id)) <a href="{{ route('perfil', ['id' => $post->user->id]) }}"> <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="" class="perfilPostImg"> </a> @else {{ dd($post->user) }} @endif
                                                                    <a href="{{ route('comentarios', $post->id) }}" style="text-decoration: none;">
                            <h3> {{ $post->texto }}
                            </div>
                          
                                </h3>
                                <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="" style="max-width: 100%; height: auto;">
                            </div>
                            </a>
                            @endforeach
                        </div>

                    </div>
                    <!-- Seção para Posts Aleatórios -->
                    <div class="fileira">
                        <h2>Para Você</h2>
                        <div class="scroll-container" id="aleatorios">
                            @foreach($postsAleatorios as $post)
                            <div class="post">
                           
                                <div class="headerExplorar">
                                                                    @if(isset($post->user->id)) <a href="{{ route('perfil', ['id' => $post->user->id]) }}"> <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="" class="perfilPostImg"> </a> @else {{ dd($post->user) }} @endif
                                                                    <a href="{{ route('comentarios', $post->id) }}" style="text-decoration: none;">
                            <h3> {{ $post->texto }}
                            </div>
                          
                                </h3>
                                <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="" style="max-width: 100%; height: auto;">
                            </div>
                            </a>
                            @endforeach
                        </div>
                    </div>

                  


                </div>
            </div>

            @include ('partials.emAlta')

    </main>
    @include('partials.modalsair')
    <!-- Modal de Confirmação -->

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="{{ asset('js/like.js') }}"></script>
    <script src="{{ asset('js/seguir.js') }}"></script>

</body>

</html>