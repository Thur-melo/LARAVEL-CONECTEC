<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('assets/css/admin.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/nav.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    
    <div class="main">

    <div class="sidebar">
        <div class="headerLogo">
            <i class="fa-brands fa-cloudversify"></i>
            <h2>Conectec</h2>
        </div>
        <a href="{{ route('home') }}" class="sidebarBotao"> 
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
        

        <a href="{{ route('admin') }}" class="sidebarBotao active">
            <span class="material-symbols-outlined">person</span>
            <h2>Perfil</h2>
        </a>

     </div> 





    
        <form  method="POST"  action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
        <div class="title">
            <i class="fa-regular fa-circle-user"></i>
            <h1>Preferencias da conta {{ $user->name }}</h1>
        </div>
        <div class="titleInfo">
            <i class="fa-brands fa-squarespace"></i>
            <h1>Suas informações </h1>
        </div>
          

        <div class="imgContainerEdit">
             <!-- <img src="{{ asset('storage/' . $user->urlDaFoto) }}" alt="">  -->
             <img id="imagePreview" alt="Prévia da Imagem" src="{{ asset('storage/' . $user->urlDaFoto) }}">
             
             <div class="inputsCont">

<div class="inputsGrupos">
    <div class="inputForm">
        <label for="Nome">
            Nome
        </label>
        <div class="inputText">
            <input type="text" id="nome"name="name" class="form-control"  value="{{ $user->name }}"  >
        </div>
    </div>

    <div class="inputForm">
        <label for="senha">
            Email
        </label>
        <div class="inputText">
            <input class="form-control" id="disabledInput" type="text" value="{{ $user->email }}" disabled >
        </div>
    </div>

  
</div>

<div class="inputsGrupos">
    
    <div class="inputForm">
        <label for="Modulo">
            Modulo
        </label>
        <div class="inputText">
        <input class="form-control" id="disabledInput" type="text" value="{{ $user->modulo}}" disabled>
        </div>
    </div>
    <div class="inputForm">
        <label for="Perfil">
            Perfil
        </label>
        <div class="inputText">
        <input class="form-control" id="disabledInput" type="text" value="{{ $user->perfil }}" disabled>
        </div>
    </div>
</div>
</div> 
        </div>

        <div class="linha">  
            <div class="botoesImg">
                <label for="urlDaFoto" class="botaoFotoPerfil"><i class="fa-regular fa-image"></i>Trocar</label>
                <input type="file" id="urlDaFoto" name="urlDaFoto" accept="image/*" onchange="previewImage(event)">
                <button type="submit" name="deleteImg" value="1" class="botaoFotoPerfil"><i class="fa-regular fa-trash-can"></i>Remover</button>
            </div>
            <div class="desc">
                <p>Aqui está suas informações, você pode editar algumas delas</p>
            </div>
            <div class="btnsSalvar">
            <button type="submit">Atualizar</button>
            </div>
        </div>
        </form>
    </div>


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


    </script>
    
</body>
</html>