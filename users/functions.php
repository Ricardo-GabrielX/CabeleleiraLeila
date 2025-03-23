<?php
    include('../config.php');
    include(DBAPI);

    $usuario = null;
    $usuarios = null;

    function index() {
        global $usuarios;

        if (!empty($_POST['users'])) {
            $usuarios = filter("usuarios", "nome LIKE '%" . $_POST['users'] . "%'");
        } else {
            $usuarios = find_all("usuarios");
        }
    }


    function add() {
        if (!empty($_POST['usuario'])) {
            try {
                $usuario = $_POST['usuario'];

                $usuario['foto'] = null;

                if (isset($_FILES['foto']['name']) && $_FILES['foto']['error'] == 0) {
                    $upload_dir = 'uploads/';
                    $file_extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                    $new_file_name = uniqid() . '.' . $file_extension;
                    $uploaded_file = $upload_dir . $new_file_name;

                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploaded_file)) {
                        $usuario['foto'] = $uploaded_file;
                    } else {
                        throw new Exception("Erro ao enviar a imagem.");
                    }
                }

                if (!empty($usuario['password'])) {
                    $senha = criptografia($usuario['password']);
                    $usuario['password'] = $senha;
                }
                
                save('usuarios', $usuario);
                header('Location: index.php');
            } catch (Exception $e) {
                $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
                $_SESSION['type'] = "danger";
            }
        }
    }

    function edit() {
        $now = new DateTime("now");

        try {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                if (isset($_POST['usuario'])) {
                    $usuario = $_POST['usuario'];

                    if (!empty($usuario['password'])) {
                        $senha = criptografia($usuario['password']);
                        $usuario['password'] = $senha;
                    }

                    if (isset($_FILES['foto']['name']) && $_FILES['foto']['error'] == 0) {
                        $upload_dir = 'uploads/';
                        $file_extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                        $new_file_name = uniqid() . '.' . $file_extension; 
                        $uploaded_file = $upload_dir . $new_file_name;

                        if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploaded_file)) {
                            $usuario['foto'] = $uploaded_file;
                        } else {
                            throw new Exception("Erro ao enviar a imagem.");
                        }
                    }

                    update('usuarios', $id, $usuario);
                    header('Location: index.php');
                } else {
                    global $usuario;
                    $usuario = find("usuarios", $id);
                }
            } else {
                header('Location: index.php');
            }
        } catch (Exception $e) {
            $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
            $_SESSION['type'] = "danger";
        }
    }

    function view($id = null) {
        global $usuario;
        $usuario = find("usuarios", $id);
    }

    function delete($id = null) {
        global $usuarios;
        $usuarios = remove("usuarios", $id);
        header("Location: index.php");
    }

?>
