<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interesses</title>
    <link rel="stylesheet" href="{{ asset('./assets/css/preferencias.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Escolha seus interesses</h1>

        <!-- Primeiro Subtítulo -->
        <h2 class="subtitulo">Tecnologia e Programação</h2>
        <form action="{{ route('preferencias.store') }}" method="POST">
        @csrf
            <div class="interests-grid">
            @foreach($preferenciasLista as $preferencia)
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="pa" name="preferencias[]" data-nome="{{$preferencia->name}}" value="{{$preferencia->id}}">
                    <label for="pa">{{$preferencia->name}}</label>
                </div>
                
            @endforeach


            


            <!-- Campo Oculto e Botão de Envio -->
            <input type="hidden" name="nomePreferencias" id="nomePreferencias">
            <button type="submit" class="submit-btn">Salvar Interesses</button>
        </form>

    </div>

    <script>
        function toggleSelection(card) {
            const checkbox = card.querySelector('input[type="checkbox"]');
            const nomePreferencia = checkbox.getAttribute('data-nome');
    
            checkbox.checked = !checkbox.checked;
            card.classList.toggle('selected', checkbox.checked);
    
            const hiddenInput = document.getElementById('nomePreferencias');
            const selectedNomes = Array.from(document.querySelectorAll('input[type="checkbox"]:checked'))
                                       .map(input => input.getAttribute('data-nome'));
    
            hiddenInput.value = selectedNomes.join(', ');
        }
    </script>
</body>
</html>