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

</head>

<body>

    <!--inicio menu lateral -->

    <div class="menu-lateral">
        <div class="brand-name">
            <img src="{{url('assets/img/logoConectec.png')}}" id="logo" alt="">
        </div>
        <ul>
        <a href="{{ route('adminHome') }}" class="sidebarBotao active">
            <li> <span class="material-icons" id="icons">post_add</span> <span>Postagens</span> </li>
        </a>
        <a href="{{ route('admin') }}" class="sidebarBotao active">
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
                <div class="text">
                </div>
                <div class="buscar">
                    <input type="text" placeholder="Pesquisar...">
                </div>
                <div class="usuario">
                    <img src="{{url('assets/img/perfil.jpg')}}" alt="Perfil">
                </div>
                
            </div>
            <div class="botaoLogar">
            <a href="{{ route('login') }}"><button>Logar como usuario</button></a>
            </div>
            <div class="botaoLogar">
            <a href="{{ route('registerAdm') }}"><button>Cadastrar um novo adm</button></a>
            </div>
        </div>
        <div class="content">
            <div class="cards">

                <div class="card">
                    <div class="box">
                        <h1>{{$qnt_users}}</h1>
                        <h3>Usuários Totais</h3>
                    </div>
                    <div class="icon-case">
                        <span class="material-icons" id="icons-card">people</span>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <h1>{{$qnt_alunos}}</h1>
                        <h3>Total de Alunos</h3>
                    </div>
                    <div class="icon-case">
                        <span class="material-icons" id="icons-card"> <i class="fa-solid fa-user-tie"></i></span>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <h2>{{$qnt_professores}}</h2>
                        <h3>Total de Professores</h3>
                    </div>
                    <div class="icon-case">
                        <span class="material-icons" id="icons-card"> <i class="fa-solid fa-user-graduate"></i></span>
                    </div>
                </div>



                <div class="card">
                    <div class="box">
                        <h2>{{$qnt_outros}}</h2>

                        <h3>Outros</h3>
                    </div>
                    <div class="icon-case">
                        <span class="material-icons" id="icons-card">
                            <i class="fa-regular fa-circle-question"></i>
                    </div>
                    </span>
                </div>
            </div>
            <div class="content2">
                <div class="tabela-usuarios">
                    @if($users->isEmpty())
                    <h1>Sem Usuários Cadastrados</h1>
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
                                            <button type="submit" class="btnStatus" id="btnDesativa" onclick="return confirm('Tem certeza que deseja Desativar este usuário?')">
                                                Desativar
                                            </button>
                                        </form>
                                        <form action="{{ route('user.ativa', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btnStatus" id="btnAtiva" onclick="return confirm('Tem certeza que deseja Ativar este usuário?')">
                                                Ativar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</body>

</html>