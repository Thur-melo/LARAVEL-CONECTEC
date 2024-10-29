<!DOCTYPE html>
<html lang="en">
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
            <div class="cursoAlta">
                <span class="cursoLista">DS- Programação e algoritmos</span>
                <span class="assuntoAlta">#JavaOuPython</span>
                <span class="qtdsPostAlta">129 Posts</span>
            </div>
            <!-- Fim do Item 1 -->

            <!-- Item 2 da lista -->
            <div class="cursoAlta">
                <span class="cursoLista">Nutrição- Comidas e massinhas</span>
                <span class="assuntoAlta">#ComoFazerArrozSemPanelaEeAguaKkkkj</span>
                <span class="qtdsPostAlta">2 Posts</span>
            </div>
            <!-- Fim do Item 2 -->

            <!-- Item 3 da lista -->
            <div class="cursoAlta">
                <span class="cursoLista">ADM- Caixa de mercado e uber</span>
                <span class="assuntoAlta">#ComoImprimirDinheirokkkkj</span>
                <span class="qtdsPostAlta">1.200 Posts</span>
            </div>
            <!-- Fim do Item 3 -->

            <!-- Item 4 da lista -->
            <div class="cursoAlta">
                <span class="cursoLista">Outros- Geral</span>
                <span class="assuntoAlta">#NaoSeiOqColocarAqui</span>
                <span class="qtdsPostAlta">532 Posts</span>
            </div>
            <!-- Fim do Item 4 -->
        </div>
        <!-- Fim da Lista de "Em Alta" -->
    </div>
    <!-- Fim do Contêiner de "Em Alta" -->
</body>
</html>