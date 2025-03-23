<?php 
  session_start();
  include("functions.php");

  add();
  include(HEADER_TEMPLATE);
?>

        <section class="bg-dark custom-shadow p-4 ">
            <div class="row">
                <div class="col-sm-6">
                <h2>Registrar-se</h2>
                </div> 
                <div class="col-sm-6 text-right h2">
                    <a class="btn btn-outline-primary text-light" href="../index.php"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
                </div>
            </div>

            <form action="add.php" method="post" enctype="multipart/form-data">
                <hr> 
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="usuario[nome]" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="campo2">Usuário (Login)</label>
                        <input type="text" class="form-control" name="usuario[user]" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="campo3">Senha</label>
                        <input type="password" class="form-control" name="usuario[password]" value="" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control" accept="image/*" onchange="previewImage(event)">
                        <img id="image-preview" src="#" alt="Pré-visualização da foto" style="display:none; margin-top:10px; max-width:100%; height:auto;">
                    </div>
                </div>

                <div id="actions" class="row mt-5">
                    <div class="col-md-12">
                        <button type="submit" href="../index.php" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
                        <a href="../index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </section>

<?php
  include(FOOTER_TEMPLATE);
?>