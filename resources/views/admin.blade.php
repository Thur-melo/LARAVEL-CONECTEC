<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Menu-principal</title>
    <link rel="stylesheet" href="{{url('assets/css/admin.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=warning" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilo básico para o modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            text-align: center;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <!-- sidebar inicio -->
    <div class="sidebar">
        <img src="{{url('assets/img/logoConectec4.png')}}" class="logo-sidebar" alt="">
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Úsuario</a></li>
            <li><a href="#">Postagens</a></li>
            <li><a href="#">Postagens</a></li>
            <li class="logout">
                <a href="#">Logout <span class="material-icons" style="font-size: 32px;">logout</span></a>
            </li>
            </a>
            <a href="{{ route('admin') }}" class="sidebarBotao active">
                <li> <span class="material-icons" id="icons">people</span> <span>Usuários</span> </li>
            </a>

            
            <a href="{{ route('preferenciasLista') }}" class="sidebarBotao active">
                <li> <span class="material-icons" id="icons">star</span> <span>preferências </span> </li>
            </a>

            <a href="{{ route('denuncias') }}" class="sidebarBotao active">
                <li> <span class="material-symbols-outlined">warning</span><span>denuncias </span> </li>
            </a>
            <!-- <a href="{{ route('preferenciasLista') }}" class="sidebarBotao active">
                <li> <span class="material-icons" id="icons">star</span> <span>Preferências</span> </li>
            </a> -->
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
            <div class="card" id="cardEmAnalise" style="background: linear-gradient(to bottom right, #444444, #555555);">                
                <h1>0</h1>
                <h3>Úsuarios em análise</h3>
            </div>
        </div>
    </div>
    <!-- cards dashboard fim -->

    <!-- Modal -->
    <div id="modalAnalise" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Usuários em Análise</h2>
            <p>Informações sobre os usuários que estão aguardando análise.</p>
        </div>
    </div>

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
                                    <td>                            <form action="{{ route('user.off', $denuncia->userDenunciado->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" id="btnDesativa"
                                            onclick="return confirm('Tem certeza que deseja Desativar este usuário?')">
                                            Desativar usuário
                                        </button>
                                    </form></td>

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
                    <style>
                        .tbDenuncias {
                            width: 100%;
                            border-collapse: collapse;
                            margin: 20px 0;
                            font-family: Arial, sans-serif;
                        }
                    
                        .tbDenuncias th, .tbDenuncias td {
                            padding: 6px;
                            text-align: left;
                            border: 1px solid #ddd;
                        }
                    
                        .tbDenuncias th {
                            background-color: #4989dc;
                            color: white;
                            font-size: 16px;
                        }
                    
                        .tbDenuncias tr:nth-child(even) {
                            background-color: #f2f2f2; /* Cor de fundo alternada para as linhas */
                        }
                    

                        .tbDenuncias td {
                            font-size: 14px;
                        }
                    
                        .tbDenuncias td, .tbDenuncias th {
                            text-align: center;
                        }
                    
                        /* Botão de ação para cada linha */
                        .tbDenuncias .btn-action {
                            padding: 5px 10px;
                            background-color: #007bff;
                            color: white;
                            border: none;
                            border-radius: 5px;
                            cursor: pointer;
                            text-align: center;
                        }
                    
                        .tbDenuncias .btn-action:hover {
                            background-color: #0056b3;
                        }
                    </style>
                    
                    
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
                        <tr><td>@vinisilva</td><td>100</td><td>1</td><td>Ativo</td><td>DS</td></tr>
                        <tr><td>@Hygorwanderley</td><td>80</td><td>2</td><td>Bloqueado</td><td>Nutri</td></tr>
                        <tr><td>@mariaeduarda</td><td>60</td><td>3</td><td>Ativo</td><td>ADM</td></tr>
                        <tr><td>@tutudanado</td><td>40</td><td>4</td><td>Ativo</td><td>DS</td></tr>
                        <tr><td>@ronnisilva</td><td>20</td><td>5</td><td>Ativo</td><td>DS</td></tr>
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
                    title: { display: true, text: 'Distribuição de Cursos', font: { size: 18 }},
                    legend: { position: 'bottom' },
                    tooltip: { callbacks: { label: function(tooltipItem) { return tooltipItem.label + ': ' + tooltipItem.raw + '%'; } }}
                }
            }
        });

        const ctx = document.getElementById('myBarChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Usuário 1', 'Usuário 2', 'Usuário 3', 'Usuário 4', 'Usuário 5'],
                datasets: [{ label: 'Número de Seguidores', data: [100, 80, 60, 40, 20], backgroundColor: '#0BBDFF', borderColor: '#111111', borderWidth: 1, barThickness: 40, barPercentage: 0.5, categoryPercentage: 0.5 }]
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                scales: {
                    x: { beginAtZero: true, max: 120, grid: { display: false }},
                    y: { beginAtZero: true, grid: { display: false }}
                },
                plugins: {
                    title: { display: true, text: 'Seguidores dos Usuários', font: { size: 18 }},
                    legend: { display: false },
                    tooltip: { callbacks: { label: function(tooltipItem) { return tooltipItem.label + ': ' + tooltipItem.raw + ' seguidores'; } }}
                }
            }
        });

        // Funções do Modal
        const modal = document.getElementById("modalAnalise");
        const cardEmAnalise = document.getElementById("cardEmAnalise");
        const closeModal = document.getElementsByClassName("close")[0];

        cardEmAnalise.addEventListener("click", function() {
            modal.style.display = "flex";
        });

        closeModal.onclick = function() {
            modal.style.display = "none";
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    </script>
</body>

</html>