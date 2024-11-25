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
        const userNamesComment = @json($userNamesComment);
        const userPostCounts = @json($userPostCounts);

        const userPostsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: userNamesComment,
                datasets: [{
                    label: 'Usuários com maior Número de Comentários',
                    data: userPostCounts,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1.5,
                    hoverBackgroundColor: 'rgba(0, 0, 0, 0.1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: {
                                size: 14,
                                family: 'Arial, sans-serif',
                                style: 'italic'
                            },
                            color: '#333'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.dataset.label}: ${tooltipItem.raw}`;
                            }
                        },
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: {
                            size: 14,
                            weight: 'bold',
                            family: 'Arial, sans-serif'
                        },
                        bodyFont: {
                            size: 12,
                            family: 'Arial, sans-serif'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(200, 200, 200, 0.3)',
                            borderDash: [5, 5]
                        },
                        title: {
                            display: true,
                            text: 'Comentários',
                            font: {
                                size: 16,
                                family: 'Arial, sans-serif'
                            },
                            color: '#444'
                        },
                        ticks: {
                            color: '#555',
                            font: {
                                size: 12
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                      
                        ticks: {
                            color: '#555',
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                layout: {
                    padding: {
                        top: 20,
                        left: 10,
                        right: 10,
                        bottom: 10
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
        const userNamesPost = @json($userNamesPost);
        const userPostCounts = @json($userPostCounts);

        const userPostsChart2 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: userNamesPost,
                datasets: [{
                    label: 'Usuários com maior Número de Posts',
                    data: userPostCounts,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1.5,
                    hoverBackgroundColor: 'rgba(0, 0, 0, 0.1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: {
                                size: 14,
                                family: 'Arial, sans-serif',
                                style: 'italic'
                            },
                            color: '#333'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.dataset.label}: ${tooltipItem.raw}`;
                            }
                        },
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: {
                            size: 14,
                            weight: 'bold',
                            family: 'Arial, sans-serif'
                        },
                        bodyFont: {
                            size: 12,
                            family: 'Arial, sans-serif'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(200, 200, 200, 0.3)',
                            borderDash: [5, 5]
                        },
                        title: {
                            display: true,
                            text: 'Posts',
                            font: {
                                size: 16,
                                family: 'Arial, sans-serif'
                            },
                            color: '#444'
                        },
                        ticks: {
                            color: '#555',
                            font: {
                                size: 12
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                      
                        ticks: {
                            color: '#555',
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                layout: {
                    padding: {
                        top: 20,
                        left: 10,
                        right: 10,
                        bottom: 10
                    }
                }
            }
        });
    });
</script>


</body>

</html>