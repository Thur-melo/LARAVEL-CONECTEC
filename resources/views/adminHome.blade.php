<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('assets/css/adminHome.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/perguntasAdm.css')}}">

    <link rel="stylesheet" href="{{url('assets/css/navbarAdm.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

</head>
<body>

<nav class="navbar">
    <h1 class="title">Eae</h1>
    <div class="user">
    <h6>eu</h6>
    </div>
</nav>
    <div class="main">
        <div class="sidebarAdm">

        <a href="{{ route('adminHome') }}" class="sidebarBotao active">
            <span class="material-symbols-outlined">search</span>
            <h2>Perguntas</h2>
        </a>
        <a href="{{ route('admin') }}"class="sidebarBotao ">
            <span class="material-symbols-outlined">search</span>
            <h2>Análises</h2>
        </a>

        </div>
        <div class="ConteudoAdm">

            @if ($posts->isEmpty())
        <h1>Sem perguntas pendentes</h1>
    @else

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

            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Tem certeza que deseja deletar este post?')">Deletar</button>
            </form>



            <form action="{{ route('posts.aprovar', $post->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PATCH')
            <button type="submit" onclick="return confirm('Tem certeza que deseja mudar o status para 2?')">Mudar Status</button>
        </form>
            </div>
        </div>
       
        @endforeach
        @endif
      
        </div>
    </div>
 

</body>
</html>