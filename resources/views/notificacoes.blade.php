<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificações Dropdown</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Estilo básico para o sino de notificações */
        .notification-wrapper {
            position: relative;
            display: inline-block;
        }

        .notification-icon {
            font-size: 24px;
            cursor: pointer;
            position: relative;
        }

        /* Badge (contador de notificações) */
        .notification-icon .badge {
            position: absolute;
            top: -8px;
            right: -10px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 3px 6px;
            font-size: 12px;
        }

        /* Dropdown de notificações */
        .notification-dropdown {
            display: none;
            position: absolute;
            top: 30px;
            right: 0;
            width: 350px;
            max-height: 400px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            z-index: 1000;
        }

        /* Mostra o dropdown quando o ícone é clicado */
        .notification-wrapper.active .notification-dropdown {
            display: block;
        }

        /* Cabeçalho do dropdown */
        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #f0f0f0;
            font-weight: bold;
        }

        /* Estilo de cada notificação */
        .notification-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #f0f0f0;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        /* Imagem de perfil */
        .notification-item .msgUserFoto img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        /* Texto e hora */
        .notification-item .msgInfors {
            flex-grow: 1;
        }

        .notification-item .msgTexto {
            font-size: 14px;
            color: #333;
        }

        .notification-item .msgHora {
            font-size: 12px;
            color: #888;
        }

        /* Ícone de tipo de notificação */
        .notification-item .icone {
            font-size: 18px;
            margin-left: 10px;
        }

        /* Botão Ver Todas */
        .see-all {
            display: block;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
        }

        .see-all:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="notification-wrapper">
    <!-- Ícone do Sino -->
    <div class="notification-icon" onclick="toggleDropdown()">
        <i class="fa fa-bell"></i>
        <span class="badge">3</span>
    </div>

    <!-- Dropdown de Notificações -->
    <div class="notification-dropdown">
        <!-- Cabeçalho do Dropdown -->
        <div class="notification-header">
            <span>Notificações</span>
            <a href="#" style="font-size: 14px; color: #007bff; text-decoration: none;">Marcar como lidas</a>
        </div>

        <!-- Lista de Notificações -->
        <div class="notification-item">
            <div class="msgUserFoto">
                <img src="path_to_image.jpg" alt="Foto do usuário">
            </div>
            <div class="msgInfors">
                <div class="msgTexto"><strong>@usuario</strong> comentou no seu post!</div>
                <div class="msgHora">há 2 horas</div>
            </div>
            <div class="icone">
                <i class="fa fa-comment text-primary"></i>
            </div>
        </div>

        <div class="notification-item">
            <div class="msgUserFoto">
                <img src="path_to_image.jpg" alt="Foto do usuário">
            </div>
            <div class="msgInfors">
                <div class="msgTexto"><strong>@usuario</strong> deu um like no seu post!</div>
                <div class="msgHora">há 1 hora</div>
            </div>
            <div class="icone">
                <i class="fa fa-heart text-danger"></i>
            </div>
        </div>

        <!-- Botão Ver Todas -->
        <a href="#" class="see-all">Ver todas</a>
    </div>
</div>

<script>
    // Função para abrir e fechar o dropdown
    function toggleDropdown() {
        document.querySelector('.notification-wrapper').classList.toggle('active');
    }

    // Fechar o dropdown ao clicar fora dele
    document.addEventListener('click', function(event) {
        const notificationWrapper = document.querySelector('.notification-wrapper');
        if (!notificationWrapper.contains(event.target)) {
            notificationWrapper.classList.remove('active');
        }
    });
</script>

</body>
</html>
