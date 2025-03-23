    <?php
        session_start();
        include("functions.php");
        view($_GET["id"]);
        include(HEADER_TEMPLATE);
    ?>
                <section class="custom-shadow bg-dark">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Agendamento <?php echo $agendamento["id"]; ?></h2>
                        </div>
                        <div class="col-sm-6 text-right h2">
                            <a class="btn btn-outline-primary text-light" href="edit.php?id=<?php echo $agendamento['id']; ?>"><i class="fa-solid fa-pencil"></i> Editar</a>
                            <a class="btn btn-outline-primary text-light" href="index.php?id=<?php echo $agendamento['id']; ?>"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
                        </div>
                    </div>
                    <hr class="border border-light  border-2 opacity-75">

                    <?php if (!empty($_SESSION['message'])): ?>
                        <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
                    <?php endif; ?>

                    <dl class="dl-horizontal">
                        <dt>Nome / Razão Social:</dt>
                        <dd><?php echo $agendamento['nome_cliente']; ?></dd>

                        <dt>Telefone:</dt>
                        <dd><?php echo celPhone($agendamento['telefone']); ?></dd>

                        <dt>Data de agendamento:</dt>
                        <dd><?php echo formatadata($agendamento['data'], "d/m/Y"); ?></dd>

                        <dt>Hora:</dt>
                        <dd><?php echo formatadata($agendamento['hora'], "H:i"); ?></dd>
                    </dl>

                    <dl class="dl-horizontal">
                        <dt>Tipo de serviço:</dt>
                        <dd><?php echo $agendamento['servicos']; ?></dd>

                        <dt>Status:</dt>
                        <dd><?php echo $agendamento['status']; ?></dd>
                    </dl>

                    <div id="actions" class="row">
                        <div class="col-md-12">
                            <a href="edit.php?id=<?php echo $agendamento['id']; ?>" class="btn btn-primary"><i class="fa-solid fa-pencil"></i> Editar</a>
                            <a href="index.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
                        </div>
                    </div>
                    
                    <?php include(FOOTER_TEMPLATE); ?>
                </section>
