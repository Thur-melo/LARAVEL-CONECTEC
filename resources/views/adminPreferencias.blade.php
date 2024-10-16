<html>
<head>
    <title>Lista de Preferências</title>
</head>
<body>
    <h1>Preferências</h1>
    
    <ul>
        @foreach($preferenciasLista as $preferencia)
            <li>{{ $preferencia->name }}</li>
        @endforeach
    </ul>


    <h1>Cadastrar Preferência</h1>
    
    <form action="{{ route('preferenciasLista.store') }}" method="POST">
        @csrf
        <label for="name">Nome da Preferência:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Salvar</button>
    </form>
    
    <a href="{{ route('adminHome') }}">Voltar</a>
</body>
</html>