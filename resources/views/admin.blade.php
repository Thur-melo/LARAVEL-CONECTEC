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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=delete" />
    </head>


</head>

<body>

    <!-- sidebar inicio -->
    <div class="sidebar">
        <img src="{{url('assets/img/logoConectec4.png')}}" class="logo-sidebar" alt="">
        <ul>
            <li><a href="{{ route('admin') }}">Úsuario</a></li>
            <li><a href="{{ route('adminHome') }}">Postagens</a></li>
            <li><a href="{{ route('preferenciasLista') }}">Preferências</a></li>
            <li><a href="{{ route('denuncias') }}">Denúncias</a></li>

            s
            <li class="logout">
                <a href="#logout">Logout <span class="material-symbols-outlined icon-logout">logout</span></a>

            </li>

            </li>
        </ul>
    </div>
    </div>
    <!-- sidebar fim -->
    <div class="container">
        <div class="search-bar">
            <input type="text" id="search" placeholder="Pesquisar usuários...">
        </div>
    </div>
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
            <div class="card" id="cardEmAnalise" style="background: linear-gradient(to bottom right, #444444, #555555);">
                <h1>{{$qnt_pendentes}}</h1>
                <h3>Úsuarios em análise</h3>
            </div>
        </div>
    </div>
    <!-- cards dashboard fim -->




    <!-- TabelaUsers dashboard inicio -->
    <div class="container">
        <div class="containerTabelaUsers1">
            <div class="tabelaUsers1">
                <canvas id="myPieChart"></canvas>
                <div class="containerTabela">
                    <table class="tbDenuncias">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Usuário denunciado</th>
                                <th>Motivo</th>
                                <th>Status</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($denunciasUser as $denuncia)
                            <tr>
                                <td>{{ $denuncia->id }}</td>
                                <td>{{ $denuncia->userDenunciado->name }}</td> <!-- Nome do usuário denunciado -->

                                <td>{{ $denuncia->motivo }}</td>
                                <td>{{ $denuncia->status }}</td>
                                <td>
                                    <form action="{{ route('user.off', $denuncia->userDenunciado->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" id="btnDesativa"
                                            onclick="return confirm('Tem certeza que deseja Desativar este usuário?')">
                                            Desativar usuário
                                        </button>
                                    </form>
                                </td>

                                <td>
                                    <button class="btn" id="btnAtiva" onclick="ativarUsuario({{ $denuncia->userDenunciado->id }})">
                                        Ativar
                                    </button>
                                </td>


                                <td>
                                    <!-- Botão de excluir denúncia -->
                                    <button onclick="deletarDenuncia({{ $denuncia->id }})" class="btn " id="relevar">relevar</button>
                                </td>

                            </tr>
                            @endforeach
                            <script>
                                // Função para ativar usuário
                                function ativarUsuario(userId) {
                                    if (confirm("Tem certeza que deseja ativar este usuário?")) {
                                        fetch("{{ url('/admin') }}/" + userId, {
                                                method: "PATCH",
                                                headers: {
                                                    "Content-Type": "application/json",
                                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                                },
                                                body: JSON.stringify({
                                                    // Aqui você pode passar qualquer dado adicional necessário
                                                })
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                alert(data.message); // Mensagem de sucesso
                                                // Opcional: Atualizar a tabela ou redirecionar
                                                location.reload(); // Recarrega a página para refletir a ativação
                                            })
                                            .catch(error => {
                                                console.error("Erro:", error);
                                                alert("Ocorreu um erro ao ativar o usuário.");
                                            });
                                    }
                                }

                                function deletarDenuncia(denunciaId) {
                                    if (confirm("Tem certeza que deseja excluir esta denúncia?")) {
                                        fetch("{{ url('/denuncia') }}/" + denunciaId, {
                                                method: "DELETE",
                                                headers: {
                                                    "Content-Type": "application/json",
                                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                                }
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                alert(data.message); // Exibe a mensagem de sucesso
                                                location.reload(); // Recarrega a página para refletir a exclusão
                                            })
                                            .catch(error => {
                                                console.error("Erro:", error);
                                                alert("Ocorreu um erro ao excluir a denúncia.");
                                            });
                                    }
                                }
                            </script>


                        </tbody>
                    </table>

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

                            <th>Status</th>
                            <th>Curso</th>
                            <th>Ações</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $seguidoresCounts[$user->id] ?? 0 }}</td> <!-- Exibe o número de seguidores ou 0 se não houver -->
                            <td>{{ $user->status }}</td>
                            <td>{{ $user->perfil }}</td>
                            <td>
                                <button class="btn" id="btnAtiva" onclick="ativarUsuario({{ $user->id }})">
                                    Ativar
                                </button>
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
                    data: [30, 20, 15],
                    backgroundColor: ['#111111', '#151855', '#0BBDFF'],
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

        const ctx = document.getElementById('myBarChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Usuário 1', 'Usuário 2', 'Usuário 3', 'Usuário 4', 'Usuário 5'],
                datasets: [{
                    label: 'Número de Seguidores',
                    data: [100, 80, 60, 40, 20],
                    backgroundColor: '#0BBDFF',
                    borderColor: '#111111',
                    borderWidth: 1,
                    barThickness: 40,
                    barPercentage: 0.5,
                    categoryPercentage: 0.5
                }]
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 120,
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Seguidores dos Usuários',
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
</body>

</html>