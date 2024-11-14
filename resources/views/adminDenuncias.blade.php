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
            <li><a href="{{ route('admin') }}" >Úsuario</a></li>
            <li><a href="{{ route('adminHome') }}" >Postagens</a></li>
            <li><a href="{{ route('preferenciasLista') }}">Preferências</a></li>
            <li><a href="{{ route('denuncias') }}">Denúncias</a></li>
            <li class="logout">
                <a href="#logout">Logout <span class="material-symbols-outlined icon-logout">logout</span></a>
            </li>
        </ul>
    </div>
    <!-- sidebar fim -->

    <!-- cards inicio -->
    <div class="container">
        <div class="busca">
            <input type="text" class="inputBusca" id="inputBusca" placeholder="Buscar denúncia..." onkeyup="buscarDenuncias()">
            <i class="fa-solid fa-magnifying-glass ico"></i>
        </div>

        <h2>Usuários denunciados</h2>
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
                <tbody id="usuariosTable">
                    @foreach($denunciasUser as $denuncia)
                    <tr>
                        <td>{{ $denuncia->id }}</td>
                        <td>{{ $denuncia->userDenunciado->name }}</td>
                        <td>{{ $denuncia->motivo }}</td>
                        <td>{{ $denuncia->userDenunciado->status }}</td>
                        <td>
                            <button class="btn" id="btnAtivaDesativa"
                                onclick="toggleStatusUsuario({{ $denuncia->userDenunciado->id }}, '{{ $denuncia->userDenunciado->status }}')">
                                {{ (strtolower($denuncia->userDenunciado->status) === 'ativo') ? 'Desativar' : 'Ativar' }}
                            </button>
                        </td>
                        <td>
                            <button onclick="deletarDenuncia({{ $denuncia->id }})" class="btn" id="relevar">Relevar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h2>Posts denunciados</h2>
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
                    <tbody id="postsTable">
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
                                <form action="{{ route('posts.destroy', $denuncia->post->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" id="excluirPost">Excluir Post</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('user.off', $denuncia->user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" id="btnDesativa" onclick="return confirm('Tem certeza que deseja Desativar este usuário?')">
                                        Desativar usuário
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Modal -->
        <div id="modal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <div id="modal-content"></div>
            </div>
        </div>

        <script>
            function closeModal() {
                document.getElementById('modal').style.display = 'none';
            }

            function buscarDenuncias() {
                const buscaTermo = document.getElementById('inputBusca').value;

                fetch(`{{ route('denuncia.buscar') }}?termo=${buscaTermo}`, {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                })
                .then(response => response.json())
                .then(data => {
                    atualizarTabelasDenuncias(data.denunciasUser, data.denunciasPosts);
                })
                .catch(error => {
                    console.error("Erro ao buscar denúncias:", error);
                });
            }

            function atualizarTabelasDenuncias(denunciasUser, denunciasPosts) {
                const tabelaUsuarios = document.getElementById('usuariosTable');
                tabelaUsuarios.innerHTML = "";
                denunciasUser.forEach(denuncia => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${denuncia.id}</td>
                        <td>${denuncia.userDenunciado.name}</td>
                        <td>${denuncia.motivo}</td>
                        <td>${denuncia.userDenunciado.status}</td>
                        <td>
                            <button class="btn" onclick="toggleStatusUsuario(${denuncia.userDenunciado.id}, '${denuncia.userDenunciado.status}')">
                                ${denuncia.userDenunciado.status === 'ativo' ? 'Desativar' : 'Ativar'}
                            </button>
                        </td>
                        <td>
                            <button onclick="deletarDenuncia(${denuncia.id})" class="btn">Relevar</button>
                        </td>
                    `;
                    tabelaUsuarios.appendChild(row);
                });

                const tabelaPosts = document.getElementById('postsTable');
                tabelaPosts.innerHTML = "";
                denunciasPosts.forEach(denuncia => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${denuncia.id}</td>
                        <td>${denuncia.user.name}</td>
                        <td><a href="javascript:void(0);" onclick="abrirModalPost(${denuncia.post.id})">${denuncia.post.titulo || 'Ver Post'}</a></td>
                        <td>${denuncia.motivo}</td>
                        <td>${denuncia.status}</td>
                        <td>${denuncia.created_at}</td>
                        <td>
                            <form action="/posts/${denuncia.post.id}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn">Excluir Post</button>
                            </form>
                        </td>
                        <td>
                            <form action="/users/${denuncia.user.id}/off" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn">Desativar Usuário</button>
                            </form>
                        </td>
                    `;
                    tabelaPosts.appendChild(row);
                });
            }

            function abrirModalPost(postId) {
                fetch(`/posts/${postId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modal-content').innerHTML = html;
                    document.getElementById('modal').style.display = 'block';
                });
            }

            function deletarDenuncia(denunciaId) {
                if (confirm("Tem certeza que deseja excluir essa denúncia?")) {
                    fetch(`/denuncias/${denunciaId}`, {
                        method: 'DELETE',
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Denúncia excluída com sucesso.");
                            location.reload(); 
                        } else {
                            alert("Erro ao excluir denúncia.");
                        }
                    });
                }
            }

            function toggleStatusUsuario(userId, currentStatus) {
                const newStatus = currentStatus === 'ativo' ? 'desativado' : 'ativo';
                fetch(`/users/${userId}/status`, {
                    method: 'PATCH',
                    body: JSON.stringify({ status: newStatus }),
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert("Status atualizado com sucesso.");
                    location.reload();
                });
            }
        </script>
    </div>
</body>
</html>
