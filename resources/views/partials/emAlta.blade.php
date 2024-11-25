
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
    .main .container .right{
    height: max-content;
    position: sticky;
    top: -18rem;
    bottom: 0;
}
.right .emAltaCont{
    background: white;
    border-radius: 1rem;
    padding:1rem;
    width: 400px;
    margin-top:5%;
    box-shadow: rgba(194, 214, 218, 0.315) 0px 2px 5px 0px;
}
.right .listaAlta{
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
.right .cursoAlta{
    display: flex;
    flex-direction: column;
}
.cursoAlta{
    background-color: #fff;
    border-radius: 10px;
  padding: 10px;
    margin-bottom:2px;
    box-shadow: rgba(194, 214, 218, 0.315) 0px 2px 5px 0px;
    transition: box-shadow 0.3s ease, transform 0.3s ease;
}
.cursoAlta:hover {
    box-shadow: rgba(194, 214, 218, 0.315) 0px 2px 5px 0px;
    transform: translateY(-5px); /* Eleva o card */
}
.right .cursoLista, .qtdsPostAlta{
    color: rgb(148, 148, 148);
    font-size: 9pt;
    font-weight: 600;
}
.assuntoAlta{
    color: #3f3950;
}
.right .assuntoAlta{
    font-size: 12pt;
    font-weight: 600;
}
.right .headerAlta h2{
    text-align: center;
    font-size: 20pt;
    font-weight: 600;
    color: #3f3950
}
.right .headerAlta {
    margin-bottom: 5%;
}
</style>
<div class="right">
    <!-- Contêiner de "Em Alta" -->
    <div class="emAltaCont">
        <!-- Cabeçalho de "Em Alta" -->
        <div class="headerAlta">
            <h2>Em alta</h2>
        </div>
        <!-- Fim do Cabeçalho de "Em Alta" -->


        <!-- Lista de "Em Alta" -->
        <div class="listaAlta">
            <!-- Item 1 da lista -->

      
            @foreach ($cardHashtags as $hashtag)

@php
    // Dicionário de cursos
    $cursoEmAlta = [
        'Ds' => 'Desenvolvimento de Sistemas',
        'Nutri' => 'Nutrição',
        'Adm' => 'Administração',
        'desc' => 'Desconhecido',
    ];
@endphp

<div class="cursoAlta">
        @php
            $perfilUsuario = $hashtag->posts[0]->user->perfil ?? 'desc';

            $nomeCurso = $cursoEmAlta[$perfilUsuario] ?? 'Desconhecido';
        @endphp
        
        <span class="cursoLista">{{ $perfilUsuario }} - {{ $nomeCurso }}</span>

    <span class="assuntoAlta">{{ "#" . $hashtag->hashtag }}</span> <!-- Exibindo o nome da hashtag -->
    <span class="qtdsPostAlta">{{ $hashtag->posts_count }} Posts</span> <!-- Exibindo a contagem de posts -->
</div>

@endforeach

         
    
          
            <!-- Fim do Item 4 -->
        </div>
        <!-- Fim da Lista de "Em Alta" -->
    </div>
    <!-- Fim do Contêiner de "Em Alta" -->
</body>
</html>