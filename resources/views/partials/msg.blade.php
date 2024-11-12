
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{url('assets/css/emAlta.css')}}">
</head>
<body>
<style>

</style>
<div class="right">
    <!-- Contêiner de "Em Alta" -->
    <div class="notiCont">
        <!-- Cabeçalho de "Em Alta" -->
        <div class="headerNoti">
            <h2>Notificações</h2>
            <a href="">Marcar como lidas</a>
        </div>

        <div class="msgLista">
        @foreach($notificacoes->take(3) as $notificacao)
        
            <a class="msg" >
                <div class="msgUserFoto">
                    <img src="{{ asset('storage/' . $notificacao->interacaoUsuario->urlDaFoto) }}" alt="">
                </div>
                
                <div class="msgInfors">
                    <div class="msgTexto">
                        <span>{{$notificacao->interacaoUsuario->arroba}}</span>
                        @if($notificacao->tipo === 'like')
                                    <span>deu um like no seu post!</span>
                                @elseif($notificacao->tipo === 'comentario')
                                    <span>comentou no seu post!</span>
                                @endif
                    </div>

                    <div class="msgHora">
                    <small>{{ $notificacao->created_at->diffForHumans() }}</small>
                    <div class="icone 
                        {{ $notificacao->tipo == 'comentario' ? 'comentario-icone' : '' }} 
                        {{ $notificacao->tipo == 'like' ? 'curtida-icone' : '' }}">
                        
                        @if ($notificacao->tipo == 'comentario')
                            <i class="fa-solid fa-comment"></i> 
                        @elseif ($notificacao->tipo == 'like')
                            <i class="fa-solid fa-heart"></i> 
                        @endif
                    </div>
                    </div>
                </div>

                
            </a>
          
            @endforeach
            
        </div>
       
        <!-- Fim do Cabeçalho de "Em Alta" -->
        <!-- Lista de "Em Alta" -->
       
        <!-- Fim da Lista de "Em Alta" -->
    </div>
    <!-- Fim do Contêiner de "Em Alta" -->
</body>
</html>