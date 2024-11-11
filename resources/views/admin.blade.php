<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Menu-principal</title>
    <link rel="stylesheet" href="{{url('assets/css/admin.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>

    <!-- sidebar inicio -->
    <div class="sidebar">
        <img src="{{url('assets/img/logoConectec4.png')}}" class="logo-sidebar" alt="">
        <ul>
<<<<<<< HEAD
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Úsuario</a></li>
            <li><a href="#">Postagens</a></li>
            <li><a href="#">Postagens</a></li>
            <li class="logout">
                <a href="#">Logout <span class="material-icons" style="font-size: 32px;">logout</span></a>
            </li>
=======
            <a href="{{ route('adminHome') }}" class="sidebarBotao active">
                <li> <span class="material-icons" id="icons">post_add</span> <span>Postagens</span> </li>
            </a>
            <a href="{{ route('admin') }}" class="sidebarBotao active">
                <li> <span class="material-icons" id="icons">people</span> <span>Usuários</span> </li>
            </a>

            
            <a href="{{ route('preferenciasLista') }}" class="sidebarBotao active">
                <li> <span class="material-icons" id="icons">star</span> <span>preferências </span> </li>
            </a>

            <a href="{{ route('denuncias') }}" class="sidebarBotao active">
                <li> <span class="material-icons" id="icons">star</span> <span>denuncias </span> </li>
            </a>
            <!-- <a href="{{ route('preferenciasLista') }}" class="sidebarBotao active">
                <li> <span class="material-icons" id="icons">star</span> <span>Preferências</span> </li>
            </a> -->
>>>>>>> 4e5de6e63ea844a83be442be2389a3ce73f09a06
        </ul>
    </div>
    <!-- sidebar fim -->

    <!-- cards dashboard inicio -->
    <div class="container">
        <div class="containerCards">
            <div class="card" style="background: linear-gradient(to bottom right, #111111, #222222);">
                <h1>{{$qnt_users}}</h1>
                <h3>Úsuarios Totais</h3>
            </div>
            <div class="card" style="background: linear-gradient(to bottom right, #ca1f13, #ee4b37);">                
                <h1>0</h1>
                <h3>Úsuarios Bloqueados</h3>
            </div>
            <div class="card" style="background: linear-gradient(to bottom right, #444444, #555555);">                
                <h1>0</h1>
                <h3>Úsuarios em análise</h3>
            </div>
        </div>
    </div>
    <!-- cards dashboard fim -->

    <!-- TabelaUsers dashboard inicio -->
    <div class="container">
        <div class="containerTabelaUsers1">
            <div class="tabelaUsers1">
                <div>
                    <canvas id="myPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="containerTabelaUsers2">
            <div class="tabelaUsers2">
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
                        <!-- Adicione mais linhas conforme necessário -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container">
    <div class="containerTabelaUser3">
        <div class="tabelaUsers3">
            <canvas id="myBarChart" style="width: 100%; height: 700px;"></canvas> <!-- Ajustando o tamanho -->
        </div>
    </div>
</div>

    <!-- TabelaUsers dashboard fim -->

</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxPie = document.getElementById('myPieChart').getContext('2d');

    new Chart(ctxPie, {
        type: 'pie',  // Tipo de gráfico: pizza
        data: {
            labels: ['DS', 'ADM', 'NUTRI'],  // Rótulos das fatias
            datasets: [{
                label: 'Distribuição de Cores',
                data: [30, 20, 15],  // Dados que correspondem a cada fatia
                backgroundColor: [  // Cores das fatias
                    '#111111',  
                    '#151855',  
                    '#0BBDFF',  
                ],
            }]
        },
        options: {
            responsive: true,  // Faz com que o gráfico seja responsivo
            plugins: {
                title: {
                    display: true,
                    text: 'Distribuição de Cursos',  // Título do gráfico
                    font: {
                        size: 18  // Tamanho da fonte do título
                    }
                },
                legend: {
                    position: 'bottom',  // Posição da legenda (mover para baixo)
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + '%';  // Formatar os rótulos do tooltip
                        }
                    }
                }
            }
        }
    });

    // Gráfico de Barras
    const ctx = document.getElementById('myBarChart').getContext('2d');

new Chart(ctx, {
    type: 'bar',  // Tipo de gráfico: barras
    data: {
        labels: ['Usuário 1', 'Usuário 2', 'Usuário 3', 'Usuário 4', 'Usuário 5'], // Rótulos para o eixo Y
        datasets: [{
            label: 'Número de Seguidores', // Título da série de dados
            data: [100, 80, 60, 40, 20],  // Dados para cada usuário
            backgroundColor: '#0BBDFF',  // Cor de fundo das barras
            borderColor: '#111111',      // Cor da borda das barras
            borderWidth: 1,              // Largura da borda
            barThickness: 40,            // Espessura das barras
            barPercentage: 0.5,          // Diminui o espaço entre as barras
            categoryPercentage: 0.5     // Ajuste para diminuir ainda mais o espaço entre as categorias
        }]
    },
    options: {
        responsive: true,  // Torna o gráfico responsivo
        indexAxis: 'y',    // Gráfico horizontal
        scales: {
            x: {
                beginAtZero: true,  // Começa o eixo X a partir de 0
                max: 120,           // Limite superior para o eixo X
                grid: {             // Remove a grade do fundo
                    display: false
                }
            },
            y: {
                beginAtZero: true,  // Começa o eixo Y a partir de 0
                grid: {             // Remove a grade do fundo
                    display: false
                }
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Seguidores dos Usuários',  // Título do gráfico
                font: {
                    size: 18
                }
            },
            legend: {
                display: false,  // Não exibe a legenda
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw + ' seguidores'; // Formato do tooltip
                    }
                }
            }
        }
    }
});
</script>

</html>
