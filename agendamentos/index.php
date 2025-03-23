<?php
    session_start();
    include('functions.php');
   
    index();
    
    $agendamentos = verificarMultiplosAgendamentos($agendamentos);
    
    include(HEADER_TEMPLATE);
?>
    <section class="bg-dark custom-shadow">
        <header>
            <div class="row">
                <div class="col-sm-6">
                    <h2>Agendamentos</h2>
                </div>
                <div class="col-sm-6 text-right h2">
                    <a class="btn btn-outline-primary text-light" href="add.php"><i class="fa fa-plus"></i> Fazer um agendamento</a>
                    <a class="btn  btn-outline-primary text-light " href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
                </div>
            </div>
        </header>
        
        <?php if (!empty($_SESSION['message'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_SESSION['message']; ?>
            </div>
            <?php clear_messages(); ?>
        <?php endif; ?>

        <hr class="border border-light border-2 opacity-75">

<?php 
    $tem_multiplos = false;
    if ($agendamentos) {
        foreach ($agendamentos as $customer) {
            if (isset($customer['mesma_semana']) && $customer['mesma_semana']) {
                $tem_multiplos = true;
                break;
            }
        }
    }
    
    if ($tem_multiplos) : 
?>
    <div class="mb-3">
        <div class="badge bg-warning text-dark p-2">
            <i class="fa fa-exclamation-triangle"></i> Clientes com múltiplos agendamentos na mesma semana
        </div>
    </div>
<?php endif; ?>

<table class="table table-dark table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th width="20%">Nome</th>
            <th>Dia agendado</th>
            <th>Telefone</th>
            <th>Status</th>
            <th>Serviços</th>
            <?php if (isset($_SESSION['user']) && $_SESSION['user'] == "admin") : ?>
            <th>Opções</th>
            <?php endif; ?>
        </tr>
    </thead>
   
    <tbody>
   
    <?php if ($agendamentos) : ?>
    <?php foreach ($agendamentos as $agendamento) : ?>
        <tr<?php echo (isset($agendamento['mesma_semana']) && $agendamento['mesma_semana']) ? ' class="table-warning text-dark"' : ''; ?>>
            <td><?php echo $agendamento['id']; ?></td>
            <td><?php echo $agendamento['nome_cliente']; ?></td>
            <td>
                <?php echo date('d/m/Y', strtotime($agendamento['data'])); ?>
                <?php echo date('H:i', strtotime($agendamento['hora'])); ?>
                <?php if (isset($agendamento['mesma_semana']) && $agendamento['mesma_semana']) : ?>
                    <span class="badge bg-warning text-dark" title="Este cliente tem <?php echo $agendamento['total_semana']; ?> agendamentos na mesma semana">
                        <i class="fa fa-exclamation-triangle"></i> <?php echo $agendamento['total_semana']; ?> na semana
                    </span>
                <?php endif; ?>
            </td>
            <td><?php echo celPhone($agendamento['telefone']); ?></td>
            <td><?php echo ($agendamento['status']); ?></td>
            <td><?php echo $agendamento['servicos']; ?></td>
            <?php if (isset($_SESSION['user']) && $_SESSION['user'] == "admin") : ?>
            <td class="actions text-right">
                <a href="view.php?id=<?php echo $agendamento['id']; ?>" class="btn btn-sm btn-light"><i class="fa fa-eye"></i> Visualizar</a>
                <?php if (isset($_SESSION['user'])) : ?>
                    <a href="edit.php?id=<?php echo $agendamento['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Editar</a>                    
                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal" data-agendamento="<?php echo $agendamento['id']; ?>">
                        <i class="fa fa-trash"></i> Excluir
                    </a>
                <?php endif; ?>
            </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="7">Nenhum registro encontrado.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
    </section>
   
    

<?php 
    include("modal.php"); 
    include(FOOTER_TEMPLATE);
 ?>