<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Menu-principal</title>
    <link rel="stylesheet" href="{{url('assets/css/adminHome.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=logout" rel="stylesheet">


</head>
<body>
    
   <!-- sidebar inicio -->
   <div class="sidebar">
        <img src="{{url('assets/img/logoConectec.png')}}" class="logo-sidebar" alt="">
        <ul>
        <li><a href= "{{ route('admin') }}" >Usúario</a></li>
            <li><a href= "{{ route('adminHome') }}" >Postagens</a></li>
            <li><a href="{{ route('preferenciasLista') }}">Preferências</a></li>
            <li><a href="{{ route('denuncias') }}">Denúncias</a></li>


               
                <li class="logout">
    <a href="#logout">Logout <span class="material-symbols-outlined icon-logout">logout</span></a>

</li>

</li>
        </ul>
    </div>
    <!-- sidebar fim -->

<!-- cards inicio -->

<div class="container">
<div class="search-bar">
        <input type="text" name="search" id="search" placeholder="Pesquisar Posts..." value="{{ old('search') }}">
        <button type="submit">Pesquisar</button> <!-- Botão de pesquisa -->
    </div>
    </div>

    <div class="container">
        <div class="containerCards">
        <div class="card" >                
            <h1>0</h1>
                <h3>Posts totais</h3>
            </div>
            <div class="card" id="cardEmAnalise">                
                <h1>0</h1>
                <h3>Posts Bloqueados </h3>
            </div>

            <div class="card" id="cardEmAnalise" >                
                <h1>0</h1>
                <h3>Posts ativos </h3>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="containerCards2">
        <div class="card2" >                
<canvas id="myPieChart" width="500" height="500"></canvas>
            </div>
            <div class="card2" id="cardEmAnalise">                
                <h1>0</h1>
                <h3>Posts em análise</h3>
            </div>

           <div class="card" id="cardModal">
    <h1>Modal</h1>
    <h3>#</h3>
</div>
        </div>
    </div>

    <div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Conteúdo do Modal</h2>
    <p>Este é um exemplo de conteúdo que pode ser exibido no modal.</p>
  </div>
</div>

<!-- cards fim -->

<div class="container">
        <div class="containerTabelaUsers2">
            <div class="tabelaUsers2">
            <div>

            <div class="filtro">
    <label for="filter">Ordenar por:</label>
    <select id="filter">
        <option value="recentes">Mais Recentes</option>
        <option value="antigos">Mais Antigos</option>
        <option value="seguidos">Mais Seguidos</option>
    </select>
   
</div>
</div>

<table>
    <thead>
        <tr>
            <th>Usuário</th>
            <th>Seguidores</th>
            <th>Posição</th>
            <th>Status</th>
            <th>Curso</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>@vinisilva</td>
            <td>100</td>
            <td>1</td>
            <td>Ativo</td>
            <td>DS</td>
        </tr>
        <tr>
            <td>@Hygorwanderley</td>
            <td>80</td>
            <td>2</td>
            <td>Bloqueado</td>
            <td>Nutri</td>
        </tr>
        <tr>
            <td>@mariaeduarda</td>
            <td>60</td>
            <td>3</td>
            <td>Ativo</td>
            <td>ADM</td>
        </tr>
        <tr>
            <td>@tutudanado</td>
            <td>40</td>
            <td>4</td>
            <td>Ativo</td>
            <td>DS</td>
        </tr>
        <tr>
            <td>@ronnisilva</td>
            <td>20</td>
            <td>5</td>
            <td>Ativo</td>
            <td>DS</td>
        </tr>

        <tr>
            <td>@ronnisilva</td>
            <td>20</td>
            <td>5</td>
            <td>Ativo</td>
            <td>DS</td>
        </tr>
    </tbody>
</table>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="containerTabelaUser3">
            <div class="tabelaUsers3">
            <div class="filtrotbuser3">
    <label for="filter">Ordenar por:</label>
    <select id="filter">
        <option value="recentes">Mais Recentes</option>
        <option value="antigos">Mais Antigos</option>
        <option value="seguidos">Mais Seguidos</option>
    </select>
</div>
            </div>
        </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxPie = document.getElementById('myPieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['DS', 'ADM', 'NUTRI'],
                datasets: [{
                    label: 'Distribuição de Cores',
                    data: [1,1,1],
                    backgroundColor: ['#3497c2', '#151855', '#0BBDFF'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Distribuição de Cursos',
                        font: {
                            size: 18
                        }
                    },
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            }
        });

        var modal = document.getElementById("myModal");

// Obtém o card que abrirá o modal
var card = document.getElementById("cardModal");

// Obtém o elemento <span> que fecha o modal
var span = document.getElementsByClassName("close")[0];

// Quando o usuário clica no card, o modal será mostrado
card.onclick = function() {
    modal.style.display = "block";
}

// Quando o usuário clicar no botão de fechar, o modal será fechado
span.onclick = function() {
    modal.style.display = "none";
}

// Quando o usuário clicar em qualquer lugar fora do modal, o modal será fechado
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
    </script>
</body>
</html>
