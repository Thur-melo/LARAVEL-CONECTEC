<!doctype html>
<html lang="en">

<head>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Menu-principal</title>
        <link rel="stylesheet" href="{{url('assets/css/admin.css')}}">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=logout" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>


</head>

<body>

    <!-- sidebar inicio -->
    <div class="sidebar">
        <img src="{{url('assets/img/logoConectec.png')}}" class="logo-sidebar" alt="">
        <ul>
        <li><a href= "{{ route('admin') }}" >Usuário</a></li>
            <li><a href= "{{ route('adminHome') }}" >Postagens</a></li>
            <li><a href="{{ route('denuncias') }}">Denúncias</a></li>


               
                <li class="logout">
                <a href="{{ route('login') }}">Logout <span class="material-symbols-outlined icon-logout">logout</span></a>

</li>

</li>
        </ul>
    </div>
    </div>
    <!-- sidebar fim -->
    <div class="container">
       <form method="GET" action="{{ route('admin') }}">
    <div class="search-bar">
        <input type="text" name="search" id="search" placeholder="Pesquisar usuários..." value="{{ old('search') }}">
    </div>
</form>

    </div>
    <!-- cards dashboard inicio -->
    <div class="container">
        <div class="containerCards">
            <div class="card" style="background: linear-gradient(to bottom right, #fff, #fff);">
                <h1>{{$qnt_users}}</h1>
                <h3>Usuário Totais</h3>
            </div>
            <div class="card" style="background: linear-gradient(to bottom right, #fff, #fff);">
                <h1>{{$usuariosInativos}}</h1>
                <h3>Usuário Inativos</h3>
            </div>
            <div class="card" id="cardEmAnalise" style="background: linear-gradient(to bottom right, #fff, #fff);">
                <h1>{{$usuariosAtivos}}</h1>
                <h3>Usuário ativos</h3>
            </div>
        </div>
    </div>
    <!-- cards dashboard fim -->




    <!-- TabelaUsers dashboard inicio -->
    <div class="container">
        <div class="containerTabelaUsers1">
            <div class="tabelaUsers1">
                <canvas id="myPieChart"></canvas>
                
                </div>

                <div class="tabelaUsers1">
                <canvas id="userPostsChart" width="350" height="200"></canvas>       
                     </div>
             
                <div class="tabelaUsers1">
                <canvas id="userPostsChart2" width="350" height="200"></canvas>       
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

                            <th>Status</th>
                            <th>Curso</th>
                            <th>Ações</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                        <tr>
                            <td>{{'@'. $user->arroba }}</td>
                            <td>{{ $seguidoresCounts[$user->id] ?? 0 }}</td> <!-- Exibe o número de seguidores ou 0 se não houver -->
                            <td>{{ $user->status }}</td>
                            <td>{{ $user->perfil }}</td>
                            <td>
                            <form action="{{ route('user.ativa', $user->id) }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="btn" id="btnAtiva"
                                        onclick="return confirm('Tem certeza que deseja Ativar este usuário?')">
                                        Ativar
                                    </button>
                                </form>
                            </td>
                          

                            <td>
                                <form action="{{ route('user.off', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" id="btnDesativa"
                                        onclick="return confirm('Tem certeza que deseja Desativar este usuário?')">
                                        Desativar
                                    </button>
                                </form>
                            </td>
                        
                        </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="containerTabelaUser3">
            <div class="tabelaUsers3">
                <canvas id="myBarChart" style="width: 100%; height: 700px;"></canvas>
            </div>
        </div>
    </div>

    <!-- TabelaUsers dashboard fim -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxPie = document.getElementById('myPieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['DS', 'ADM', 'NUTRI'],
                datasets: [{
                    label: 'Distribuição de Cores',
                    data: [{{$qnt_users_ads}}, {{$qnt_users_adm}}, {{$qnt_users_nutri}}],
                    backgroundColor: ['#3497c2', '#151855', '#0BBDFF'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Distribuição de Usuários',
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
                                return tooltipItem.label + ': ' + tooltipItem.raw ;
                            }
                        }
                    }
                }
            }
        });


      
        const ctx = document.getElementById('myBarChart').getContext('2d');

        // Montar rótulos e dados a partir de $topUsers
        const labels = @json($topUsers->pluck('name')); // Nomes dos usuários
        const data = @json($topUsers->pluck('seguidores_count')); // Contagem de seguidores

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Número de Seguidores',
                    data: data,
                    backgroundColor: '#0BBDFF',
                    borderColor: '#111111',
                    borderWidth: 1,
                    barThickness: 40,
                    barPercentage: 10,
                    categoryPercentage: 10
                }]
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Top 10 Usuários com Mais Seguidores',
                        font: {
                            size: 18
                        }
                    },
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' seguidores';
                            }
                        }
                    }
                }
            }
        });
    </script>


<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const ctx = document.getElementById('userPostsChart').getContext('2d');
        
        // Passando dados do PHP para o JavaScript
        const userNamesComment = @json($userNamesComment); // Nomes dos usuários
        const userPostCounts = @json($userPostCounts); // Contagem de comentários
        
        const userPostsChart = new Chart(ctx, {
            type: 'bar', // Tipo do gráfico
            data: {
                labels: userNamesComment, // Rótulos dos usuários
                datasets: [{
                    label: 'Usuários com maior Número de Comentários', // Rótulo da série de dados
                    data: userPostCounts, // Dados do gráfico (número de comentários por usuário)
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)', // Cor de fundo da barra 1
                        'rgba(153, 102, 255, 0.2)', // Cor de fundo da barra 2
                        'rgba(255, 159, 64, 0.2)'  // Cor de fundo da barra 3
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)', // Cor da borda da barra 1
                        'rgba(153, 102, 255, 1)', // Cor da borda da barra 2
                        'rgba(255, 159, 64, 1)'  // Cor da borda da barra 3
                    ],
                    borderWidth: 1 // Largura da borda
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true, // Começar o eixo Y a partir do zero
                        title: {
                            display: true,
                            text: 'Número de Comentários'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Usuários'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.dataset.label}: ${tooltipItem.raw}`; // Personaliza o texto do tooltip
                            }
                        }
                    }
                }
            }
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const ctx = document.getElementById('userPostsChart2').getContext('2d');
        
        // Passando dados do PHP para o JavaScript
        const userNamesPost = @json($userNamesPost); // Nomes dos usuários
        const userPostCounts = @json($userPostCounts); // Contagem de posts
        
        const userPostsChart2 = new Chart(ctx, {
            type: 'bar', // Tipo do gráfico
            data: {
                labels: userNamesPost, // Rótulos dos usuários
                datasets: [{
                    label: 'Usuários com maior Número de Posts', // Rótulo da série de dados
                    data: userPostCounts, // Dados do gráfico (número de posts por usuário)
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)', // Cor de fundo da barra 1
                        'rgba(153, 102, 255, 0.2)', // Cor de fundo da barra 2
                        'rgba(255, 159, 64, 0.2)'  // Cor de fundo da barra 3
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)', // Cor da borda da barra 1
                        'rgba(153, 102, 255, 1)', // Cor da borda da barra 2
                        'rgba(255, 159, 64, 1)'  // Cor da borda da barra 3
                    ],
                    borderWidth: 1 // Largura da borda
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true, // Começar o eixo Y a partir do zero
                        title: {
                            display: true,
                            text: 'Número de Posts'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Usuários'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.dataset.label}: ${tooltipItem.raw}`; // Personaliza o texto do tooltip
                            }
                        }
                    }
                }
            }
        });
    });
</script>

</body>

</html>