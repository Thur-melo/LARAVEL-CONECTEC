<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{url('assets/css/notificacao.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/home.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/nav.css')}}">


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>

    <link
        rel="stylesheet"
        href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/fontisto/3.0.1/css/fontisto/fontisto.min.css" integrity="sha512-OCX+kEmTPN1oyWnFzjD7g/7SLd9urTeI/VUZR6nZFFN7sedDoBSaSv/FDvCF8hf1jvadHsp0y0kie9Zdm899YA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>


<body>
    @include('partials.navbar')
    @php
    use Illuminate\Support\Str;
@endphp

    <main>
        <div class="container">
            <div class="left">
                <div class="sidebar">
                    <div class="sidebarList">

                        <a href="{{ Route('home')}}" class="menu-item ">
                            <span><i class="fa-solid fa-house"></i></span>
                            <h3>Home</h3>
                        </a>

                        <a class="menu-item " href="{{ Route('explorar')}}">
                            <span><i class="fa-regular fa-compass"></i></span>
                            <h3>Explorar</h3>
                        </a>

                        <a class="menu-item active">
                            <span><i class="fa-regular fa-bell"></i></span>
                            <h3>Notificações</h3>
                            
                        </a>

                        <a href="{{ Route('postagens')}}" class="menu-item ">
                            <span><i class="fa-regular fa-images"></i></span>
                            <h3>Postagens</h3>
                        </a>
                        <a class="menu-item " href="{{Route('chat.list')}}">
                            <span><i class="fa-regular fa-message"></i></span>
                            <h3>Chat</h3>
                        </a>

                    


                    </div>

                    <a href="{{ route('profile', ['id' => $user->id]) }}" class="menu-item">
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



            <!-------------------------------------------  Minhas perguntas -------------------------------------------------------------------------------------->

            <div class="meio">
    <div class="notiCont">
        <!-- Cabeçalho de "Em Alta" -->
       
        <div class="headerNoti">
            <h2>Notificações</h2>

             
                    <form action="{{ route('notificacoes.marcarTodasComoLidas') }}" method="POST"id="marcarTodasForm" style="display: inline;">
                         @csrf
                         <button onclick="confirmarMarcarTodasComoLidas()" type="submit" class="iconeOlho" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Marcar todas como lidas"><i class="fa-regular fa-eye-slash"></i></button>
                    </form>
                        
        </div>

        <div class="msgLista">
            @if(count($notificacoes) > 0)
            @foreach($notificacoes as $notificacao)
           
                    <div class="msg">
                       

                        <div class="msgUserFoto">
                            <div class="icone 
                                {{ $notificacao->tipo == 'comentario' ? 'comentario-icone' : '' }} 
                                {{ $notificacao->tipo == 'like' ? 'curtida-icone' : '' }}">
                                
                                @if ($notificacao->tipo == 'comentario')
                                    <i class="fa-solid fa-comment"></i> 
                                @elseif ($notificacao->tipo == 'like')
                                    <i class="fa-solid fa-heart"></i> 
                                @endif
                            </div>
                            <img src="{{ asset('storage/' . $notificacao->interacaoUsuario->urlDaFoto) }}" alt="">
                        </div>

                        <div class="msgInfors">
                            <a class="msgTexto" href="{{ route('comentarios', $notificacao->post->id) }}">
                                <span>{{$notificacao->interacaoUsuario->arroba}}</span>
                                
                                @if($notificacao->tipo === 'like')
                                    <span class="spanTexto">Curtiu a sua publicação</span>
                                @elseif($notificacao->tipo === 'comentario')
                                    <span class="spanTexto">Comentou na sua publicação.</span>
                                @endif
                                
                                <span class="post-texto">"{{ Str::limit($notificacao->post->texto, 20, '...') }}"</span>
                            </a>

                            <div class="msgHora">
                                <small>{{ $notificacao->created_at->diffForHumans() }}</small>
                                <div class="iconeLixeira" data-id="{{$notificacao->id}}">
                                    <i class="fa-regular fa-trash-can"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="semNotificacoes">Nenhuma notificação disponível.</p>
            @endif
        </div>
    </div>
</div>




    </main>


 

    

    <!-- Script para os MODAIS LEGAIS tmnc bootrape -->
   
    <!-- Script para os MODAIS LEGAIS tmnc bootrape -->


    <script>document.addEventListener('DOMContentLoaded', function() {
    const deleteIcons = document.querySelectorAll('.iconeLixeira');

    deleteIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const notificationId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Tem certeza?',
                text: "Você quer realmente excluir esta notificação?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/notificacoes/${notificationId}/delete`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Excluído!',
                                'A notificação foi excluída.',
                                'success'
                            );
                            this.closest('.msg ').remove(); // Opcional: remove o elemento da interface
                        } else {
                            Swal.fire(
                                'Erro!',
                                data.message,
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        Swal.fire(
                            'Erro!',
                            'Ocorreu um erro ao excluir a notificação.',
                            'error'
                        );
                    });
                }
            });
        });
    });
});
</script>


<script>
    function confirmarMarcarTodasComoLidas() {
        iziToast.success({
            title: 'Sucesso',
            message: 'Notificações marcadas como lidas!',
            position: 'topRight',
            timeout: 1500
        });
    }
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>


    <script>
                document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>

</html>