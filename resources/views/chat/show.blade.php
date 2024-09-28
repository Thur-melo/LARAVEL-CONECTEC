
    <h1>Conversa com {{ $conversation->user_one_id === auth()->id() ? $conversation->user_two_id : $conversation->user_one_id }}</h1>

    <div>
        @foreach($messages as $message)
            <p><strong>{{ $message->user->name }}:</strong> {{ $message->message }}</p>
        @endforeach
    </div>

    <form action="{{ url('/conversations/' . $conversation->id . '/messages') }}" method="POST">
        @csrf
        <input type="text" name="message" placeholder="Sua mensagem" required>
        <button type="submit">Enviar</button>
    </form>

