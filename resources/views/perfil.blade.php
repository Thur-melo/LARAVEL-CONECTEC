<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('assets/css/perfil.css')}}">
    <<link rel="stylesheet" href="{{url('assets/css/nav.css')}}"> 

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Conectec</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css"
    />
</head>

    <link 
    rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/fontisto/3.0.1/css/fontisto/fontisto.min.css" integrity="sha512-OCX+kEmTPN1oyWnFzjD7g/7SLd9urTeI/VUZR6nZFFN7sedDoBSaSv/FDvCF8hf1jvadHsp0y0kie9Zdm899YA==" crossorigin="anonymous" referrerpolicy="no-referrer" 
    />

    
<body>


<nav>
        <div class="container">
            <div class="logoCont">
                <span class="fontisto--cloudy"></span>  
               <img src= "{{url('assets/img/logoConectec.png')}}"  id="logo">
            </div>
            <form  action="{{route('home')}}" method="get">
                <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                    <input
                    type="search"
                    placeholder="Pesquisar... "
                    name="s"
                     id="s"
                    />
                </div>
            </form>
                <div class="createBtn">
                    <div class="nomesNav">
                        <span>{{ $user->name}}</span>
                        <span>{{ $user->modulo}}</span>
                    </div>
                    <div class="profileImg">
                        <img src="{{ asset('storage/' . $user->urlDaFoto) }}" alt="">
                        
                </div>
                <i class="fa-solid fa-right-from-bracket" id="logoutIcon" style="cursor: pointer;"></i>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

        </div>
    </div>
</nav>
<!-------------------------------------------  NavAbar -------------------------------------------------------------------------------------->

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
            <a class="menu-item " href="{{Route('chat.list')}}">
                <span><i class="uil uil-chat"></i></span> <h3>Chat</h3>
            </a>
            <a href="{{ Route('perfil')}}" class="menu-item active">
                <span><i class="uil uil-edit-alt"></i></span> <h3>Perfil</h3>
            </a>


            </div>
        </div>
        




        <div class="meio">

        <form  method="POST"  action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data" id="formPerfil">
            @csrf
        <div class="title">
            <i class="fa-regular fa-circle-user"></i>
            <h1>Preferencias da conta {{ $user->name }} - Id: {{$user->id}}</h1>
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
                <input type="text" id="nome"name="name" class="form-control"  value="{{ $user->name }}"  required>
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


    </div>








</main>





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
  


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</body>
</html>