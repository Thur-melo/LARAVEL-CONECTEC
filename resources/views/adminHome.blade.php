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
        <ul>
            <a href="{{ route('adminHome') }}" class="sidebarBotao active">
                <li> <span class="material-icons" id="icons">post_add</span> <span>Postagens</span> </li>
            </a>
            <a href="{{ route('admin') }}" class="sidebarBotao active">
                <li> <span class="material-icons" id="icons">people</span> <span>Usuários</span> </li>
            </a>
            
            <li> <span class="material-icons" id="icons">person</span> <span>Administrador</span> </li>
            <li> <span class="material-icons" id="icons">chat</span> <span>Chat </span> </li>
            <a href="{{ route('preferenciasLista') }}" class="sidebarBotao active">
                <li> <span class="material-icons" id="icons">star</span> <span>preferências </span> </li>
            </a>
        </ul>
    </div>

    <!--final menu lateral -->

    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="text"></div>
                <!-- <div class="buscar">
                    <input type="text" placeholder="Pesquisar...">
                </div> -->
                <div class="usuario">
                    <img src="{{url('assets/img/perfil.jpg')}}" alt="Perfil">
                </div>
            </div>
        </div>
        <div class="content">
            <div class="cards">

                <!-- Card Total de Posts com ação de abrir modal -->
                <div class="card" id="openModalBtn">
                    <div class="box">
                        <h1>{{$qnt_posts}}</h1>
                        <h3>Total de posts</h3>
                    </div>
                    <div class="icon-case">
                        <span class="material-icons" id="icons-card">post_add</span>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <h1>{{$qnt_postInativos}}</h1>
                        <h3>Posts inativos</h3>
                    </div>
                    <div class="icon-case">
                        <span class="material-icons" id="icons-card"> sentiment_dissatisfied</span>
                    </div>
                </div>

                <div class="card">
                    <div class="box">
                        <h2>{{$qnt_postAtivos}}</h2>
                        <h3>Posts Ativos</h3>
                    </div>

                    <div class="icon-case">
                        <span class="material-icons" id="icons-card">pending_actions</span>
                    </div>
                </div>

                <!-- Card Tipos de Post com ação de abrir modal -->
                <div class="card" id="openModalTypesBtn">
                    <div class="box">
                        <h2>{{$qnt_tipos}}</h2>
                        <h3>Tipos de Post</h3>
                    </div>
                    <div class="icon-case">
                        <span class="material-icons" id="icons-card">pending_actions</span>
                    </div>
                </div>
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


        <svg width="600" height="350">

<text x="40" y="30">Quantidade de Post por curso</text>

<!-- Eixo Y -->

<!-- Eixo X -->
<line x1="80" y1="280" x2="520" y2="280" class="axis" />

<!-- Barras -->
<rect x="100" y="160" width="60" height="120" class="bar" />
<rect x="200" y="100" width="60" height="180" class="bar" />
<rect x="300" y="60" width="60" height="220" class="bar" />


<!-- Valores Acima das Barras -->
<text x="130" y="150" class="value">40</text>
<text x="230" y="90" class="value">60</text>
<text x="330" y="50" class="value">80</text>


<!-- Rótulos -->
<text x="110" y="300" class="label">D.S</text>
<text x="215" y="300" class="label">Nutrição</text>
<text x="310" y="300" class="label">ADM</text>



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