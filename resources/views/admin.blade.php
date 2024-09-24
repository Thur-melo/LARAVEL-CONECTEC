<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{url('assets/css/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="menu-lateral">
        <div class="brand-name">
            <h1>Conectec</h1>
        </div>
        <ul>
            <li> <i class="fa-solid fa-chart-line" id="icons"> </i>Dashboard</li>
            <li> <i class="fa-solid fa-users" id="icons"> </i>Usuários</li>
            <li> <i class="fa-solid fa-user" id="icons"> </i>Administrador</li>
            <li> <i class="fa-regular fa-comment" id="icons"></i>Chat</li>
        </ul>
        
        <button class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket" id="icons"></i>Logout</button>
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
                        <h2>sim</h2>
                        <h3>Usuários</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-user" id="icons-card"></i>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <h1>1m</h1>
                        <h3>Usuários</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-user" id="icons-card"></i>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <h1>1m</h1>
                        <h3>Usuários</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-user" id="icons-card"></i>
                    </div>
                </div>

                

                <div class="card">
                    <div class="box">

                        <h3>Usuários</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-user" id="icons-card"></i>
                    </div>
                </div>
            </div>
            <div class="content2">
                <div class="tabela-usuarios"></div>
                <div class="novo-usuarios"></div>
            </div>
        </div>
</body>

</html>