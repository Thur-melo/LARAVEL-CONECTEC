<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADM - Análises</title>

    <!-- icons -->
    <link rel="stylesheet" href="{{url('assets/css/admin.css')}}">
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
            <img src="{{url('assets/img/logoConectec3.png')}}" id="logo" alt="">
        </div>
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
        </ul>
    </div>

    <!--final menu lateral -->

    <div class="container">


        <div class="content">
            <div class="cards">

                <!-- Card "Usuários Totais" que agora abre o modal -->
                <div class="card" id="btnUsuariosTotais">
                    <div class="box">
                        <h1>{{$qnt_users}}</h1>
                        <h3>Usuários Totais</h3>
                    </div>
                    <div class="icon-case">
                    <span class="material-icons" id="icons-card" style="color: #111111;">groups_2</span>
                    </div>
                </div>

                <!-- Outros cards -->
                <div class="card">
                    <div class="box">
                        <h1>{{$qnt_alunos}}</h1>
                        <h3>Total de Aluno Ds</h3>
                    </div>
                    <div class="icon-case">
                        <span class="material-icons" id="icons-card" style="color: #0051ffce;"> <i class="fa-solid fa-user-tie"></i></span>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <h2>{{$qnt_professores}}</h2>
                        <h3>Total de Aluno Nutrição</h3>
                    </div>
                    <div class="icon-case">
                        <span class="material-icons" id="icons-card" style="color: #3ea043ec;"> <i class="fa-solid fa-user-graduate"></i></span>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <h2>{{$qnt_outros}}</h2>
                        <h3>Total de Aluno ADM</h3>
                    </div>
                    <div class="icon-case">
                    <span class="material-icons" id="icons-card" style="color: #ff0000b0;"> <i class="fa-solid fa-user-tie"></i></span>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div id="modalUsuarios" class="modal">
                <div class="modal-content">
                    <span class="close" id="closeModal">&times;</span>
                    <h2>Usuários Totais</h2>

            
                    
                    <!-- Tabela de Usuários no Modal -->
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
                            @foreach($users as $user)
                            <tbody>
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
                            </tbody>
                            @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>



        
     

       
            <svg width="600" height="350">

            <text x="40" y="30">Crescimento de Usúarios</text>
            
    <!-- Eixo Y -->

    <!-- Eixo X -->
    <line x1="80" y1="280" x2="520" y2="280" class="axis" />

    <!-- Barras -->
    <rect x="100" y="160" width="60" height="120" class="bar" />
    <rect x="200" y="100" width="60" height="180" class="bar" />
    <rect x="300" y="60" width="60" height="220" class="bar" />
    <rect x="400" y="200" width="60" height="80" class="bar" />
    <rect x="500" y="130" width="60" height="150" class="bar" />

    <!-- Valores Acima das Barras -->
    <text x="130" y="150" class="value">40</text>
    <text x="230" y="90" class="value">60</text>
    <text x="330" y="50" class="value">80</text>
    <text x="430" y="190" class="value">20</text>
    <text x="530" y="120" class="value">50</text>

    <!-- Rótulos -->
    <text x="110" y="300" class="label">Junho</text>
    <text x="215" y="300" class="label">Julho</text>
    <text x="310" y="300" class="label">Agosto</text>
    <text x="410" y="300" class="label">Setembro</text>
    <text x="510" y="300" class="label">Outubro</text>


</svg>

        </div>
    </div>
    
    <!-- Script para abrir e fechar o modal -->
    <script>
        // Abrir o modal ao clicar no card "Usuários Totais"
        document.getElementById('btnUsuariosTotais').addEventListener('click', function () {
            document.getElementById('modalUsuarios').style.display = 'block';
        });

        // Fechar o modal ao clicar no "x"
        document.getElementById('closeModal').addEventListener('click', function () {
            document.getElementById('modalUsuarios').style.display = 'none';
        });

        // Fechar o modal ao clicar fora da área do modal
        window.onclick = function (event) {
            var modal = document.getElementById('modalUsuarios');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>

</body>

</html>