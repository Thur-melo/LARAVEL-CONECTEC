<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('assets/css/perfil.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/nav.css')}}"> 
    <link rel="stylesheet" href="{{url('assets/css/preferencias.css')}}"> 

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


@include('partials.navbar')
<!-------------------------------------------  NavAbar -------------------------------------------------------------------------------------->

<main> 
<div class="container">
        <div class="left">
            <div class="sidebar">

            <a href="{{ Route('home')}}" class="menu-item">
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
            <a href="{{ Route('perfil')}}" class="menu-item ">
                <span><i class="uil uil-edit-alt"></i></span> <h3>Perfil</h3>
            </a>
            <a href="{{ Route('preferencias')}}" class="menu-item active">
                <span><i class="uil uil-edit-alt"></i></span> <h3>preferencias</h3>
            </a>


            </div>
        </div>

        <div class="container2">
        <h1>Escolha seus interesses</h1>

        <!-- Primeiro Subtítulo -->
       
        <form action="{{ route('preferencias.store') }}" method="POST">
        @csrf
    <div class="subTitle"> 
        <h2 class="subtitulo">Análise e Desenvolvimento de Sistema</h2>
    </div>
            <div class="interests-grid">
            @foreach($preferenciasListaDS as $preferencia)
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="preferencia_{{$preferencia->id}}" name="preferencias[]" data-nome="{{$preferencia->name}}" value="{{$preferencia->id}}">
                    <label for="preferencia_{{$preferencia->id}}">{{$preferencia->name}}</label>
                </div>
            @endforeach
            </div>
            <div class="subTitle"> 
            <h2 class="subtitulo">Nutrição e dietética</h2>
            </div>
            <div class="interests-grid">
            @foreach($preferenciasListaNutri as $preferencia)
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="preferencia_{{$preferencia->id}}" name="preferencias[]" data-nome="{{$preferencia->name}}" value="{{$preferencia->id}}">
                    <label for="preferencia_{{$preferencia->id}}">{{$preferencia->name}}</label>
                </div>
            @endforeach
            </div>
            <div class="subTitle"> 
            <h2 class="subtitulo">Administração</h2>
            </div>
            <div class="interests-grid">
            @foreach($preferenciasListaADM as $preferencia)
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="preferencia_{{$preferencia->id}}" name="preferencias[]" data-nome="{{$preferencia->name}}" value="{{$preferencia->id}}">
                    <label for="preferencia_{{$preferencia->id}}">{{$preferencia->name}}</label>
                </div>
            @endforeach
            </div>

            <div class="subTitle"> 
            <h2 class="subtitulo">Outros</h2>
            </div>
            <div class="interests-grid">
            @foreach($preferenciasListaOutro as $preferencia)
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="preferencia_{{$preferencia->id}}" name="preferencias[]" data-nome="{{$preferencia->name}}" value="{{$preferencia->id}}">
                    <label for="preferencia_{{$preferencia->id}}">{{$preferencia->name}}</label>
                </div>
            @endforeach
            </div>
            





            <!-- Botão de Envio -->
            <button type="submit" class="submit-btn">Salvar Interesses</button>
        </form>

        

    </div>



    <!-- 
<form action="{{ '#', $preferencia->id }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="delete-btn">Desassociar</button>
</form> -->
  

    <script>
        function toggleSelection(card) {
            const checkbox = card.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
            card.classList.toggle('selected', checkbox.checked);
        }
    </script>
  




</main>

@include('partials.modalsair')




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