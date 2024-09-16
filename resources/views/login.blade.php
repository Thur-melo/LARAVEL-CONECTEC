<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{url('assets/css/login.css')}}">
</head>
<body>


<!-- <header>
        <nav class="navBar" id="navBar">
          <div class="titleNav">
            <i class="fa-brands fa-cloudversify" style="font-size: 30pt; margin-right: 6px; color: #00c9e9; margin-bottom: 5px"></i><h2 style="font-size: 18pt">Conectec</h2>
        </div>
          <ul class="navLinks">
        </div>
     </header>   -->


    <div class="main">
        <div class="loginCont" id="step1">
            <form method="POST" action="{{url('login')}}"  enctype="multipart/form-data" id="formStep1">
                @csrf

                <div class="logo">
                    <img src="" alt="Chronos">
                </div>

                <div class="tituloCadastro">
                    <h1>Entre na sua conta</h1>
                    <p>Bem-vindo de volta, acesse sua conta para continuar.</p>                   
                 </div>

                   

                <div class="grupo-inputs">

                    <div class="inputForm">
                        <label for="email">
                            E-mail
                        </label>
                        <div class="inputText">
                            <input type="email" id="email" name="emailUser" placeholder="Ex: nome@gmail.com" >
                           
                              
                           
                        </div>
                    </div>

                    <div class="inputForm">
                        <label for="senha">
                            Senha
                        </label>
                        <div class="inputText">
                            <input type="password" id="senha"name="senha" placeholder="Ex: 1234567" >
                        
                        </div>
                    </div>
                    <button class="botaoContinuar" type="submit">Entrar</button>
                   

                    </form>
                </div>
 

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
   

</body>
</html>
