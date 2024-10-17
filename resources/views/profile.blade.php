<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{url('assets/css/profile.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/nav.css')}}"> 

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Conectec</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css"
    />
    <link 
    rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/fontisto/3.0.1/css/fontisto/fontisto.min.css" integrity="sha512-OCX+kEmTPN1oyWnFzjD7g/7SLd9urTeI/VUZR6nZFFN7sedDoBSaSv/FDvCF8hf1jvadHsp0y0kie9Zdm899YA==" crossorigin="anonymous" referrerpolicy="no-referrer" 
    />
</head>



    
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

            <a href="{{ Route('postagens')}}" class="menu-item">
                <span><i class="uil uil-question-circle"></i></span> <h3>Postagens</h3>
            </a>
            <a class="menu-item " href="{{Route('chat.list')}}">
                <span><i class="uil uil-chat"></i></span> <h3>Chat</h3>
            </a>
            <a href="{{ Route('perfil')}}" class="menu-item ">
                <span><i class="uil uil-edit-alt"></i></span> <h3>Perfil</h3>
            </a>


            </div>
        </div>
      


<!-------------------------------------------  Posts -------------------------------------------------------------------------------------->

        <div class="meio">
            <div class="containerProfile">
                <div class="contHeader">
                    
                        <div class="imgCont">
                            <img src="{{ asset('storage/' . $usuario->urlDaFoto) }}" alt=""> 
                        </div>

                       
                    

                    
                    <div class="contInfo">
                        <div class="nomePerfil">
                            <div class="nomes">
                                <h2>{{  $usuario->name }}</h2>
                                <h3>{{  $usuario->arroba }}</h3>
                            </div>

                            <button>seguir</button>
                        </div>
                    
                
                    <div class="infoUser">
                        <div class="infos">
                            <span>56</span>
                            <span>Posts</span>
                        </div>
                        <div class="infos">
                            <span>2110</span>
                            <span>Seguidores</span>
                        </div>
                        <div class="infos">
                            <span>23</span>
                            <span>Curtidas</span>
                        </div>
                    </div>

                    <div class="descUser">
                        {{$user->bio}}
                    </div>
                </div>
            
            </div>
        </div>
            
        @foreach($posts as $post)

        @php
            $coresModulo = [
            '1º' => 'red',
            '2º' => 'blue',
            '3º' => 'yellow',
            ];
        @endphp

        <div class="feeds">
            <div class="feed">
                 <div class="user">
                     <div class="profileImg">
                         <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="">
                     </div>
                     <div class="info">
                        <div class="infoHeader" style="display:flex; align-items:center; justify-content:space-between; widht:100%">
                            <h3>{{ $post->user->name }}</h3>
                         <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                            <p>{{ $post->user->modulo }} {{ $post->user->perfil }} </p>
                        </div>
                        
                         </div>
                         <p class="horaPost">{{ $post->created_at->diffForHumans() }}</p>
                             
                         </div>
                         
                         
                        
                 </div>
                 <div class="tipoCont">
                    <div class="tipo-div">
                        <p>{{ $post->tipo_post }}</p>
                    </div>
                </div>
                 <div class="textoPost">
                    {{ $post->texto }}
                 </div>
        
                 <div class="imgPost">
                 <a href="{{ asset('storage/' . $post->fotoPost) }}" data-lightbox="gallery" data-title="Descrição da imagem">
                        <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="" style="max-width: 100%; height: auto;">
                    </a>
                 </div>
        
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
                         <i class="uil uil-comment"></i>
                         </a> 
                     </div>
                     <div class="bookmark">
                         <span><i class="uil uil-bookmark"></i></span>
                     </div>
                 </div>
            </div>
        @endforeach
    </div>
<!-------------------------------------------  Postsss -------------------------------------------------------------------------------------->
        </div>
     
      








</main>
@include('partials.modalsair')


                <!-- Modal de Confirmação -->      

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

        @if(session('showModal'))
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('successModal'));
                myModal.show();
            });
        @endif
 
    </script>


    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="{{ asset('js/like.js') }}"></script>
</body>
</html>