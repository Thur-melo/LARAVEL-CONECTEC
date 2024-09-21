<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('assets/css/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    <div class="main">
        <form  method="POST"  action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
        <div class="title">
            <i class="fa-regular fa-circle-user"></i>
            <h1>Preferencias da conta {{ $user->name }}</h1>
        </div>

        <div class="imgContainerEdit">
             <!-- <img src="{{ asset('storage/' . $user->urlDaFoto) }}" alt="">  -->
             <img id="imagePreview" alt="Prévia da Imagem" src="{{ asset('storage/' . $user->urlDaFoto) }}">
             
            <div class="botoesImg">
                <label for="urlDaFoto" class="botaoFotoPerfil"><i class="fa-regular fa-image"></i>Trocar</label>
            
                <input type="file" id="urlDaFoto" name="urlDaFoto" accept="image/*" onchange="previewImage(event)">
                <button class="btnImg"><i class="fa-regular fa-trash-can"></i>Remover</button>
            </div>
        </div>

        <div class="titleInfo">
            <i class="fa-brands fa-squarespace"></i>
            <h1>Suas informações </h1>
        </div>
            <div class="desc">
                <p>Aqui está suas informações, voçê pode edita-las algumas delas</p>
            </div>
        

        

        <div class="inputsCont">

            <div class="inputsEmailNomeSenha">
                <div class="inputForm">
                    <label for="senha">
                        Nome
                    </label>
                    <div class="inputText">
                        <input type="text" id="nome"name="name" value="{{ $user->name }}"  >
                    </div>
                </div>

                <div class="inputForm">
                    <label for="senha">
                        Email
                    </label>
                    <div class="inputText">
                        <input class="form-control" id="disabledInput" type="text" value="{{ $user->email }}" disabled >
                    </div>
                </div>

                <div class="inputForm">
                    <label for="senha">
                        Senha
                    </label>
                    <div class="inputText">
                        <input class="form-control" id="disabledInput" type="text" value="{{ $user->password }}" disabled>
                    </div>
                </div>
            </div>

            <div class="inputsModuloPerfil">
                
                <div class="inputForm">
                    <label for="senha">
                        Modulo
                    </label>
                    <div class="inputText">
                    <input class="form-control" id="disabledInput" type="text" value="{{ $user->modulo}}" disabled>
                    </div>
                </div>
                <div class="inputForm">
                    <label for="senha">
                        Perfil
                    </label>
                    <div class="inputText">
                    <input class="form-control" id="disabledInput" type="text" value="{{ $user->perfil }}" disabled>
                    </div>
                </div>
            </div>
        </div> 

        <div class="btnsSalvar">
            <button type="submit">Salvar</button>
            <button>Cancelar</button>
        </div>
        </form>
    </div>


    <script>
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


    </script>
    
</body>
</html>