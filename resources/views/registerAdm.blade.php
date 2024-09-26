<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{url('assets/css/register.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

</head>
<body>

    <div class="main">
        <div class="cadastroCont" id="step1">
            <form method="POST" action="{{ route('registerAdm')}}"  enctype="multipart/form-data" id="formStep1">
                @csrf
                <div class="logo">
                    <div class="headerLogo">
                        <i class="fa-brands fa-cloudversify"></i>
                        <h2>Conectec</h2>
                    </div>
                </div>

                <div class="tituloCadastro">
                    <h1>Crie sua conta</h1>
                    <p>Obrigado por usar nossa plataforma, agora vamos criar um perfil</p>
                </div>

                <div class="progress" style="height: 5px; width: 80%" >
                    <div class="progress-bar"id="progressBar"  role="progressbar" style="width: 50%; background-color: #00c9e9; "  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <div class="grupo-inputs">
                    <div class="inputForm">
                        <label for="nome">
                            Nome (Apelido)
                        </label>
                        <div class="inputText">
                            <input type="text" id="nome" name="name" placeholder="Ex: NeymarJr" >
                            
                        </div>
                    </div>

                    <div class="inputForm">
                        <label for="email">
                            E-mail
                        </label>
                        <div class="inputText">
                            <input type="email" id="email" name="email" placeholder="Ex: nome@gmail.com" >
                            
                        </div>
                    </div>

                    <div class="inputForm">
                        <label for="senha">
                            Senha
                        </label>
                        <div class="inputText">
                            <input type="password" id="senha"name="password" placeholder="Ex: 1234567" >
                        </div>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="extras">
                    <div class="extraTitle">
                        <h1>Selecione um perfil</h1>
                        <p>Isso ajudará a personalizar sua experiência</p>
                    </div>

                    <div class="botoesMain">
                        <input type="radio" name="role" value="Aluno" id="aluno">
                        <label for="aluno"> <i class="fa-solid fa-user-graduate"></i> Aluno</label>

                        <input type="radio" name="role" value="Professor" id="professor">
                        <label for="professor"><i class="fa-solid fa-user-tie"></i> Professor</label>

                        <input type="radio" name="role" value="Outros" id="outros">
                        <label for="outros"> <i class="fa-solid fa-circle-question"></i> Outros</label>
                    </div>
                </div>

                <button class="botaoContinuar"type="button" onclick="nextStep()">Continuar</button>
                <p>Já possui uma conta? <a href="{{ route('login') }}">Entrar</a></p>

            </form>
        </div>

        <div class="cadastroCont-2" id="step2" style="display: none;">
            <form  method="POST" action="{{route('registerAdm')}}"  id="formStep2" enctype="multipart/form-data">
            @csrf

            <input type="hidden" id="hiddenNome" name="name" value="">
            <input type="hidden" id="hiddenEmail" name="email" value="">
            <input type="hidden" id="hiddenSenha" name="password" value="">
            <input type="hidden" id="hiddenPerfil" name="role" value="">


                <div class="logo">
                    <div class="headerLogo">
                        <i class="fa-brands fa-cloudversify"></i>
                        <h2>Conectec</h2>
                    </div>
                </div>

                <div class="tituloCadastro">
                    <h1>Finalizar cadasto</h1>
                    <p>Para finalizarmos vamos escolher uma foto de perfil, e selecionar seu módulo</p>
                </div>

                <div  class="progress" style="height: 5px; width: 100%">
                    <div class="progress-bar" id="progressBar"  role="progressbar" style="width: 100%; background-color: #00c9e9;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <div class="fotoPerfilCont">
                    <div class="fotoPerfilTitle">
                        <label for="urlDaFoto" id="titleFoto">Foto de Perfil</label>
                        <p>Selecione uma foto para usar no nosso aplicativo</p>

                        <label for="urlDaFoto" class="botaoFotoPerfil">Escolher Foto de Perfil</label>
                    </div>
                    <input type="file" id="urlDaFoto" name="urlDaFoto" accept="image/*" onchange="previewImage(event)">

                    <img id="imagePreview" src="" alt="Prévia da Imagem" style="display: none;">

                </div>

                <div class="moduloContainer">
                    <label for="module" class="form-label">Módulo</label>
                    <select class="form-select" id="module" name="module">
                        <option value="">Selecione...</option>
                        <option value="1º Módulo">Módulo 1</option>
                        <option value="2º Módulo">Módulo 2</option>
                        <option value="3º Módulo">Módulo 3</option>
                    </select>
                </div>

                <button class="botaoContinuar" type=submit>Finalizar</button>


            </form>
        </div>

        </div>
       
    </div>


    <!-- <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Cadastro Concluído</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Seu cadastro foi concluído com sucesso!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div> -->

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
   
    <script>



function nextStep() {
    
    var formStep1 = document.getElementById('formStep1');
    var selectedRole = document.querySelector('input[name="role"]:checked');
    console.log('Role Selecionado:', selectedRole.value);  


        var nome = document.getElementById('nome').value;
        var email = document.getElementById('email').value;
        var senha = document.getElementById('senha').value;
     



        if (!nome || !email || !senha || !selectedRole) {
            alert("Por favor, preencha todos os campos e selecione um perfil.");
            return;
        }

        
        document.getElementById('hiddenNome').value = nome;
        document.getElementById('hiddenEmail').value = email;
        document.getElementById('hiddenSenha').value = senha;
        document.getElementById('hiddenPerfil').value = selectedRole.value;

    
    
    
        
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'block';

        
        var progressBar = document.getElementById('progressBar');
        progressBar.style.width = '100%';
        progressBar.innerText = 'Passo 2 de 2';
  
        
    
}

function previewImage(event) {
            var image = document.getElementById('imagePreview');
            var file = event.target.files[0];
            
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    image.src = e.target.result;
                    image.style.display = 'block'; 
                }
                reader.readAsDataURL(file); 
            }
        }

        @if(session('showModal'))
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('successModal'));
                myModal.show();
            });
        @endif


    </script>
</body>
</html>
