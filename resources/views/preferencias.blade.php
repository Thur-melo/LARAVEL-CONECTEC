<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interesses</title>
    <link rel="stylesheet" href="{{ asset('./assets/css/preferencias.css') }}">
</head>
<body>
    <div class="container">
        <h1>Escolha seus interesses</h1>
        <form action="{{ route('preferencias.store') }}" method="POST">
            @csrf
            <div class="interests-grid">
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="pa" name="preferencias[]" data-nome="P.A" value="1">
                    <label for="pa">P.A</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="eco" name="preferencias[]" data-nome="E.C.O" value="2">
                    <label for="eco">E.C.O</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="i.i" name="preferencias[]" data-nome="I.I" value="3">
                    <label for="i.i">I.I</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="pw" name="preferencias[]" data-nome="P.W" value="4">
                    <label for="pw">P.W</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="pam" name="preferencias[]" data-nome="P.A.M" value="5">
                    <label for="pam">P.A.M</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="dd" name="preferencias[]" data-nome="D.D" value="6">
                    <label for="dd">D.D</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="osa" name="preferencias[]" data-nome="O.S.A" value="7">
                    <label for="osa">O.S.A</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="fi" name="preferencias[]" data-nome="F.I" value="8">
                    <label for="fi">F.I</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="bd" name="preferencias[]" data-nome="B.D" value="9">
                    <label for="bd">B.D</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="aps" name="preferencias[]" data-nome="A.P.S" value="10">
                    <label for="aps">A.P.S</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="ds" name="preferencias[]" data-nome="D.S" value="11">
                    <label for="ds">D.S</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="ptcc" name="preferencias[]" data-nome="P.T.C.C" value="12">
                    <label for="ptcc">P.T.C.C</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="se" name="preferencias[]" data-nome="S.E" value="13">
                    <label for="se">S.E</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="dtcc" name="preferencias[]" data-nome="D.T.C.C" value="14">
                    <label for="dtcc">D.T.C.C</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="ip" name="preferencias[]" data-nome="I.P" value="15">
                    <label for="ip">I.P</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="ltt" name="preferencias[]" data-nome="L.T.T" value="16">
                    <label for="ltt">L.T.T</label>
                </div>
                <div class="interest-card" onclick="toggleSelection(this)">
                    <input type="checkbox" id="ssi" name="preferencias[]" data-nome="S.S.I" value="17">
                    <label for="ssi">S.S.I</label>
                </div>
            </div>
            {{-- campo oculto --}}
            <input type="hidden" name="nomePreferencias" id="nomePreferencias">
            <button type="submit" class="submit-btn" >Salvar Interesses</button>
        </form>
    </div>
    <script>
        // Função para alternar a seleção do cartão
        function toggleSelection(card) {
            const checkbox = card.querySelector('input[type="checkbox"]');
            const nomePreferencia = checkbox.getAttribute('data-nome'); // Pega o nome da preferência
    
            checkbox.checked = !checkbox.checked;
    
            // Adiciona ou remove a classe 'selected' com base no estado do checkbox
            card.classList.toggle('selected', checkbox.checked);
    
            // Atualiza o campo oculto com os nomes das preferências
            const hiddenInput = document.getElementById('nomePreferencias');
            const selectedNomes = Array.from(document.querySelectorAll('input[type="checkbox"]:checked'))
                                       .map(input => input.getAttribute('data-nome'));
    
            hiddenInput.value = selectedNomes.join(', '); // Armazena os nomes como uma string separada por vírgulas
        }
    </script>
    
</body>
</html>
