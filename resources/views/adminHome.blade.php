<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADM - Análises</title>

    <!-- icons -->
    <link rel="stylesheet" href="{{url('assets/css/admin.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/adminHome.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://unpkg.com/heroicons@1.0.0/dist/outline.js"></script>
    <!--icons -->

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- font -->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>

    <!--inicio menu lateral -->

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
            <!-- <a href="{{ route('preferenciasLista') }}" class="sidebarBotao active">
                <li> <span class="material-icons" id="icons">star</span> <span>Preferências</span> </li>
            </a> -->
        </ul>

        <!-- Botão de logout -->
        <a href="{{ route('logout') }}" class="logout">
           
           <span class="material-icons" id="icons">logout</span>
           <span>Sair</span>
     
   </a>
    </div>
</div>

  


    <!--final menu lateral -->

    <div class="container">
        <div class="content">
            <div class="cards">

                <!-- Card Total de Posts com ação de abrir modal -->
                <div class="card" style="border-left: 5px solid #00c9e9" id="openModalBtn">
                    <div class="box">
                        <h1>{{$qnt_posts}}</h1>
                        <h3>Total de posts</h3>
                    </div>
                    <div class="icon-case">
                    </div>
                </div>

                <div class="card" style="border-left: 5px solid #FED142" id="openModalTypesBtn">
                    <div class="box">
                        <h2>{{$qnt_tipos}}</h2>
                        <h3>Tipos de Post</h3>
                    </div>
                    <div class="icon-case">
                    </div>
                </div>

                <div class="card" style="border-left: 5px solid #ff0000">
                    <div class="box">
                        <h1>{{$qnt_postInativos}}</h1>
                        <h3>Posts inativos</h3>
                    </div>
                    <div class="icon-case">
                    </div>
                </div>

                <div class="card" style="border-left: 5px solid #2DD683">
                    <div class="box">
                        <h2>{{$qnt_postAtivos}}</h2>
                        <h3>Posts Ativos</h3>
                    </div>

                    <div class="icon-case">
                    </div>
                </div>

                <!-- Card Tipos de Post com ação de abrir modal -->
              
            </div>

            @php
            $coresModulo = [
            '1º Módulo' => 'red',
            '2º Módulo' => 'blue',
            '3º Módulo' => 'green',
            ];
            @endphp

            <div class="rowContent">


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
      ['ativos',     1],
      ['inativos',     1 ],
      ['totais',  1],
     
    ]);

    var options = {
      title: 'Total de posts',
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
      colors: ['#2DD683', '#ff0000', '#00c9e9'],  // Cores das fatias
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
                    <text x="30" y="70" font-size="25" fill="black">Numero de Postagens no último mês</text>

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



    <!-- Modal para Perguntas Pendentes -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Perguntas Pendentes</h2>

            @if ($posts->isEmpty())
            <h1>Sem perguntas pendentes</h1>
            @else
            @foreach($posts as $post)
            <div class="postRow">
                <div class="postBody">
                    <div class="postHeader">
                        <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="" style="object-fit:cover">
                        <div class="info">
                            <div class="infoHeader" style="display:flex; align-items:center; justify-content:space-between; width:100%">
                                <h3>{{ $post->user->name }}</h3>
                                <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                    <p>{{ $post->user->modulo }}</p>
                                </div>
                            </div>
                            <p>{{ $post->user->perfil }}</p>
                        </div>
                    </div>

                    <div class="tipoCont">
                        <div class="tipo-div">
                            <p>{{ $post->tipo_post }}</p>
                        </div>
                    </div>

                    <div class="postHeaderDescription">
                        <p>{{ $post->texto }}</p>
                    </div>

                    <a href="{{ asset('storage/' . $post->fotoPost) }}" data-lightbox="gallery">
                        <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="">
                    </a>

                    <div class="postFooter">
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btnStatus" id="btnDesativa" onclick="return confirm('Tem certeza que deseja deletar este post?')">Deletar</button>
                        </form>

                        <form action="{{ route('posts.desativar', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btnStatus" id="btnAtiva" onclick="return confirm('Tem certeza que deseja mudar o status para Desativado?')">Desativar</button>
                        </form>

                        <form action="{{ route('posts.aprovar', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btnStatus" id="btnAtiva" onclick="return confirm('Tem certeza que deseja mudar o status para Aprovado?')">Ativar</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>

    <!-- Modal Tipos de Post -->
    <div id="myModalTypes" class="modal">
    <div class="modal-content">
            <a href="{{ Route ('adminHome') }}">
                    <span class="close" id="closeModalADM">&times;</span>
                    </a>
                    <h2>Tipos de post</h2>


                    <!-- Tabela de Usuários no Modal -->
                    <div class="tabela-usuarios">
                        @if($preferenciasLista->isEmpty())
                        <h3>Sem Preferencias Cadastrados</h3>
                        @else
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Curso</th>
                                    <th>quantidade de Posts</th>
                                </tr>
                            </thead>
                            @foreach($preferenciasLista as $preferencia)
                            <tbody>
                                <tr>
                                    <td>{{ $preferencia->id }}</td>
                                    <td>{{ $preferencia->name }}</td>
                                    <td>{{ $preferencia->curso }}</td>
                                    <td>{{ $qnt_postTipo[$preferencia->name]->total ?? 0 }}</td>
                                </tr>
                            </tbody>
                            @endforeach
                            @endif
                        </table>
                    </div>
                </div>
    </div>

            <script>
                // Modal para Total de Posts
                var modal = document.getElementById("myModal");
                var btn = document.getElementById("openModalBtn");
                var span = document.getElementsByClassName("close")[0];

                btn.onclick = function() {
                    modal.style.display = "block";
                }

                span.onclick = function() {
                    modal.style.display = "none";
                }

                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }

                // Modal para Tipos de Post
                var modalTypes = document.getElementById("myModalTypes");
                var btnTypes = document.getElementById("openModalTypesBtn");
                var spanTypes = document.getElementsByClassName("close-types")[0];


                btnTypes.onclick = function() {
                    modalTypes.style.display = "block";
                }

                spanTypes.onclick = function() {
                    modalTypes.style.display = "none";
                }

                window.onclick = function(event) {
                    if (event.target == modalTypes) {
                        modalTypes.style.display = "none";
                    }


                }
            </script>

</body>

</html>