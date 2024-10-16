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
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="pa" name="preferencias[]" data-nome="P.A" value="1">
                    <label for="pa">Programação e Algoritmos</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="web" name="preferencias[]" data-nome="Desenvolvimento Web" value="2">
                    <label for="web">Desenvolvimento Web</label>
                </div>
            </div>

            <!-- Segundo Subtítulo -->
            <h2 class="subtitulo">Design e Multimídia</h2>
            <div class="interests-grid">
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="design" name="preferencias[]" data-nome="Design Gráfico" value="3">
                    <label for="design">Design Gráfico</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="video" name="preferencias[]" data-nome="Edição de Vídeo" value="4">
                    <label for="video">Edição de Vídeo</label>
                </div>
            </div>

            <!-- Terceiro Subtítulo -->
            <h2 class="subtitulo">Ciência de Dados</h2>
            <div class="interests-grid">
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="data" name="preferencias[]" data-nome="Data Science" value="5">
                    <label for="data">Data Science</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="ai" name="preferencias[]" data-nome="Inteligência Artificial" value="6">
                    <label for="ai">Inteligência Artificial</label>
                </div>
            </div>

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