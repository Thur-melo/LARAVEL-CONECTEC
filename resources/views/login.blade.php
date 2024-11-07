<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{url('assets/css/login.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

</head>

<body>

    <!-- <nav>
        <div class="container">
            <div class="logoCont">
                <span class="fontisto--cloudy"></span>  
               <img src= "{{url('assets/img/logoConectec.png')}}"  id="logo">
            </div>
               
                <div class="createBtn">
                    <div class="nomesNav">
                      
                    </div>
        </div>
    </div>
</nav> -->


<div class="main-login">
        <div class="imagem-cont">
                <img src="{{url('assets/img/img.png')}}">
               
        </div>

        <div class="login-cont">
            <form method="POST" action="{{url('login')}}" enctype="multipart/form-data" >
                @csrf
                <div class="logo-img">
                    <img src="{{url('assets/img/logoConectec.png')}}" alt="">
                </div>

                <div class="title-login">
                    <h2>Entre</h2>
                    <span>Faça o login para continuar </span>
                </div>
                @if(session()->has('success'))

                {{ session()->get('success')}}
                @endif
                <div class="grupo-inputs">
                    <div class="inputForm">
                        <label for="email">E-mail</label>
                        <div class="inputText">
                            <input type="email" id="emailUser" name="email" placeholder="Digíte seu E-mail institucional">
                        </div>
                    </div>

                    <div class="inputForm">
                        <label for="password">Senha</label>
                        <div class="inputText">
                            <input type="password" id="senha" name="password" placeholder="Dígite sua Senha">
                        </div>

                    </div>
                    
                    
                </div>

                

                <div class="button-login">
                    <button>Entrar</button>
                </div>
                <div class="lineCont">
                    <div class="line"></div>
                    <div id="ou">Ou</div>
                    <div class="line"></div>
                </div>

                <div class="footer-login">
                    <span>Ainda não tem uma conta? <a href="{{ route('register')}}">Registre-se</a></span>
                    
                </div>
                
            </form>
              
               
        </div>
    </div>

        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Sucesso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Usuário registrado com sucesso!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- Carregar jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Carregar o Bootstrap corretamente -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <!-- <script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {
            e.preventDefault(); // Impede o envio padrão do formulário

            // Coletar os dados do formulário
            var formData = {
                emailUser: $('#email').val(),
                senha: $('#password').val(),
                _token: $('input[name="_token"]').val() // CSRF token
            };

            // Fazer a requisição AJAX
            $.ajax({
                url: '/login', // Substitua pela rota correta do Laravel
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status === 'success') {
                        window.location.href = '/home'; // Redirecionar para a home (ou outra página)
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        $('#errorMessage').text('Senha ou email incorreto.');
                        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                        errorModal.show();
                    } else {
                        $('#errorMessage').text('Ocorreu um erro. Tente novamente.');
                        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                        errorModal.show();
                    }
                }
            });
        });
    }); -->


        @if(session('showModal'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('successModal'));
                myModal.show();
            });
        </script>
        @endif
        </script>
</body>

</html>