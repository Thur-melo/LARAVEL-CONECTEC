<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h2>Notificações</h2>

    @if($notificacoes->isEmpty())
        <p>Você não tem novas notificações.</p>
    @else
        <ul class="list-group">
            @foreach($notificacoes as $notificacao)
                <li class="list-group-item {{ $notificacao->lido ? 'text-muted' : '' }}">
                    @if($notificacao->tipo === 'comentario')
                        Seu post foi comentado!
                    @elseif($notificacao->tipo === 'like')
                        Seu post recebeu um novo like!
                    @endif
                    <br>
                    <small>{{ $notificacao->created_at->diffForHumans() }}</small>

                    {{-- Botão para marcar como lida --}}
                    @if(!$notificacao->lido)
                        <form action="{{ route('notificacoes.marcarComoLida', $notificacao->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary">Marcar como lida</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>

</body>
</html>