<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Salão de Beleza</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="assets/img/icon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="../assets/img/icon.ico" type="image/x-icon"> <!-- Caminho para páginas internas como add, e view -->
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/awesome/all.min.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/global.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/header.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>index.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/login.css">
        <style>
			@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
		</style>
    </head>
   
    <body class="fundo">
        <nav class="navbar navbar-expand-xl bg-dark fixed-top" data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand" href="<?php echo BASEURL; ?>index.php">Cabeleila Leila</a>
            
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <?php if (isset($_SESSION['user'])) :  ?>
                        <?php if ($_SESSION['user'] == "admin") : ?>
                            <li class="nav-item dropdown">
                                <button class="nav-link dropdown-toggle register" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-regular fa-calendar"></i> Registro de Agendamento</button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>agendamentos/index.php"><i class="fa-regular fa-calendar"></i> Todos</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>agendamentos/add.php"><i class="fa-regular fa-calendar-plus"></i> Adicionar novo ageendamento</a></li>
                                </ul>
                            </li>
                    
                            <li class="nav-item dropdown">
                                <button class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                                    <i class="fa-solid fa-user-lock"></i> Usuários       
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>users/add.php"><i class="fa-solid fa-user-tie"></i> Adicionar Usuário</a></li>
                                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>users/"><i class="fa-solid fa-user-lock"></i> Gerenciar Usuários</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                        <ul class="nav-item">
                        <?php if (isset($_SESSION['user'])) : ?>
                            <a class="nav-link" href="<?php echo BASEURL; ?>inc/logout.php">
                            <img src="<?php echo$_SESSION['foto'] ?? 'semImagem.png'; ?>" alt="">
                                Bem vindo <?php echo $_SESSION['user']; ?>! <i class="fa-solid fa-person-walking-arrow-right"></i> Desconectar
                            </a>
                        <?php else : ?>
                            <a class="nav-link" href="<?php echo BASEURL; ?>inc/login.php">
                            <i class="fa-solid fa-users" style="color: #ffffff;"></i> Login
                        </a>
                        <?php endif; ?>
                    </ul>
                    </ul>
                </div>
            </div>
        </nav>

        
       
            <!-- Fim do Menu -->
            
            
           
        <main class="container mt-5">
