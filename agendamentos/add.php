<?php 
  session_start();
  include("functions.php");

  if (!isset($_SESSION['user'])) {
      echo "<div class='alert alert-danger text-center'><h1>Você precisa estar logado para acessar esta página.</h1><br><h2>Redirecionando você...</div>";
      header("Refresh: 3; url=../inc/login.php");
      exit(); 
  }

  add();
  include(HEADER_TEMPLATE);
?>

    <section class="bg-dark custom-shadow p-4 ">
      <div class="row">
          <div class="col-sm-6">
            <h2>Fazer um agendamento</h2>
          </div> 
          <div class="col-sm-6 text-right h2">
            <a class="btn btn-outline-primary text-light" href="index.php"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
          </div>
      </div>

      <form action="add.php" method="post">
        <hr class="border border-light border-2 opacity-75">
        
        <div class="row">
          <div class="form-group col-md-7">
            <label for="name">Nome / Razão Social</label>
            <input type="text" class="form-control" value="<?php echo $_SESSION['nome']; ?>" disabled>
            <input type="hidden" name="agendamento[nome_cliente]" value="<?php echo $_SESSION['nome']; ?>">
          </div>
          <div class="form-group col-md-3">
            <label for="campo2">telefone</label>
            <input type="text" class="form-control" name="agendamento[telefone]" maxlength="11" required>
          </div>
        </div>
        
        <div class="row">
          <div class="form-group col-md-5">
            <label for="campo1">Data para agendamento</label>
            <input type="date" class="form-control" name="agendamento[data]" required onchange="verificarAgendamentosSemana()">
          </div>
          <div class="form-group col-md-5">
            <label for="campo2">Hora</label>
            <input type="time" class="form-control" name="agendamento[hora]" required onchange="verificarAgendamentosSemana()">
          </div>
          <div class="form-group col-md-5">
            <label for="campo3">Tipo de serviço</label>
            <input type="text" class="form-control" name="agendamento[servicos]" required>
          </div>
        </div>

        <div id="actions" class="row mt-2">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
            <a href="index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
          </div>
        </div>
      </form>
    </section>

<?php
  include(FOOTER_TEMPLATE);
?>