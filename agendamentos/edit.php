<?php 
  session_start();
  include("functions.php");
  
  if (!isset($_SESSION['user'])) {
    echo "<div class='alert alert-danger text-center'><h1>Você precisa estar logado para acessar esta página.</h1><br><h2>Redirecionando você...</div>";
      header("Refresh: 3; url=../inc/login.php");
      exit(); 
  }

  edit();
  include(HEADER_TEMPLATE);
?>
  <section class="custom-shadow bg-dark">
    <div class="row">
        <div class="col-sm-6">
          <h2>Atualizar agendamento</h2>
        </div> 
        <div class="col-sm-6 text-right h2">
          <a class="btn btn-outline-primary text-light" href="index.php?id=<?php echo $agendamento['id']; ?>"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
        </div>
    </div>

    <form action="edit.php?id=<?php echo $agendamento['id']; ?>" method="post">
      <hr class="border border-light  border-2 opacity-75">
      <div class="row">
        <div class="form-group col-md-7">
          <label for="name">Nome / Razão Social</label>
          <input type="text" class="form-control" name="agendamento['nome_cliente']" maxlength="50" value="<?php echo $agendamento['nome_cliente']; ?>">
        </div>

        <div class="form-group col-md-3">
          <label for="campo2">Telefone</label>
          <input type="text" class="form-control" name="agendamento['telefone']" maxlength="11" value="<?php echo $agendamento['telefone']; ?>" 
          >
        </div>

        <div class="form-group col-md-2">
          <label for="campo3">Dia agendado</label>
          <input type="date" class="form-control" name="agendamento['data']" value="<?php echo formatadata($agendamento['data'],"Y-m-d"); ?>">
        </div>
      </div>
      
      <div class="row">
        <div class="form-group col-md-5">
          <label for="campo1">Tipo de serviço</label>
          <input type="text" class="form-control" name="agendamento['servicos']" value="<?php echo $agendamento['servicos']; ?>">
        </div>
        <div class="form-group col-md-5">
          <label for="status">Status</label>
          <select class="form-control" name="agendamento['status']" id="status">
            <option value="Pendente" <?php echo ($agendamento['status'] == 'Pendente') ? 'selected' : ''; ?>>Pendente</option>
            <option value="Confirmado" <?php echo ($agendamento['status'] == 'Confirmado') ? 'selected' : ''; ?>>Confirmado</option>
            <option value="Concluído" <?php echo ($agendamento['status'] == 'Concluído') ? 'selected' : ''; ?>>Concluído</option>
            <option value="Cancelado" <?php echo ($agendamento['status'] == 'Cancelado') ? 'selected' : ''; ?>>Cancelado</option>
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="campo3">Hora</label>
          <input type="time" class="form-control" name="agendamento['hora']" value="<?php echo formatadata($agendamento['hora'],"H:i"); ?>">
        </div>
      </div>
      
      <div id="actions" class="row mt-2">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
          <a href="index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
        </div>
      </div>
    </form>
    <?php include(FOOTER_TEMPLATE); ?>
  </section>

