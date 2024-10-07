<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css"
    />

    <style>
        .menu-item{
    text-decoration: none;
}



.left .sidebar{
    margin-top: 1rem;
    background: white;
    border-radius: 1rem;
}

.left .sidebar .menu-item{
    display: flex;
    align-items: center;
    position: relative;
    height: 4rem;
    cursor: pointer;
    transition: all 300ms ease;
}

.left .sidebar .menu-item:hover{
    background-color:#eff3f6;
}

.left .sidebar i{
    font-size: 1.4rem;
    color: gray;
    margin-left: 2rem;
    position: relative;
}



.left .sidebar h3{
    margin-left: 1rem;
    font-size: 1.1rem;
    color: #3f3950;
    font-weight: 600;

}

.left .sidebar .active{
    background-color: #ebeff3;

}

.left.sidebar .active i,
.left .sidebar .active h3{
    color:  #00c9e9;
}

.left .sidebar .active::before{
    content: "";
    display: block;
    width: 0.5rem;
    height: 100%;
    position: absolute;
    background-color: #00c9e9;
}

.left .sidebar .menu-item:first-child.active{
    border-top-left-radius:1rem ;
    overflow: hidden;
}
.left .sidebar .menu-item:last-child.active{
    border-bottom-left-radius:1rem ;
    overflow: hidden;
}



    </style>


</head>
<body>
    <div class="left">
            <div class="sidebar">

            <a href="{{ Route('home')}}" class="menu-item active">
                <span><i class="uil uil-home"></i></span> <h3>Home</h3>
            </a>
            <a class="menu-item ">
                <span><i class="uil uil-bell"></i></span> <h3>Notificações</h3>
            </a>

            <a class="menu-item">
                <span><i class="uil uil-question-circle"></i></span> <h3>Perguntas</h3>
            </a>
            <a class="menu-item " href="{{Route('chat.list')}}">
                <span><i class="uil uil-chat"></i></span> <h3>Chat</h3>
            </a>
            <a href="{{ Route('perfil')}}" class="menu-item ">
                <span><i class="uil uil-edit-alt"></i></span> <h3>Perfil</h3>
            </a>


            </div>
        </div>
</body>
</html>