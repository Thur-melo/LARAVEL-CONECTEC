<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('assets/css/home.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/nav.css')}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Conectec</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
</head>
<body>
<div class="main">

    <div class="sidebar">
        <div class="headerLogo">
            <i class="fa-brands fa-cloudversify"></i>
            <h2>Conectec</h2>
        </div>
        <a href="{{ route('home') }}" class="sidebarBotao active"> 
            <span class="material-symbols-outlined"> home</span>
            <h2>home</h2>
</a>
        

        <div class="sidebarBotao">
            <span class="material-symbols-outlined">search</span>
            <h2>Buscar</h2>
        </div>
        

        <div class="sidebarBotao">
            <span class="material-symbols-outlined">notifications_none</span>
            <h2>Notificações</h2>
        </div>
        

        <div class="sidebarBotao">
            <span class="material-symbols-outlined">help</span>
            <h2>Perguntas</h2>
        </div>
        

        <div class="sidebarBotao">
            <span class="material-symbols-outlined">chat</span>
            <h2>Chat</h2>
        </div>
        
        <div class="sidebarBotao">
            <span class="material-symbols-outlined">bookmarks</span>
            <h2>Salvos</h2>
        </div>
        

        <a href="{{ route('perfil') }}" class="sidebarBotao ">
            <span class="material-symbols-outlined">person</span>
            <h2>Perfil</h2>
        </a>

     </div> 
        
    <!-- final side-bar -->

    <div class="feedContainer">
        <div class="feedTitle">
                <h3> Home - Bem Vindo {{ $user->name}} </h3>
        </div>
<!-- 
        <div class="feedBox">
             <form action="{{ route('home')}}"  method="post" enctype="multipart/form-data">
                @csrf
                <div class="publicarInput">
                    <img src="{{ asset('storage/' . $user->urlDaFoto) }}" alt="">
                    <input type="text" name="texto" placeholder="Desabafa pá nóis" required>
                </div>
                
                <input type="file" name="fotoPost"  accept="image/*" >
                <button type="submit" class="postBtn" >
                    Publicar
                </button>
                </form>
                <button type="button" class="postBtn" data-bs-toggle="modal" data-bs-target="#exampleModal"> Publicar
                </button>
                </div> -->

                <div class="modal" tabindex="-1"  id="modalPost">
                    <form action="{{ route('home')}}"  method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h4>Criar uma nova publicação</h4>
                        </div>
                        <div class="modal-body" >
                            
                            <!-- <div class="publicarInput">
                            <h5 lass="modal-title">Título da publicação</h5>
                            <p> Para postagem ser enviada são necessário pelo menos 10 caracteres. </p>
                            <input type="text" class="form-control" name="texto" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                            </div> -->
                            
                            <div class="publicarInput">
                            <h5 lass="modal-title">Descrição da publicação</h5>
                            <p> Para postagem ser enviada são necessário pelo menos 10 caracteres. </p>
                            <textarea class="form-control" aria-label="With textarea" name="texto" placeholder="Desabafa pá nóis" required></textarea>
                            </div>
                            <div class="publicarInput">
                            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="fotoPost"  accept="image/*">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button  type="submit" class="postBtn">Enviar</button>
                        </div>
                    </div>
                    </form>
                </div>

         </div>


        <!-- <div class="post">
        <div class="postAvatar">
            <img src="{{ asset('storage/' . $user->urlDaFoto) }}" alt="">
        </div>

        <div class="postBody">
            <div class="postHeader">
                <div class="postHeaderText">
                    <h3> {{ $user->name }} </h3>
                    <span class="modulo"> {{ $user->modulo }} </span>
                </div>
            </div>

            <div class="postHeaderDescription">
                <p>Sla bla bla bla</p>
            </div>

            <img src="{{ asset('storage/' . $user->urlDaFoto) }}"alt="">

            <div class="postFooter">

            <span class="material-symbols-outlined">favorite</span>
            <span class="material-symbols-outlined">mode_comment</span>
            <span class="material-symbols-outlined">bookmark</span>
            </div>
        </div>
    </div> -->
          

        
<!--  -->

    @foreach($posts as $post)
    <div class="postBody">
            <div class="postHeader">
                <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}"alt="">
                <div class="postHeaderText">
                    <h3> {{ $post->user->name }} </h3>
                    <span class="modulo"> {{ $post->user->modulo }} </span>
                </div>
            </div>

            <div class="postHeaderDescription">
                <p>{{ $post->texto }}</p>
            </div>
            <a href="{{ asset('storage/' . $post->fotoPost) }}" data-lightbox="gallery">
            <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="">
            </a>
            
    
            <div class="postFooter">

            <span class="material-symbols-outlined">favorite</span>
            <span class="material-symbols-outlined">mode_comment</span>
            <span class="material-symbols-outlined">bookmark</span>
            </div>
        </div>
        @endforeach


    </div>

    <!-- inicio perguntas  -->
    <div class="perguntas">
    <div class="buscarContainer">
    <div class="publicarInput">
    <form class="d-flex" role="search">
                <input type="text" class="form-control" placeholder="busca" aria-label="busca" aria-describedby="addon-wrapping">
                <button type="submit" class="input-group-text" id="addon-wrapping"> <span class="material-symbols-outlined">search</span></button>

      </form>
      </div>
      </div>
    
    <div class="sidebar">
    <div class="perguntaCard">
    <h4 id="perguntaTitulo"> Qual a sua dúvida? </h4>
    <button type="button" class="postBtn" id="perguntaBtn" data-bs-toggle="modal" data-bs-target="#modalPost"> Perguntar
            </button>
            </div>
            <div class="sidebarBotao active">
            
            </div>
        

        <div class="sidebarBotao">
        <!-- <span class="material-symbols-outlined">search</span>
            <h2>Buscar</h2>
            </div>
        

        <div class="sidebarBotao">
        <span class="material-symbols-outlined">notifications_none</span>
            <h2>Notificações</h2>
            </div>
        

        <div class="sidebarBotao">
        <span class="material-symbols-outlined">help</span>
            <h2>Perguntas</h2>
            </div>
        

        <div class="sidebarBotao">
        <span class="material-symbols-outlined">chat</span>
            <h2>Chat</h2>
            </div>
        
        <div class="sidebarBotao">
        <span class="material-symbols-outlined">bookmarks</span>
            <h2>Salvos</h2>
        </div>
        

        <div class="sidebarBotao">
        <span class="material-symbols-outlined">person</span>
            <h2>Perfil</h2>
            </div>

            <button class="btnPublicar">Publicar</button> --->
            </div>
</div>
    <!-- fim perguntas  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</body>
</html>