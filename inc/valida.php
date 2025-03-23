<?php
    include ('../config.php');
    include(DBAPI);
    include(HEADER_TEMPLATE);

    if (!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))) {
        header("Location: ". BASEURL . "index.php");
        exit;
    }

    $bd = open_database();
    try {

        $bd -> select_db(DB_NAME);

        $usuario = $_POST['login'];
        $senha = $_POST['senha'];

        if (!empty($usuario) && !empty($senha)) {
            $senha = criptografia($_POST['senha']);

            $sql = "SELECT id, nome, user, password FROM usuarios WHERE (user = '". $usuario ."') AND (password = '". $senha ."') LIMIT 1";
            $query = $bd->query($sql);
            if ($query->num_rows > 0) {
                $dados = $query->fetch_assoc();

                $id = $dados['id'];
                $nome = $dados['nome'];
                $user = $dados['user'];
                $password = $dados['password'];

                if (!empty($user)) {
                    if (!isset($_SESSION)) session_start();
                    $_SESSION['message'] = "Bem vindo " . $nome . "!";
                    $_SESSION['type'] = "info";
                    $_SESSION['id'] = $id;
                    $_SESSION['nome'] = $nome;
                    $_SESSION['user'] = $user;
                    echo "<br>";
                    echo "<br>";
                    
                } else {
                    throw new Exception("Não foi possível se conectar:<br>Verifique seu usuário e senha.");
                }
                header("Location: " . BASEURL . "index.php");
            } else {
                throw new Exception("Não foi possível se conectar:<br>Verifique seu usuário e senha.");
            }
        } else {
            throw new Exception("Não foi possível se conectar:<br>Verifique seu usuário e senha.");
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Ocorreu um erro: " . $e->GetMessage();
        $_SESSION['type'] = "danger";
    }

?>
<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php
    clear_messages(); 
    include(FOOTER_TEMPLATE);
?>
