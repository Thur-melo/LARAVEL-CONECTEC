<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADM - Análises</title>

    <!-- icons -->
    <link rel="stylesheet" href="{{url('assets/css/adminPreferencias.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://unpkg.com/heroicons@1.0.0/dist/outline.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=logout" rel="stylesheet">

    <!--icons -->

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- font -->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>

.btn-adm {
    display: inline-block;
    padding: 10px 20px;
    color: #ffffff;
    background-color: #0BBDFF;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    text-transform: uppercase;
    transition: background-color 0.3s;
    margin-left: px;
    margin-top: 100px;
}

.btn-adm:hover {
    background-color: #0A9ED5;
}


    </style>
<body>

    <!--inicio menu lateral -->
    <div class="sidebar">
        <img src="{{url('assets/img/logoConectec4.png')}}" class="logo-sidebar" alt="">
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href= "{{ route('admin') }}" >Úsuario</a></li>
            <li><a href= "{{ route('adminHome') }}" >Postagens</a></li>
            <li><a href="{{ route('preferenciasLista') }}">Preferências</a></li>
               
                <li class="logout">
    <a href="#logout">Logout <span class="material-symbols-outlined icon-logout">logout</span></a>

</li>

</li>
        </ul>
    </div>
    <!--final menu lateral -->
       
    
    

    <div class="container">
        <div class="containerCards">

        <div class="card" id="btncadastroPreferencia" style="background-color: #222222;">
            <h1>{{$qnt_preferencia}}</h1>
            <h3>Preferências Totais</h3>
            <div class="hover-text">Editar Preferências Totais</div>
            </div>

            <div class="card" id="btncadastroPreferencia" style="background-color: #151855;">
            <h1>{{$qnt_Outro}}</h1>
            <h3>Preferências Outros</h3>
            <div class="hover-text">Editar</div>
            </div>

            <div class="card" id="btncadastroPreferencia" style="background-color: #1E2A61  ;">             
            <h1>{{$qnt_DS}}</h1>
            <h3>Preferências DS</h3>
            <div class="hover-text">Editar</div>
            </div>

            <div class="card" id="btncadastroPreferencia" style="background-color: #388E3C   ;">      
            <h1>{{$qnt_Nutri}}</h1>
            <h3>Preferências Nutrição</h3>
            <div class="hover-text">Editar</div>
            </div>

            <div class="card" id="btncadastroPreferencia" style="background-color: #1E2A61 xa   ;">            
            <h1>{{$qnt_ADM}}</h1>
            <h3>Preferências ADM</h3>
            <div class="hover-text">Editar </div>
            </div>
        </div>
    </div>
                <div class="container">
                <div class="svg-container">
            <svg>
                
                <!-- Título centralizado -->
                <text x="500" y="50" class="title">Número de Preferências Cadastradas por Curso</text>

                <!-- Eixo X -->
                <line x1="100" y1="400" x2="900" y2="400" class="axis" stroke="#333" stroke-width="2" />

                <!-- Barras do Gráfico -->
                @php
                    $cursosEspecificos = ['D.S', 'Nutrição', 'ADM', 'Outro'];
                    $coresBarras = [
                        'D.S' => '#0051ffec',
                        'Nutrição' => '#3ea043ec',
                        'ADM' => '#ff0000b0',
                        'Outro' => '#686A6C',
                    ];
                @endphp

                @foreach($cursosEspecificos as $index => $curso)
                    @php
                        $qnt_postagens = $qnt_postCursos[$curso]->total ?? 0;
                        $qnt_postagens = is_numeric($qnt_postagens) ? $qnt_postagens : 0;
                        $barHeight = $qnt_postagens * 2;
                        $yPosition = 400 - $barHeight * 5;
                        $xPosition = 200 + ($index * 180);
                    @endphp
                    
                    <!-- Barras -->
                    <rect x="{{ $xPosition }}" y="{{ $yPosition }}" width="80" height="{{ $barHeight * 5 }}" class="bar" style="fill: {{ $coresBarras[$curso] ?? '#ccc' }};"/>
                    
                    <!-- Valores Acima das Barras -->
                    <text x="{{ $xPosition + 40 }}" y="{{ $yPosition - 20 }}" class="value">{{ $qnt_postagens }}</text>
                    
                    <!-- Rótulos Abaixo das Barras -->
                    <text x="{{ $xPosition + 40 }}" y="420" class="label">{{ $curso }}</text>
                @endforeach
            </svg>
        </div>
        </div>
            
                      

            <!-- Modal -->
            <div id="modalUsuarios" class="modal">
                <div class="modal-content">
                    <span class="close" id="closeModal">&times;</span>
                    <h2>Preferências Totais</h2>
                
          

                <form  action="{{route('preferenciasLista')}}" method="get">
                    <div class="search-container">
                        <input  type="search" class="search-input"  id="s" name="s" placeholder="Pesquisar...">
                        <button class="search-button">   <i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    </form>

                    <!-- <form method="GET" action="{{ route('preferenciasLista' ) }}">
                                    <select name="selectCurso" onchange="this.form.submit()">
                                    <option value="geral">todos</option>
                                        <option value="DS">DS</option>
                                        <option value="nutrição">Nutrição</option>
                                        <option value="ADM" >ADM</option>
                                    </select>
                                </form> -->


                    <!-- Tabela de Usuários no Modal -->
                    <div class="tabela-usuarios">
                        @if($preferenciasLista->isEmpty())
                        <h3>Sem Preferências Cadastrados</h3>
                        @else
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Curso</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            @foreach($preferenciasLista as $preferencia)
                            <tbody>
                                <tr>
                                    <td>{{ $preferencia->id }}</td>
                                    <td>{{ $preferencia->name }}</td>
                                    <td>{{ $preferencia->curso }}</td>
                                    <td>
                                        <div class="statusDiv">
                                            <form action="{{ route('preferenciasLista.destroy', $preferencia->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btnStatus" id="btnDesativa"
                                                    onclick="return confirm('Tem certeza que deseja EXCLUIR este usuário?')">
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>

            

            <!-- modal DS -->

               <div id="modalDS" class="modal">
                <div class="modal-content">
                    <span class="close" id="closeModalDs">&times;</span>
                    <h2>Preferências Desenvolvimento de Sistemas</h2>
                
          

                <form  action="{{route('preferenciasLista')}}" method="get">
                    <div class="search-container">
                        <input  type="search" class="search-input"  id="s" name="s" placeholder="Pesquisar...">
                        <button class="search-button">   <i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    </form>

                    <!-- <form method="GET" action="{{ route('preferenciasLista' ) }}">
                                    <select name="selectCurso" onchange="this.form.submit()">
                                    <option value="geral">todos</option>
                                        <option value="DS">DS</option>
                                        <option value="nutrição">Nutrição</option>
                                        <option value="ADM" >ADM</option>
                                    </select>
                                </form> -->


                    <!-- Tabela de Usuários no Modal -->
                    <div class="tabela-usuarios">
                        @if($preferenciasLista->isEmpty())
                        <h3>Sem Preferências Cadastrados</h3>
                        @else
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Curso</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            @foreach($preferenciasListaDS as $preferencia)
                            <tbody>
                                <tr>
                                    <td>{{ $preferencia->id }}</td>
                                    <td>{{ $preferencia->name }}</td>
                                    <td>{{ $preferencia->curso }}</td>
                                    <td>
                                        <div class="statusDiv">
                                            <form action="{{ route('preferenciasLista.destroy', $preferencia->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btnStatus" id="btnDesativa"
                                                    onclick="return confirm('Tem certeza que deseja EXCLUIR este usuário?')">
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>

            <!-- modal Nutri -->

            <div id="modalNutri" class="modal">
                <div class="modal-content">
                    <span class="close" id="closeModalNutri">&times;</span>
                    <h2>Preferências Nutrição</h2>
                
          

                <form  action="{{route('preferenciasLista')}}" method="get">
                    <div class="search-container">
                        <input  type="search" class="search-input"  id="s" name="s" placeholder="Pesquisar...">
                        <button class="search-button">   <i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    </form>

                    <!-- <form method="GET" action="{{ route('preferenciasLista' ) }}">
                                    <select name="selectCurso" onchange="this.form.submit()">
                                    <option value="geral">todos</option>
                                        <option value="DS">DS</option>
                                        <option value="nutrição">Nutrição</option>
                                        <option value="ADM" >ADM</option>
                                    </select>
                                </form> -->


                    <!-- Tabela de Usuários no Modal -->
                    <div class="tabela-usuarios">
                        @if($preferenciasLista->isEmpty())
                        <h3>Sem Preferências Cadastrados</h3>
                        @else
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Curso</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            @foreach($preferenciasListaNutri as $preferencia)
                            <tbody>
                                <tr>
                                    <td>{{ $preferencia->id }}</td>
                                    <td>{{ $preferencia->name }}</td>
                                    <td>{{ $preferencia->curso }}</td>
                                    <td>
                                        <div class="statusDiv">
                                            <form action="{{ route('preferenciasLista.destroy', $preferencia->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btnStatus" id="btnDesativa"
                                                    onclick="return confirm('Tem certeza que deseja EXCLUIR este usuário?')">
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>


            <!-- Modal Adm -->

            <div id="modalADM" class="modal">
                <div class="modal-content">
                    <span class="close" id="closeModalADM">&times;</span>
                    <h2>Preferências Administração</h2>
                
          

                <form  action="{{route('preferenciasLista')}}" method="get">
                    <div class="search-container">
                        <input  type="search" class="search-input"  id="s" name="s" placeholder="Pesquisar...">
                        <button class="search-button">   <i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    </form>

                    <!-- <form method="GET" action="{{ route('preferenciasLista' ) }}">
                                    <select name="selectCurso" onchange="this.form.submit()">
                                    <option value="geral">todos</option>
                                        <option value="DS">DS</option>
                                        <option value="nutrição">Nutrição</option>
                                        <option value="ADM" >ADM</option>
                                    </select>
                                </form> -->


                    <!-- Tabela de Usuários no Modal -->
                    <div class="tabela-usuarios">
                        @if($preferenciasLista->isEmpty())
                        <h3>Sem Preferências Cadastrados</h3>
                        @else
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Curso</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            @foreach($preferenciasListaADM as $preferencia)
                            <tbody>
                                <tr>
                                    <td>{{ $preferencia->id }}</td>
                                    <td>{{ $preferencia->name }}</td>
                                    <td>{{ $preferencia->curso }}</td>
                                    <td>
                                        <div class="statusDiv">
                                            <form action="{{ route('preferenciasLista.destroy', $preferencia->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btnStatus" id="btnDesativa"
                                                    onclick="return confirm('Tem certeza que deseja EXCLUIR este usuário?')">
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Outro -->

            <div id="modalOutro" class="modal">
                <div class="modal-content">
                    <span class="close" id="closeModalOutro">&times;</span>
                    <h2>Preferências Outros</h2>
                
          

                <form  action="{{route('preferenciasLista')}}" method="get">
                    <div class="search-container">
                        <input  type="search" class="search-input"  id="s" name="s" placeholder="Pesquisar...">
                        <button class="search-button">   <i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    </form>

                    <!-- <form method="GET" action="{{ route('preferenciasLista' ) }}">
                                    <select name="selectCurso" onchange="this.form.submit()">
                                    <option value="geral">todos</option>
                                        <option value="DS">DS</option>
                                        <option value="nutrição">Nutrição</option>
                                        <option value="ADM" >ADM</option>
                                    </select>
                                </form> -->


                    <!-- Tabela de Usuários no Modal -->
                    <div class="tabela-usuarios">
                        @if($preferenciasLista->isEmpty())
                        <h3>Sem Preferências Cadastrados</h3>
                        @else
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Curso</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            @foreach($preferenciasListaOutro as $preferencia)
                            <tbody>
                                <tr>
                                    <td>{{ $preferencia->id }}</td>
                                    <td>{{ $preferencia->name }}</td>
                                    <td>{{ $preferencia->curso }}</td>
                                    <td>
                                        <div class="statusDiv">
                                            <form action="{{ route('preferenciasLista.destroy', $preferencia->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btnStatus" id="btnDesativa"
                                                    onclick="return confirm('Tem certeza que deseja EXCLUIR este usuário?')">
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>


            <!-- modal cadastro -->



            <div id="modalPreferencias" class="modal">
                <div class="modal-content">
                    <span class="close" id="closeModal2">&times;</span>
                    <h2>Cadastrar Preferencia</h2>

                    <form action="{{ route('preferenciasLista.store') }}" method="POST" id="cadastroPreferencia">
                        @csrf
                        <label for="name">Nome da Preferência:</label>
                        <input type="text" name="name" id="name" required>

                        <label for="curso">Escolha o Curso da Preferencia:</label>

                        <select id="cursos" name="curso">
                        <option value="D.S">Ds</option>
                        <option value="Nutrição">Nutrição</option>
                        <option value="ADM">ADM</option>
                        <option value="Outro">Outro</option>
                        </select>
                        <button class="btn-adm" type="submit">Cadastrar</button>
                    </form>


                </div>
            </div>
        </div>



    </div>
    </div>

    <!-- Script para abrir e fechar o modal -->
    <script>
        // Abrir o modal ao clicar no card "Usuários Totais"
        document.getElementById('btnTotal').addEventListener('click', function() {
            document.getElementById('modalUsuarios').style.display = 'block';
        });

        document.getElementById('btnDS').addEventListener('click', function() {
            document.getElementById('modalDS').style.display = 'block';
        });
        
        document.getElementById('btnNutri').addEventListener('click', function() {
            document.getElementById('modalNutri').style.display = 'block';
        });
        document.getElementById('btnADM').addEventListener('click', function() {
            document.getElementById('modalADM').style.display = 'block';
        });
        document.getElementById('btnOutro').addEventListener('click', function() {
            document.getElementById('modalOutro').style.display = 'block';
        });
    

        document.getElementById('btncadastroPreferencia').addEventListener('click', function() {
            document.getElementById('modalPreferencias').style.display = 'block';
        });
    
        // Fechar o modal ao clicar no "x"
        document.getElementById('closeModal2').addEventListener('click', function() {
            document.getElementById('modalPreferencias').style.display = 'none';
        });

        document.getElementById('closeModalDs').addEventListener('click', function() {
            document.getElementById('modalDS').style.display = 'none';
        });

        document.getElementById('closeModalNutri').addEventListener('click', function() {
            document.getElementById('modalNutri').style.display = 'none';
        });
        document.getElementById('closeModalADM').addEventListener('click', function() {
            document.getElementById('modalADM').style.display = 'none';
        });
        document.getElementById('closeModalOutro').addEventListener('click', function() {
            document.getElementById('modalOutro').style.display = 'none';
        });



        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('modalUsuarios').style.display = 'none';
        });
    

        // Fechar o modal ao clicar fora da área do modal
        window.onclick = function(event) {
            var modal = document.getElementById('modalUsuarios');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        window.onclick = function(event) {
            var modal = document.getElementById('modalPreferencias');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>

</body>

</html>