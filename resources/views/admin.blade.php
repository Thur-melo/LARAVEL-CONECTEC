<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{url('assets/css/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
    <div class="menu-lateral">
        <div class="brand-name">
            <img src="{{url('assets/img/logoConectec.png')}}" id="logo" alt="">
        </div>
        <ul>
            <li> <span class="material-icons" id="icons">post_add</span> Postagens </li>
            <li> <span class="material-icons" id="icons">people</span> Usuários </li>
            <li> <span class="material-icons" id="icons">person</span> Administrador </li>
            <li> <span class="material-icons" id="icons">chat</span> Chat </li>

            <li id="logout"> <span class="material-icons" id="icons">logout</span> Sair </li>

        </ul>
    </div>

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
        </div>
        <div class="content">
            <div class="cards">
                
                                <div class="card">
                                    <div class="box">
                                        <h1>{{$qnt_aprovados}}</h1>
                                        <h3>Respostas aprovadas</h3>
                                    </div>
                                    <div class="icon-case">
                                        <span class="material-icons" id="icons-card">thumb_up</span>
                                    </div>
                                </div>
                
                                <div class="card">
                                    <div class="box">
                                        <h1>{{$qnt_pendentes}}</h1>
                                        <h3>Perguntas pendentes</h3>
                                    </div>
                                    <div class="icon-case">
                                        <span class="material-icons" id="icons-card">pending_actions</span>
                                    </div>
                                </div>

                <div class="card">
                    <div class="box">
                        <h2>{{$qnt_users}}</h2>
                        <h3>Posts em Análise</h3>
                    </div>
                    <div class="icon-case">
                        <span class="material-icons" id="icons-card">manage_search</span>
                    </div>
                </div>



                <div class="card">
                    <div class="box">

                        <h3>Posts Banidos</h3>
                    </div>
                    <div class="icon-case">
                    <span class="material-icons" id="icons-card">block</span>
                    </div>
                </div>
            </div>
            <div class="content2">
            <div class="tabela-usuarios">
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
            <tr>
                <td>1</td>
                <td>João Silva</td>
                <td>joao@example.com</td>
                <td>Ativo</td>
                <td>
                    <button>Editar</button>
                    <button>Deletar</button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Maria Oliveira</td>
                <td>maria@example.com</td>
                <td>Pendente</td>
                <td>
                    <button>Editar</button>
                    <button>Deletar</button>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Pedro Santos</td>
                <td>pedro@example.com</td>
                <td>Banido</td>
                <td>
                    <button>Editar</button>
                    <button>Deletar</button>
                </td>
            </tr>
            <!-- Adicione mais linhas conforme necessário -->
        </tbody>
    </table>
</div>

            </div>
        </div>
</body>

</html>