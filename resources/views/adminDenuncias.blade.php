<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Menu-principal</title>
    <link rel="stylesheet" href="{{url('assets/css/adminDenuncias.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=logout" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body style="background-color: #E6E9EE;">
    <div class="main">
    
   <!-- sidebar inicio -->
   <div class="sidebar">
   <div class="sidebar">
        <img src="{{url('assets/img/logoConectec.png')}}" class="logo-sidebar" alt="">
        <ul>
        <li><a href= "{{ route('admin') }}" >Usuário</a></li>
            <li><a href= "{{ route('adminHome') }}" >Postagens</a></li>
            <li><a href="{{ route('denuncias') }}">Denúncias</a></li>


               
                <li class="logout">
                <a href="{{ route('login') }}">Logout <span class="material-symbols-outlined icon-logout">logout</span></a>

</li>

</li>
        </ul>
    </div>
    </div>
    <!-- sidebar fim -->

<!-- cards inicio -->


<div class="container">
       <form method="GET" action="{{ route('admin') }}">
    <div class="search-bar">
    <input type="text" class="inputBusca" id="inputBusca" placeholder="Buscar denúncia..." onkeyup="buscarDenuncias()">
    </div>
</form>

    
  

    <h2>Usuários denunciados</h2>
    
    <div class="tabela">
        @if($denunciasUser->isEmpty())
            <p class="semDenuncias">Nenhuma denúncia encontrada.</p>
        @else
        <table class="tabelaUsers2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuário denunciado</th>
                    <th>Motivo</th>
                    <th>Status</th>
                    <th>Ação</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($denunciasUser as $denuncia)
                <tr>
                    <td>{{ $denuncia->id }}</td>
                    <td>{{'@'. $denuncia->userDenunciado->arroba }}</td>
                    <td>{{ $denuncia->motivo }}</td>
                    <td>{{ $denuncia->userDenunciado->status }}</td>
                    <td>
                        <!-- Botão de Ativar/Desativar -->
                        <button class="btn" id="btnAtivaDesativa"
                        onclick="toggleStatusUsuario({{ $denuncia->userDenunciado->id }}, '{{ $denuncia->userDenunciado->status }}')">
                        {{ (strtolower($denuncia->userDenunciado->status) === 'ativo') ? 'Desativar' : 'Ativar' }}
                    </button>
                    </td>
                    <td>
                        <!-- Botão de excluir denúncia -->
                        <button onclick="deletarDenuncia({{ $denuncia->id }})" class="btn" id="relevar">Relevar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
@endif
        
        <script>
            // Função para alternar entre ativar e desativar o status do usuário
            function toggleStatusUsuario(userId, statusAtual) {
                const novaAcao = statusAtual === 'ativo' ? 'Desativar' : 'Ativar';
                const confirmMessage = `Tem certeza que deseja ${novaAcao.toLowerCase()} este usuário?`;
        
                if (confirm(confirmMessage)) {
                    const url = statusAtual === 'ativo'
                        ? `{{ url('/admin/desativar-usuario') }}/${userId}` // Usando a rota de desativar
                        : `{{ url('/admin/ativar-usuario') }}/${userId}`; // Usando a rota de ativar
        
                    fetch(url, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            alert(data.message); // Mensagem de sucesso
                            location.reload(); // Recarrega a página para refletir a alteração do status do usuário
                        })
                        .catch(error => {
                            console.error("Erro:", error);
                            alert("Ocorreu um erro ao alterar o status do usuário.");
                        });
                }
            }
        
            // Função para deletar uma denúncia
            function deletarDenuncia(denunciaId) {
                if (confirm("Tem certeza que deseja relevar esta denúncia?")) {
                    fetch(`{{ url('/denuncia') }}/${denunciaId}`, {
                            method: "DELETE",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            alert(data.message); // Exibe a mensagem de sucesso
                            location.reload(); // Recarrega a página para refletir a exclusão
                        })
                        .catch(error => {
                            console.error("Erro:", error);
                            alert("Ocorreu um erro ao relevar a denúncia.");
                        });
                }
            }
        </script>
        
        
        

    </div>

    <h2>Posts denunciados</h2>
    <div class="tabela">
        @if($denuncias->isEmpty())
            <p class="semDenuncias">Nenhuma denúncia encontrada.</p>
        @else
            <table class="tabelaUsers2 table-striped">
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
                            <!-- Exibe o status do post -->
                            <td>{{ $denuncia->post->status == 1 ? 'Ativo' : 'Desativado' }}</td>
                            <td>{{ $denuncia->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <form action="{{ route('posts.toggleStatus', $denuncia->post->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja alterar o status deste post?');">
                                    @csrf
                                    @method('PATCH')
                                    <!-- Alterna o texto do botão com base no status atual -->
                                    <button type="submit" class="btn" id="togglePostStatus">
                                        {{ $denuncia->post->status == 1 ? 'Desativar' : 'Ativar' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form id="relevarDenunciaForm{{ $denuncia->id }}" onsubmit="event.preventDefault(); relevarDenuncia({{ $denuncia->id }});">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" id="relevar" onclick="return confirm('Tem certeza que deseja relevar esta denúncia?')">
                                        Relevar
                                    </button>
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <script>
// Função para excluir a denúncia via requisição AJAX
function relevarDenuncia(denunciaId) {
    if (confirm('Tem certeza que deseja relevar esta denúncia?')) {
        fetch(`/denuncia/${denunciaId}/relevar`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao relevar a denúncia');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message);
            location.reload(); // Recarrega a página para refletir a alteração
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Não foi possível relevar a denúncia. Tente novamente.');
        });
    }
}

</script>
               <style>
.container{
    padding-left: 150px;
    
}

            </style>
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
                                                    <h3>@${post.user.arroba}</h3>
                                                    <div class="modulo-div" >
                                                        <p>${post.user.modulo} ${post.user.perfil}</p>
                                                    </div>
                                                </div>
                                                <p class="horaPost">${post.created_at}</p>
                                            </div>
                                        </div>
                                        <div class="textoPost">
                                            ${post.texto}
                                        </div>
                                        <div class="imgPostDenuncia">
                                            <a href="{{ asset('storage') }}/${post.fotoPost}" data-lightbox="gallery" data-title="Descrição da imagem">
                                                <img src="{{ asset('storage') }}/${post.fotoPost}" alt="">
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
            <style>
                
                .imgPostDenuncia img{
                    width: 100%;
                    height: 5000px;
                    object-fit: cover;
                }
                .imgPostDenuncia {
                    border-radius: 1rem;
                    margin: 0.7rem 0;
                    max-width: 100%;
                    max-height: 100%;
                    object-fit: cover;

                }
                .modal-content1{
                   max-width: 800px;
                   display: flex;
                    align-items: center;
                    justify-content: center;
                   
                }
                #modal-content{
                    width: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    
                }
                .feed1{
                    width: 100%;
                    padding: 15px;
                
                }
            </style>
            

            </table>
   



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
<style>
    .modal-content{
        width: 430px;
        height:50%;
    }
</style>
<script>
    function closeModal() {
        document.getElementById('modal').style.display = 'none';
    }
</script>
    
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

{{-- fim modal --}}




</div>



</div>


</body>
</html>