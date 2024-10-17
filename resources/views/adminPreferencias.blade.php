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
    <!--icons -->

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- font -->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



<body>

    <!--inicio menu lateral -->
    <div class="menu-lateral">
        <div class="brand-name">
            <img src="{{url('assets/img/logoConectec.png')}}" id="logo" alt="">
        </div>
        <ul>
            <a href="{{ route('adminHome') }}" class="sidebarBotao">
                <li> <span class="material-icons" id="icons">post_add</span> <span>Postagens</span> </li>
            </a>
            <a href="{{ route('admin') }}" class="sidebarBotao">
                <li> <span class="material-icons" id="icons">people</span> <span>Usuários</span> </li>
            </a>
            <li> <span class="material-icons" id="icons">person</span> <span>Administrador</span> </li>
            <li> <span class="material-icons" id="icons">chat</span> <span>Chat </span> </li>
        </ul>
    </div>

    <!--final menu lateral -->

    <div class="container">
        <div class="header">
            <div class="nav">

                <div class="usuario">
                    <img src="{{url('assets/img/perfil.jpg')}}" alt="Perfil" class="user-img">
                    <div class="botoes">
                        <button class="btn-adm" id="btncadastroPreferencia">Cadastrar nova Preferencia</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="cards">

                <!-- Card "Usuários Totais" que agora abre o modal -->
                <div class="card" id="btnTotal">
                    <div class="box">
                        <h1>{{$qnt_preferencia}}</h1>
                        <h3>Preferencias Totais</h3>
                    </div>
                    <div class="icon-case">
                        <span class="material-icons" id="icons-card">people</span>
                    </div>
                </div>
                

                <!-- Outros cards -->
                <div class="card" id="btnDS">
                    <div class="box">
                        <h1>{{$qnt_DS}}</h1>
                        <h3>Preferencias DS</h3>
                    </div>
                    <div class="icon-case">
                        <span class="material-icons" id="icons-card"> <i class="fa-solid fa-user-tie"></i></span>
                    </div>
                </div>

                <div class="card" id="btnNutri">
                    <div class="box">
                        <h2>{{$qnt_Nutri}}</h2>
                        <h3>Preferencias Nutrição</h3>
                    </div>
                    <div class="icon-case">
                        <span class="material-icons" id="icons-card"> <i class="fa-solid fa-user-graduate"></i></span>
                    </div>
                </div>

                <div class="card" id="btnADM">
                    <div class="box">
                        <h2>{{$qnt_ADM}}</h2>
                        <h3>Preferencias ADM</h3>
                    </div>
                    <div class="icon-case">
                        <span class="material-icons" id="icons-card">
                            <i class="fa-regular fa-circle-question"></i>
                        </span>
                    </div>
                </div>

                <div class="card" id="btnOutro">
                    <div class="box">
                        <h1>{{$qnt_Outro}}</h1>
                        <h3>Preferencias Outros</h3>
                    </div>
                    <div class="icon-case">
                        <span class="material-icons" id="icons-card">people</span>
                    </div>
                </div>

            </div>
         
            
                      

            <!-- Modal -->
            <div id="modalUsuarios" class="modal">
                <div class="modal-content">
                    <span class="close" id="closeModal">&times;</span>
                    <h2>Preferencias Totais</h2>
                
          

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
                        <h3>Sem Preferencias Cadastrados</h3>
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
                    <h2>Preferencias Desenvolvimento de Sistemas</h2>
                
          

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
                        <h3>Sem Preferencias Cadastrados</h3>
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
                    <h2>Preferencias Nutrição</h2>
                
          

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
                        <h3>Sem Preferencias Cadastrados</h3>
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
                    <h2>Preferencias Administração</h2>
                
          

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
                        <h3>Sem Preferencias Cadastrados</h3>
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
                    <h2>Preferencias Outros</h2>
                
          

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
                        <h3>Sem Preferencias Cadastrados</h3>
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