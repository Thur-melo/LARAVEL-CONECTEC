<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('assets/css/admin.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/navbarAdm.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

</head>
<body>

<nav class="navbar">
    <h1 class="title">Eae</h1>
    <div class="user">
    <h6>eu</h6>
    </div>
</nav>
    <div class="main">
        <div class="sidebarAdm">

        <a href="{{ route('adminHome') }}" class="sidebarBotao ">
            <span class="material-symbols-outlined">search</span>
            <h2>Perguntas</h2>
        </a>
        <a href="{{ route('admin') }}"class="sidebarBotao active">
            <span class="material-symbols-outlined">search</span>
            <h2>Análises</h2>
        </a>

        </div>
        <div class="ConteudoAdm">
            <div class="cardAdm" id="CardQntUser">
                    <span class="material-symbols-outlined" style=" font-size: 32px; /* Ajuste o tamanho do ícone aqui */
                    color: white;">
                    check_circle
                    </span>
                <h3> {{ $qnt_users }}</h3>
                <h3>Total Usuários</h3>
            </div>
            <div class="cardAdm" id="CardQntUser2" >
                    <span class="material-symbols-outlined" style=" font-size: 32px; /* Ajuste o tamanho do ícone aqui */
                    color: white;">
                    check_circle
                    </span>
                <h3> {{ $qnt_aprovados }}</h3>
                <h3>Perguntas Aprovadas</h3>
            </div>
            <div class="cardAdm" id="CardQntUser3">
                    <span class="material-symbols-outlined" style=" font-size: 32px; /* Ajuste o tamanho do ícone aqui */
                    color: white;">
                    check_circle
                    </span>
                <h3> {{ $qnt_pendentes }}</h3>
                <h3>Perguntas Pendentes:</h3>
            </div>
        </div>
    </div>
 

</body>
</html>