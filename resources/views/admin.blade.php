<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADM - Análises</title>

    <!-- Estilos e ícones -->
    <link rel="stylesheet" href="{{url('assets/css/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>

    <!-- Menu lateral -->
    <div class="menu-lateral">
    <div class="brand-name">
        <img src="{{url('assets/img/logoConectec3.png')}}" id="logo" alt="">
    </div>

    <div class="menu-content">
        <ul>
            <a href="{{ route('adminHome') }}" class="sidebarBotao active">
                <li> <span class="material-icons" id="icons">post_add</span> <span>Postagens</span> </li>
            </a>
            <a href="{{ route('admin') }}" class="sidebarBotao active">
                <li> <span class="material-icons" id="icons">people</span> <span>Usuários</span> </li>
            </a>

            
            <a href="{{ route('preferenciasLista') }}" class="sidebarBotao active">
                <li> <span class="material-icons" id="icons">star</span> <span>preferências </span> </li>
            </a>
            <!-- <a href="{{ route('preferenciasLista') }}" class="sidebarBotao active">
                <li> <span class="material-icons" id="icons">star</span> <span>Preferências</span> </li>
            </a> -->
        </ul>

        <!-- Botão de logout -->
        <a href="{{ route('logout') }}" class="logout1">
           
           <span class="material-icons" id="icons">logout</span>
           <span>Sair</span>
     
   </a>
    </div>
</div>
</div>


    <!-- Conteúdo principal -->
    <div class="container">
        <div class="content">
            <div class="cards">

                <!-- Card "Usuários Totais" -->
                <div class="card" style="border-left: 5px solid #FED142" id="btnUsuariosTotais">
                    <div class="box">
                        <h1>{{$qnt_users}}</h1>
                        <h3>Usuários Totais</h3>
                    </div>
                </div>

                <!-- Outros cards -->
                <div class="card" style="border-left: 5px solid #00B3FF">
                    <div class="box">
                        <h1>{{$qnt_alunos}}</h1>
                        <h3>Total de Aluno Ds</h3>
                    </div>
                    <div class="icon-case">
                            <i class="fa-solid fa-user-tie"></i>
                        </span>
                    </div>
                </div>

                <div class="card" style="border-left: 5px solid #2DD683">
                    <div class="box">
                        <h2>{{$qnt_professores}}</h2>
                        <h3>Total de Aluno Nutrição</h3>
                    </div>
                    <div class="icon-case">
                            <i class="fa-solid fa-user-graduate"></i>
                        </span>
                    </div>
                </div>

                <div class="card" style="border-left: 5px solid #FA8B3A">
                    <div class="box">
                        <h2>{{$qnt_outros}}</h2>
                        <h3>Total de Aluno ADM</h3>
                    </div>
                </div>
            </div>

            <!-- Modal para "Usuários Totais" -->
            <div id="modalUsuarios" class="modal">
                <div class="modal-content">
                    <span class="close" id="closeModal">&times;</span>
                    <h2>Usuários Totais</h2>

                    <!-- Tabela de Usuários -->
                    <div class="tabela-usuarios">
                        @if($users->isEmpty())
                            <h3>Sem Usuários Cadastrados</h3>
                        @else
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status}}</td>
                                    <td>
                                        <div class="statusDiv">
                                            <form action="{{ route('user.off', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btnStatus" id="btnDesativa"
                                                    onclick="return confirm('Tem certeza que deseja Desativar este usuário?')">
                                                    Desativar
                                                </button>
                                            </form>
                                            <form action="{{ route('user.ativa', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btnStatus" id="btnAtiva"
                                                    onclick="return confirm('Tem certeza que deseja Ativar este usuário?')">
                                                    Ativar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>



            <!-- Gráfico SVG -->
            <div class="grafico-container">

                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);
            
                  function drawChart() {
            
                    
              var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      ['DS',     33],
      ['ADM',      33],
      ['NUTRI',  33],
     
    ]);

    var options = {
      title: 'Total de alunos por curso',
      titleTextStyle: {
        color: '#3e3e3e',  // Cor do título
        fontSize: 20,       // Tamanho da fonte
        bold: true          // Negrito
      },
      pieSliceText: 'percentage',  // Exibe o percentual dentro das fatias
      pieSliceTextStyle: {
        color: 'white',  // Cor do texto das fatias
        fontSize: 14     // Tamanho do texto
      },
      colors: ['#2DD683', '#00B3FF', '#FA8B3A'],  // Cores das fatias
      pieStartAngle: 270,  // Ângulo inicial
      legend: {
        position: 'bottom',  // Posiciona a legenda abaixo
        alignment: 'center', // Alinha ao centro
        textStyle: {
          fontSize: 14,  // Tamanho da fonte da legenda
          color: '#555'  // Cor do texto da legenda
        }
      },
      backgroundColor: 'transparent',  // Remove o fundo do gráfico
      chartArea: {
        width: '90%', height: '90%',  // Ajuste da área do gráfico
        backgroundColor: 'transparent'  // Garante que o fundo da área do gráfico seja transparente
      }
    };
            
                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            
                    chart.draw(data, options);
                  }
                </script>
             
           
                <div id="piechart" style="width: 900px; height: 500px; " ></div>
                
                <svg width="480" height="600">
                    <text x="30" y="70" font-size="25" fill="black">Crescimento de Usuários</text>

                    <!-- Barras do gráfico -->
                    <rect x="50" y="300" width="60" height="260" class="bar" />
                    <rect x="160" y="260" width="60" height="300" class="bar" />
                    <rect x="270" y="420" width="60" height="140" class="bar" />
                    <rect x="380" y="375" width="60" height="190" class="bar" />

                    <!-- Valores das barras -->
                    <text x="70" y="290" font-size="14" fill="black" font-weight="bold">60</text>
                    <text x="180" y="250" font-size="14" fill="black" font-weight="bold">80</text>
                    <text x="290" y="410" font-size="14" fill="black" font-weight="bold">20</text>
                    <text x="400" y="370" font-size="14" fill="black" font-weight="bold">50</text>

                    <!-- Rótulos dos meses -->
                    <text x="60" y="580" font-size="14" fill="black">Julho</text>
                    <text x="170" y="580" font-size="14" fill="black">Agosto</text>
                    <text x="272" y="580" font-size="14" fill="black">Setembro</text>
                    <text x="385" y="580" font-size="14" fill="black">Outubro</text>
                </svg>
    </div>

    <!-- Scripts para o modal -->
    <script>
        document.getElementById('btnUsuariosTotais').addEventListener('click', function () {
            document.getElementById('modalUsuarios').style.display = 'block';
        });

        document.getElementById('closeModal').addEventListener('click', function () {
            document.getElementById('modalUsuarios').style.display = 'none';
        });

        window.onclick = function (event) {
            if (event.target == document.getElementById('modalUsuarios')) {
                document.getElementById('modalUsuarios').style.display = 'none';
            }
        }
    </script>

</body>

</html>
