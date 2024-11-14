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
        <img src="{{url('assets/img/logoConectec.png')}}" class="logo-sidebar" alt="">
        <ul>
        <li><a href= "{{ route('admin') }}" >Usuário</a></li>
            <li><a href= "{{ route('adminHome') }}" >Postagens</a></li>
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
<div class="search-bar">
<form method="GET" action="{{ route('adminHome') }}">
        <input type="text" name="search" id="search" placeholder="Pesquisar Posts..." value="{{ old('search') }}">
        <button type="submit">Pesquisar</button> <!-- Botão de pesquisa -->
</form>
    </div>
    </div>

    <div class="container">
        <div class="containerCards">
        <div class="card" >                
            <h1>{{$posts->count()}}</h1>
                <h3>Posts totais</h3>
            </div>
            <div class="card" id="cardEmAnalise">                
                <h1>{{$postInativos}}</h1>
                <h3>Posts Bloqueados </h3>
            </div>

            <div class="card" id="cardEmAnalise" >                
                <h1>{{$postAtivos}}</h1>
                <h3>Posts ativos </h3>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="containerCards2">
        <div class="card2" >                
<canvas id="myPieChart" width="200" height="200"></canvas>
            </div>
            <div class="card2" >                
            <canvas id="myChart"></canvas>
            </div>

           <div class="card2" id="cardModal">
    <h1>Modal</h1>
    <h3>Hashtag totais</h3>
</div>
        </div>
    </div>

    <div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="containerTabelaUsers2">
            <div class="tabelaUsers2">
            <div>
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
</div>

<!-- cards fim -->

<div class="container">
        <div class="containerTabelaUsers2">
            <div class="tabelaUsers2">
            <div>

            <div class="filtro">
            <label for="filter">Ordenar por:</label>
<form action="{{ route('adminHome') }}" method="GET">
    <select name="filter" id="filter" onchange="this.form.submit();">
        <option value="todos" {{ request('filter') == 'todos' ? 'selected' : '' }}>Todos</option>
        <option value="recentes" {{ request('filter') == 'recentes' ? 'selected' : '' }}>Mais Recentes</option>
        <option value="antigos" {{ request('filter') == 'antigos' ? 'selected' : '' }}>Mais Antigos</option>
        <option value="curtidos" {{ request('filter') == 'curtidos' ? 'selected' : '' }}>Mais Curtidos</option>
        <option value="comentados" {{ request('filter') == 'comentados' ? 'selected' : '' }}>Mais Comentados</option>
        <option value="inativos" {{ request('filter') == 'inativos' ? 'selected' : '' }}>Inativos</option>
    </select>
</form>
   
</div>
</div>

<table> 
    <thead>
        <tr>
            <th>Usuário</th>
            <th>Conteudo</th>
            <th>Likes</th>
            <th>Comentarios</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $posts as $post)
        <tr>
            <td>{{'@'. $post->user->arroba}}</td>
            <td>{{$post->texto}}</td> 
            <td>{{$post->likes->count()}}</td>
            <td>{{$post->comentarios->count()}}</td>
          
            <td>{{ $post->created_at->format('d/m/Y') }}</td>
            <td>  <form action="{{ route('adminHome') }}" method="GET">
        <input type="hidden" name="search" value="{{ $post->id }}">
        <button type="submit" class="btn btn-primary">Ver Post</button>
    </form></td>
        </tr>
   @endforeach
    </tbody>
</table>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="containerTabelaUser3">
            <div class="tabelaUsers3">
            <div class="filtrotbuser3">
            <label for="filter">Ordenar por:</label>
<form action="{{ route('adminHome') }}" method="GET">
    <select name="filter" id="filter" onchange="this.form.submit();">
        <option value="todos" {{ request('filter') == 'todos' ? 'selected' : '' }}>Todos</option>
        <option value="recentes" {{ request('filter') == 'recentes' ? 'selected' : '' }}>Mais Recentes</option>
        <option value="antigos" {{ request('filter') == 'antigos' ? 'selected' : '' }}>Mais Antigos</option>
        <option value="curtidos" {{ request('filter') == 'curtidos' ? 'selected' : '' }}>Mais Curtidos</option>
        <option value="comentados" {{ request('filter') == 'comentados' ? 'selected' : '' }}>Mais Comentados</option>
        <option value="inativos" {{ request('filter') == 'inativos' ? 'selected' : '' }}>Inativos</option>
    </select>
