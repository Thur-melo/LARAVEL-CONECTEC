<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="{{url('assets/css/msg.css')}}"> 
    <link rel="stylesheet" href="{{url('assets/css/nav.css')}}"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">


    
</head>
<body>
    
<nav>
        <div class="container">
            <div class="logoCont">
                <span class="fontisto--cloudy"></span>  
               <img src= "{{url('assets/img/logoConectec.png')}}"  id="logo">
            </div>
                <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                    <input
                    type="search"
                    placeholder="Pesquisar... "
                    />
                </div>
                <div class="createBtn">
                    <label class="botaoPostar" for="create-post">Publicar</label>
                    <div class="profileImg">
                        <img src="{{ asset('storage/' . $user->urlDaFoto) }}" alt="">
                </div>
        </div>
    </div>
</nav>
<nav>
        <div class="container">
            <div class="logoCont">
                <span class="fontisto--cloudy"></span>  
               <img src= "{{url('assets/img/logoConectec.png')}}"  id="logo">
            </div>
                <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                    <input
                    type="search"
                    placeholder="Pesquisar... "
                    />
                </div>
                <div class="createBtn">
                    <label class="botaoPostar" for="create-post">Publicar</label>
                    <div class="profileImg">
                        <img src="{{ asset('storage/' . $user->urlDaFoto) }}" alt="">
                </div>
        </div>
    </div>
</nav>

<main> 
    <div class="container">
        <div class="left">
            <div class="sidebar">

            <a href="{{ Route('home')}}" class="menu-item ">
                <span><i class="uil uil-home"></i></span> <h3>Home</h3>
            </a>
            <a class="menu-item ">
                <span><i class="uil uil-bell"></i></span> <h3>Notificações</h3>
            </a>

            <a class="menu-item">
                <span><i class="uil uil-question-circle"></i></span> <h3>Perguntas</h3>
            </a>
            <a class="menu-item active" href="{{Route('chat.list')}}">
                <span><i class="uil uil-chat"></i></span> <h3>Chat</h3>
            </a>
            <a href="{{ Route('perfil')}}" class="menu-item ">
                <span><i class="uil uil-edit-alt"></i></span> <h3>Perfil</h3>
            </a>


            </div>
        </div>

    <div class="chat-container">
        <div class="messages">
            @foreach($messages as $message)
            <div class="message">{{ $message->user->name }}: {{ $message->message }}</div>
        @endforeach
        </div>
        <div class="input-container">
        <form action="{{ url('/conversations/' . $conversation->id . '/messages') }}" method="POST">
        @csrf
        <input type="text" name="message" placeholder="Sua mensagem" required>
        <button type="submit">Enviar</button>
        </form>
        </div>
    </div>

    
<div class="listaContainer">
        <h1>Minhas Conversas</h1>

<ul>
    @foreach($conversations as $conversation)
        <li>
            <a href="{{ url('/conversations/' . $conversation->id) }}">
                Conversa com {{ $conversation->user_one_id === $user->id ? $conversation->userTwo->name : $conversation->userOne->name }}

            </a>
        </li>
    @endforeach
</ul>
</div>
   
</div>
</main>
</body>
</html>

 

 

