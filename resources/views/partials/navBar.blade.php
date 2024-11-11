<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <style>
        nav{
            width: 100%;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            z-index: 10;
            background: white;
        
        }

        nav .container{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }


        .search-bar input[type="search"]{
            background: transparent;
            width: 400px;
        }

        nav .search-bar input[type="search"]::placeholder{
            color: gray;
        }



        nav .search-bar input[type="search"]::placeholder{
            color: gray;
        }

        nav .createBtn{
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Roboto";

        }

        body{
            overflow-x: hidden;
            background-color: #F4F4F4 !important; 
            
        }




        .search-bar input[type="search"]{
            background: transparent;
            width: 30vw;
        }

        .container{
            width: 80%;
            margin: 0 auto;
        }

        .profileImg{
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
        }

        .profileImg img{
            width: 100%;
            height: 100%;
            border-radius: 50%;
            overflow: hidden;
            object-fit: cover; /* Mantém a proporção e corta a imagem para preencher o contêiner */
        }

        #logo{
            height: 50px;
        }

        .search-bar{
            background:#eff3f6;
            border-radius: 2rem;
            padding: 0.6rem 1rem;
        }
        .search-bar input[type="search"]{
            background: transparent;
            width: 30vw;
            border: none;
            outline: none;
        }


        .botaoPostar{
            background-color: #00c9e9;
            color: white;
            border: 1px solid #00c9e9;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 7px;
        }

        .nomesNav{
            display: flex;
            justify-content: center;
            align-items: flex-end;
            flex-direction: column;

        }
        .nomesNav span{
            font-size: 11pt;
            font-weight: 600;
            color: #3f3950;
        }

        .nomesNav span:last-child{
            color: #00c9e9;
        }

    </style>
</head>
<body>
<nav>
        <div class="container">
            <div class="logoCont">
                <span class="fontisto--cloudy"></span>  
               <img src= "{{url('assets/img/logoConectec.png')}}"  id="logo">
            </div>
            <form  action="{{route('home')}}" method="get">
                <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                    <input
                    type="search"
                    placeholder="Pesquisar... "
                    name="s"
                     id="s"
                    />
                </div>
            </form>
                <div class="createBtn">
               <button class="criarBtn"  data-bs-toggle="modal" data-bs-target="#modalPost"> <i class="fa-regular fa-square-plus"></i>Criar</button>
                    <div class="nomesNav">
                        <span>{{ $user->name}}</span>
                        <span>{{ $user->modulo}} {{ $user->perfil}} </span>
                    </div>
                    <div class="profileImg">
                        <img src="{{ asset('storage/' . $user->urlDaFoto) }}" alt="">
                        
                </div>
                <i class="fa-solid fa-right-from-bracket" id="logoutIcon" style="cursor: pointer;"></i>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                

        </div>
    </div>
</nav>
</body>
</html>