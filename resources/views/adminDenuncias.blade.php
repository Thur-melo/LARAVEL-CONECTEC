<!-- resources/views/denuncias/index.blade.php -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todas as Denúncias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('assets/css/adminDenuncias.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/postagens.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/home.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=warning" />


</head>
<body>

       <!--inicio menu lateral -->
       <div class="menu-lateral">
        <div class="brand-name">
            <img src="{{url('assets/img/logoConectec3.png')}}" id="logo" alt="">
        </div>
        <ul>
        <li><a href= "{{ route('admin') }}" >Úsuario</a></li>
            <li><a href= "{{ route('adminHome') }}" >Postagens</a></li>
            <li><a href="{{ route('preferenciasLista') }}">Preferências</a></li>
            <li><a href="{{ route('denuncias') }}">Denúncias</a></li>

            
        </ul>
        
    </div>

    <!--final menu lateral -->

    <div class="container ">
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
<!-- Modal -->
<div id="modal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="modal-content">
            <!-- O conteúdo do post será inserido aqui -->
        </div>
    </div>
</div>
<script>
    function closeModal() {
        document.getElementById('modal').style.display = 'none';
    }
</script>

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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