</form>
</div>
@foreach($posts as $post)
    @php
        $coresModulo = [
            '1º' => '#CD4642',
            '2º' => '#5169B1',
            '3º' => '#64B467',
        ];
    @endphp

    <div class="feeds">
        <div class="feed">
            <!-- Seção de informações do usuário -->
            <div class="user">
                <div class="profileImg">
                    @if(isset($post->user->id))
                            <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="" class="perfilPostImg">
                    @else
                        {{ dd($post->user) }}
                    @endif
                </div>
                <div class="info">
                    <div class="infoHeader" style="display:flex; align-items:center; justify-content:space-between; width:100%">
                        <h3>{{ '@' . $post->user->arroba }} <span class="publiSpan"> • fez uma nova publicação</span></h3>
                        <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                            <p>{{ $post->user->modulo }} {{ $post->user->perfil }}</p>
                        </div>
                    </div>
                    <p class="horaPost">{{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <!-- Fim da seção de informações do usuário -->

            <!-- Texto do post -->
            <div class="textoPost">
                {{ $post->texto }}
            </div>
            <!-- Fim do texto do post -->

            <!-- Imagem do post -->
            <div class="imgPost">
                @if($post->fotoPost)
                    <a href="{{ asset('storage/' . $post->fotoPost) }}" data-lightbox="gallery" data-title="Descrição da imagem">
                        <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="" style="max-width: 100%; height: auto;">
                    </a>
                @endif
            </div>
            <!-- Fim da imagem do post -->

            <!-- Botões de ação -->
            <div class="action-buttons">
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este post?')">Excluir</button>
                </form>

                <form action="{{ route('posts.aprovar', $post->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success" onclick="return confirm('Tem certeza que deseja ativar este post?')">Ativar</button>
                </form>

                <form action="{{ route('posts.desativar', $post->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-warning" onclick="return confirm('Tem certeza que deseja desativar este post?')">Desativar</button>
                </form>
            </div>
            <!-- Fim dos botões de ação -->
        </div>
    </div>
@endforeach


            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctxPie = document.getElementById('myPieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['DS', 'ADM', 'NUTRI'],
                datasets: [{
                    label: 'Distribuição de Cores',
                    data: [{{$postsAds}}, {{$postsAdm}}, {{$postsNutri}}],
                    backgroundColor: ['#3497c2', '#151855', '#0BBDFF'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Distribuição de Posts',
                        font: {
                            size: 18
                        }
                    },
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw ;
                            }
                        }
                    }
                }
            }
        });

        document.addEventListener('DOMContentLoaded', (event) => {
  const ctx = document.getElementById('myChart').getContext('2d');
     
   // Passando dados do PHP para o JavaScript
        const hashtagsNames = @json($hashtagsNames); // Nomes dos usuários
        const hashtagsPostCounts = @json($hashtagsPostCounts); // Contagem de comentários
        
        const userPostsChart = new Chart(ctx, {
            type: 'bar', // Tipo do gráfico
            data: {
                labels: hashtagsNames, // Rótulos dos usuários
                datasets: [{
                    label: 'hashtags com maior Número de posts', // Rótulo da série de dados
                    data: hashtagsPostCounts, // Dados do gráfico (número de posts por usuário)
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)', // Cor de fundo da barra 1
                        'rgba(153, 102, 255, 0.2)', // Cor de fundo da barra 2
                        'rgba(255, 159, 64, 0.2)'  // Cor de fundo da barra 3
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)', // Cor da borda da barra 1
                        'rgba(153, 102, 255, 1)', // Cor da borda da barra 2
                        'rgba(255, 159, 64, 1)'  // Cor da borda da barra 3
                    ],
                    borderWidth: 1 // Largura da borda
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true, // Começar o eixo Y a partir do zero
                        title: {
                            display: true,
                            text: 'Número de posts'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Usuários'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.dataset.label}: ${tooltipItem.raw}`; // Personaliza o texto do tooltip
                            }
                        }
                    }
                }
            }
        });
    });


        var modal = document.getElementById("myModal");

// Obtém o card que abrirá o modal
var card = document.getElementById("cardModal");

// Obtém o elemento <span> que fecha o modal
var span = document.getElementsByClassName("close")[0];

// Quando o usuário clica no card, o modal será mostrado
card.onclick = function() {
    modal.style.display = "block";
}

// Quando o usuário clicar no botão de fechar, o modal será fechado
span.onclick = function() {
    modal.style.display = "none";
}

// Quando o usuário clicar em qualquer lugar fora do modal, o modal será fechado
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
    </script>
</body>
</html>
