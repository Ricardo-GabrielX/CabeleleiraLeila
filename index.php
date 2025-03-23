<?php
    include "config.php";
    include DBAPI;
    if (!isset($_SESSION)) session_start();
    include(HEADER_TEMPLATE);
    $db = open_database();
?>
            <div class="home">
                <div class="base">
                    <p class="top">Olá, seja bem vindo!</p>
                    <h1>Caleleila Leila</h1>
                    <p id="spacing">Agende sua próxima visita no salão por aqui.</p>

                    <?php if (!isset($_SESSION['user'])) : ?>
                        <a href="<?php echo BASEURL; ?>users/add.php" class="bottone1"><strong>Começar</strong></a>
                    <?php endif; ?>
                </div>
                <div>
                    <img src="assets/img/cartoon.png" alt="">
                </div>
            </div>
            <?php if ($db) : ?>
                <?php if (isset($_SESSION['user'])) : ?>
                            <h1 class="mt-5 text-black">Faça seu agendamento</h1>
                    <hr class="mt-5 border border-black border-2 opacity-75">
            
                    <div class="row mt-5" id="actions">
                    <?php if (isset($_SESSION['user']) && $_SESSION['user'] == "admin") : ?>
                        <div class="col-xs-6 col-sm-3 col-md-2 d-flex justify-content-center">
                            <a href="<?php echo BASEURL; ?>users/add.php" class="btn btnHome btnHomeHover w-100">
                                <div class="row">
                                    <div class="col-xl-12 text-center">
                                        <i class="fa-solid fa-user-tie fa-5x"></i>
                                    </div>
                                    <div class="col-xl-12 text-center">
                                        <p class="mt-3 text-black">Registrar-se</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                
                        <div class="col-xs-6 col-sm-3 col-md-2 d-flex justify-content-center">
                            <a href="<?php echo BASEURL; ?>users" class="btn btnHome btnHomeHover w-100">
                                <div class="row">
                                    <div class="col-xl-12 text-center">
                                        <i class="fa-solid fa-user-lock fa-5x"></i>
                                    </div>
                                    <div class="col-xl-12 text-center">
                                        <p class="mt-3 text-black">Usuários</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="row mt-5">
                        <div class="col-xs-6 col-sm-3 col-md-2 d-flex justify-content-center">
                            <a href="agendamentos/add.php" class="btn w-100 btnHome btnHomeHover">
                                <div class="text-center">
                                    <i class="fa-regular fa-calendar-plus fa-5x"></i>
                                    <p class="mt-3 text-black">Fazer um agendamento</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-2 d-flex justify-content-center">
                            <a href="agendamentos" class="btn w-100 btnHome">
                                <div class="text-center">
                                <i class="fa-regular fa-calendar-days fa-5x"></i>
                                    <p class="mt-3 text-black">Agendamentos</p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                <p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
            </div>
        <?php endif; ?>
    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
            <p><?php echo $_SESSION['message']; ?></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php clear_messages(); ?>
    <?php endif; ?>
<?php include(FOOTER_TEMPLATE); ?>