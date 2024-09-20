<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('assets/css/home.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Conectec</title>
</head>
<body>

    <!-- inicio side-bar -->

        <div class="sidebar">
            <i class="fab fa-twitter"></i>

            <div class="sidebarBotao active">
            <span class="material-symbols-outlined"> home</span>
            <h2>home</h2>
            </div>
        

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
        

        <div class="sidebarBotao">
        <span class="material-symbols-outlined">person</span>
            <h2>Perfil</h2>
            </div>

            <button class="btnPublicar">Publicar</button>

        </div> 

        
    <!-- final side-bar -->

    <div class="feedContainer">
        <div class="feedTitle">

            <h3>Home - Bem-vindo, 
            {{ $user->name }}! </h3>

        </div>

        <div class="feedBox">
             <form action="{{ route('home')}}"  method="post" enctype="multipart/form-data">
                @csrf
                <div class="publicarInput">
                    <img src="{{ asset('storage/' . $user->urlDaFoto) }}"alt="">
                    <input type="text" name="texto" placeholder="Desabafa pá nóis">
                </div>
                
                <input type="file" name="fotoPost"  accept="image/*" >
                <button type="submit" class="postBtn" >
                    Publicar
                </button>
                </form>
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
                </div>
            </div>

            <div class="postHeaderDescription">
                <p>{{ $post->texto }}</p>
            </div>
            
            <img src="{{ asset('storage/' . $post->fotoPost) }}"alt="">

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
    <div class="perguntasInput">
    <span class="material-symbols-outlined">search</span>
    </div>
    </div> 




    <!-- fim perguntas  -->
    
</body>
</html>