
    <h1>Minhas Conversas</h1>

    <ul>
        @foreach($conversations as $conversation)
            <li>
                <a href="{{ url('/conversations/' . $conversation->id) }}">
                    Conversa com {{ $conversation->user_one_id === auth()->id() ? $conversation->user_two_id : $conversation->user_one_id }}
                </a>
            </li>
        @endforeach
    </ul>

    <form action="/conversations" method="POST">
        @csrf
        <input type="text" name="username" placeholder="ID do usuário para conversar" required>
        <button type="submit">Iniciar Conversa</button>
    </form>
