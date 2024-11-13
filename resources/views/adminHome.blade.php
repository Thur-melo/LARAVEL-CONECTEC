<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Menu-principal</title>
    <link rel="stylesheet" href="{{url('assets/css/adminHome.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/adminDenuncias.css')}}">
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
            <li><a href="{{ route('denuncias') }}">Denúncias</a></li>


               
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

<div class="col">
    
<style>
    .col{
        display: block;
    }
    .red{
        background-color: #ca1f13;
        height: auto;
        width: 90%;
        margin-left: 40px;
        margin-top: 40px;
    }
</style>
<div class="red">
<div class="container1 ">
        <h1>Todas as Denúncias</h1>

        @if($denuncias->isEmpty())
            <p>Nenhuma denúncia encontrada.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Post</th>
                        <th>Motivo</th>
                        <th>Status</th>
                        <th>Data da Denúncia</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
               <!-- Tabela de Denúncias -->
               <tbody>
                @foreach($denuncias as $denuncia)
                    <tr>
                        <td>{{ $denuncia->id }}</td>
                        <td>{{ $denuncia->user->name }}</td>
                        <td>
                            <a href="javascript:void(0);" onclick="abrirModalPost({{ $denuncia->post->id }})">
                                {{ $denuncia->post->titulo ?? 'Ver Post' }}
                            </a>
                        </td>
                        <td>{{ $denuncia->motivo }}</td>
                        <td>{{ ucfirst($denuncia->status) }}</td>
                        <td>{{ $denuncia->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{route('posts.destroy', $denuncia->post->id)}}" method="POST" onsubmit="return confirm('tem certeza que deseja excluir este post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" id="excluirPost" >Excluir Post</button>

                            </form>
                        </td>
                        <td>
                            <form action="{{ route('user.off', $denuncia->user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" id="btnDesativa"
                                    onclick="return confirm('Tem certeza que deseja Desativar este usuário?')">
                                    Desativar usuário
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @php
            $coresModulo = [
            '1º' => '#CD4642',
            '2º' => '#5169B1',
            '3º' => '#64B467',
            ];
            @endphp
            <script>
                function abrirModalPost(postId) {
                    // Requisição AJAX para buscar os dados do post
                    fetch(`/post/${postId}`)
                        .then(response => response.json())
                        .then(post => {
                            // Verifique se o post existe
                            if (post) {
                                let modalContent = `
                                    <div class="feed">
                                        <div class="user">
                                            <div class="profileImg">
                                                <a href="/perfil/${post.user.id}"> 
                                                    <img src="{{ asset('storage') }}/${post.user.urlDaFoto}" alt="" class="profileDenunciado">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <div class="infoHeader" style="display:flex; align-items:center; justify-content:space-between; width:100%">
                                                    <h3>@${post.user.arroba} <span class="publiSpan"> • fez uma nova publicação</span></h3>
                                                    <div class="modulo-div" style="background-color: ${post.user.modulo ? post.user.modulo : 'defaultColor'};">
                                                        <p>${post.user.modulo} ${post.user.perfil}</p>
                                                    </div>
                                                </div>
                                                <p class="horaPost">${post.created_at}</p>
                                            </div>
                                        </div>
                                        <div class="textoPost">
                                            ${post.texto}
                                        </div>
                                        <div class="imgPost">
                                            <a href="{{ asset('storage') }}/${post.fotoPost}" data-lightbox="gallery" data-title="Descrição da imagem">
                                                <img src="{{ asset('storage') }}/${post.fotoPost}" alt="" style="max-width: 100%; height: auto;">
                                            </a>
                                        </div>

                                    </div>
                                `;
            
                                // Insere o conteúdo no modal
                                document.getElementById('modal-content').innerHTML = modalContent;
                                document.getElementById('modal').style.display = 'block';
                            }
                        })
                        .catch(error => console.error('Erro ao buscar post:', error));
                }
            
                function closeModal() {
                    document.getElementById('modal').style.display = 'none';
                }
            </script>
            

            </table>
        @endif



    </div>






</div>

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
    <div id="modal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="modal-content">
            <!-- O conteúdo do post será inserido aqui -->
        </div>
    </div>
</div>
<style>


    /* Estilo do Modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;  /* Largura do modal ajustada para 50% */
    max-width: 900px;  /* Largura máxima de 900px */
    min-width: 400px;  /* Largura mínima de 400px */
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

</style>
<script>
    function closeModal() {
        document.getElementById('modal').style.display = 'none';
    }
</script>
            </div>
        </div>
    </div>
</body>
</html>
