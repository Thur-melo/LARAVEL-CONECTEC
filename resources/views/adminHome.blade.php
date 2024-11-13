<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Menu-principal</title>
    <link rel="stylesheet" href="{{url('assets/css/adminHome.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=logout" rel="stylesheet">


</head>
<body>
    
   <!-- sidebar inicio -->
   <div class="sidebar">
        <img src="{{url('assets/img/logoConectec4.png')}}" class="logo-sidebar" alt="">
        <ul>
            <li><a href= "{{ route('admin') }}" >Úsuario</a></li>
            <li><a href= "{{ route('adminHome') }}" >Postagens</a></li>
            <li><a href="{{ route('preferenciasLista') }}">Preferências</a></li>
               
                <li class="logout">
    <a href="#logout">Logout <span class="material-symbols-outlined icon-logout">logout</span></a>

</li>

</li>
        </ul>
    </div>
    <!-- sidebar fim -->

<!-- cards inicio -->

<div class="container">

    </div>

    <div class="container">
        <div class="containerCards">
        <div class="card" style="background: linear-gradient(to bottom right, #ca1f13, #ee4b37);">                
            <h1>0</h1>
                <h3>Posts Bloqueados</h3>
            </div>
            <div class="card" id="cardEmAnalise" style="background: linear-gradient(to bottom right, #444444, #555555);">                
                <h1>0</h1>
                <h3>Posts em análise</h3>
            </div>
        </div>
    </div>

<!-- cards fim -->

<div class="container">
        <div class="containerTabelaUsers2">
            <div class="tabelaUsers2">
            <div>
            <div class="filtro">
    <label for="filter">Ordenar por:</label>
    <select id="filter">
        <option value="recentes">Mais Recentes</option>
        <option value="antigos">Mais Antigos</option>
        <option value="seguidos">Mais Seguidos</option>
    </select>
</div>
</div>

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
        <tr>
            <td>@vinisilva</td>
            <td>100</td>
            <td>1</td>
            <td>Ativo</td>
            <td>DS</td>
        </tr>
        <tr>
            <td>@Hygorwanderley</td>
            <td>80</td>
            <td>2</td>
            <td>Bloqueado</td>
            <td>Nutri</td>
        </tr>
        <tr>
            <td>@mariaeduarda</td>
            <td>60</td>
            <td>3</td>
            <td>Ativo</td>
            <td>ADM</td>
        </tr>
        <tr>
            <td>@tutudanado</td>
            <td>40</td>
            <td>4</td>
            <td>Ativo</td>
            <td>DS</td>
        </tr>
        <tr>
            <td>@ronnisilva</td>
            <td>20</td>
            <td>5</td>
            <td>Ativo</td>
            <td>DS</td>
        </tr>
    </tbody>
</table>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="containerTabelaUser3">
            <div class="tabelaUsers3">
                <div class="search-container">
                    <input type="text" placeholder="Buscar..." class="search-input">
                    <button class="search-button">
                        <i class="material-symbols-outlined">search</i>
                    </button>
                </div>
<style>/* Estilo geral do contêiner */
    .search-container {
        display: flex;
        align-items: center;
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
        border: 1px solid #ddd;
        border-radius: 25px;
        padding: 5px;
        background-color: #ffffff;
        height: 40px;
    }
    
    /* Estilo do campo de entrada */
    .search-input {
        flex: 1;
        border: none;
        padding: 10px;
        font-size: 16px;
        border-radius: 25px 0 0 25px;
        outline: none;
        background-color: transparent;
    }
    
    /* Estilo do botão de pesquisa */
    .search-button {
        border: none;
        background-color: blue;
        border-radius: 20px;
        cursor: pointer;
        padding: 5px 10px;
        font-size: 20px;
        color: #333;
    }
    
    .search-button i {
        font-size: 24px;
    }
    
    /* Efeito de hover para o botão */
    .search-button:hover {
        color: #007bff;
    }
    </style>                
            </div>
        </div>
    </div>
</body>
</html>
