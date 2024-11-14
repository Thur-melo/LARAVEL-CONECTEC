<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Menu-principal</title>
    <link rel="stylesheet" href="{{url('assets/css/adminHome.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/adminDenuncias.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=logout" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body>
    <div class="main">
    
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
    <div class="busca">
        <input type="text" class="inputBusca" placeholder="Buscar denúncia..."> <i class="fa-solid fa-magnifying-glass ico"></i>
    </div>
    <h1>Usuários denunciados</h1>
    
    <div class="tabela">

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
                    <td>{{ $denuncia->userDenunciado->name }}</td>
                    <td>{{ $denuncia->motivo }}</td>
                    <td>{{ $denuncia->status }}</td>
                    <td>
                        <!-- Botão de Ativar/Desativar -->
                        <button class="btn" 
                            onclick="toggleStatusUsuario({{ $denuncia->userDenunciado->id }}, '{{ $denuncia->status }}')">
                            {{ $denuncia->status == 'ativo' ? 'Desativar' : 'Ativar' }}
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
        
        <script>
            // Função para alternar entre ativar e desativar o usuário
            function toggleStatusUsuario(userId, statusAtual) {
                const novaAcao = statusAtual === 'ativo' ? 'Desativar' : 'Ativar';
                const confirmMessage = `Tem certeza que deseja ${novaAcao.toLowerCase()} este usuário?`;
        
                if (confirm(confirmMessage)) {
                    const url = statusAtual === 'ativo'
                        ? "{{ route('user.desativar', '') }}/" + userId
                        : "{{ route('user.ativar', '') }}/" + userId;
        
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
                            location.reload(); // Recarrega a página para refletir a alteração de status
                        })
                        .catch(error => {
                            console.error("Erro:", error);
                            alert("Ocorreu um erro ao alterar o status do usuário.");
                        });
                }
            }
        
            function deletarDenuncia(denunciaId) {
                if (confirm("Tem certeza que deseja excluir esta denúncia?")) {
                    fetch("{{ url('/denuncia') }}/" + denunciaId, {
                            method: "DELETE",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            alert(data.message); // Exibe a mensagem de sucesso
                            location.reload(); // Recarrega a página para refletir a exclusão
                        })
                        .catch(error => {
                            console.error("Erro:", error);
                            alert("Ocorreu um erro ao excluir a denúncia.");
                        });
                }
            }
        </script>
        


            </tbody>
        </table>

    </div>

    <h1>Posts denunciados</h1>
    <div class="tabela">
     

        @if($denuncias->isEmpty())
            <p>Nenhuma denúncia encontrada.</p>
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

{{-- fim modal --}}

<script>

    
</script>

</div>



</div>
</body>
</html>
