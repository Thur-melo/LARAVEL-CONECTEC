<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{url('assets/css/home.css')}}">
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

            <a href="{{ Route('home')}}" class="menu-item active">
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


            </div>
        </div>
      


<!-------------------------------------------  Posts -------------------------------------------------------------------------------------->

        <div class="meio">
            <form class="criarPost">
                    <div class="profileImgPost">
                        <img src="{{ asset('storage/' . $user->urlDaFoto) }}" alt="">
                    </div>
                    <input type="text" placeholder="Faça uma pergunta" id="create-post" data-bs-toggle="modal" data-bs-target="#modalPost">
                    <button type="button" class="postarBotao" data-bs-toggle="modal" data-bs-target="#modalPost"> Publicar
                </button>
                </form>

            

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
                             <a href="{{ route('profile', ['id' => $post->user->id]) }}">
                                 <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="" class="perfilPostImg">
                            </a>
                             </div>
                             <div class="info">
                                <div class="infoHeader" style="display:flex; align-items:center; justify-content:space-between; widht:100%">
                                    <h3>{{ '@' . $post->user->name }} </h3>
                                    
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
<!-------------------------------------------  Postsss -------------------------------------------------------------------------------------->
        </div>


    </div>








</main>
@include('partials.modalsair')



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
                            <h5 class="modal-title" style="font-weight:600">Descrição da publicação</h5>
                            <p style="font-weight:500; color:#AFAFAF; font-size:10pt"> Para postagem ser enviada são necessário pelo menos 10 caracteres. </p>
                            <textarea class="form-control" aria-label="With textarea" name="texto" placeholder="Faça sua pergunta aqui..." required></textarea>
                            </div>
                            <div class="publicarInput"style="margin-top:10px">
                                 <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="fotoPost"  accept="image/*" onchange="previewImage(event)">
                            </div>

                            <select class="form-select"style="margin-top:10px" aria-label="Default select example" name="tipo">
                                <option value="Informativo">Informativo</option>
                                <option value="Aula">Aula</option>
                                <option value="Duvida">Duvida</option>
                                <option value="Estagios">Estagios</option>
                                </select>
                                <div class="previewModal">
                                <img id="imagePreview" src="" alt="Prévia da Imagem" style="display: none;">
                                </div>
                        </div>

                            


                        <div class="modal-footer" id="mf">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                            <button  type="submit" class="postarBotao">Publicar</button>
                        </div>
                    </div>
                    </form>
                </div>


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