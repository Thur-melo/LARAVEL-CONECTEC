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

            <!-- <li id="logout"> <span class="material-icons" id="icons">logout</span> Sair </li> -->

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
        </div>
        <div class="content">
            <div class="cards">

                <div class="card">
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


                <!-- <div class="card">
                    <div class="box">
                        <h2>{{$qnt_duvida}}</h2>
                        <h3>Posts Pendentes</h3>
                    </div>
                    <div class="icon-case">
                        <span class="material-icons" id="icons-card">pending_actions</span>
                    </div>
                </div>
           -->


            </div>

            @php
            $coresModulo = [
            '1º Módulo' => 'red',
            '2º Módulo' => 'blue',
            '3º Módulo' => 'green',

            ];
            @endphp

            <div class="rowContent">
                <div class="content3">
                    <div class="rowTipos">
                        <h3><i class="fa-regular fa-circle-question"></i> Posts Informativos:</h3>
                        <h2>{{$qnt_info}}</h2>
                    </div>

                    <div class="rowTipos">
                        <h3> <i class="fa-regular fa-circle-question"></i> Posts Aulas:</h3>
                        <h2>{{$qnt_aula}}</h2>
                    </div>

                    <div class="rowTipos">
                        <h3><i class="fa-regular fa-circle-question"></i> Posts Duvida:</h3>
                        <h2>{{$qnt_duvida}}</h2>


                    </div>

                    <div class="rowTipos">
                        <h3>  <i class="fa-regular fa-circle-question"></i> Posts Estagio:</h3>
                        <h2>{{$qnt_estagios}}</h2>
                    </div>
                </div>
                <div class="content2">
                    @if ($posts->isEmpty())
                    <h1>Sem perguntas pendentes</h1>
                    @else

                    @foreach($posts as $post)
                    <div class="postRow">
                        <div class="postBody">

                            <div class="postHeader">
                                <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="">
                                <div class="info">
                                    <div class="infoHeader" style="display:flex; align-items:center; justify-content:space-between; widht:100%">
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
                                    <button type="submit" class="btnStatus" id="btnAtiva" onclick="return confirm('Tem certeza que deseja mudar o status para Aprovado?')">Desativar</button>
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

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    
</body>

</html>