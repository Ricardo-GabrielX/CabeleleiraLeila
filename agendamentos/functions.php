<?php

    include('../config.php');
    include(DBAPI);

    $agendamentos = null;
    $agendamento = null;

    
    function index() {
        global $agendamentos;
        
        if (!isset($_SESSION['id'])) {
            header('location: ../login.php');
            exit;
        }
        
        if (isset($_SESSION['user']) && $_SESSION['user'] == "admin") {
            $agendamentos = find_all('agendamentos');
        } else {
            $id_cliente = $_SESSION['id'];
            $agendamentos = filter('agendamentos', "id_cliente = $id_cliente");
        }
    }
        
        
    function view($id = null) {
        global $agendamento;
        
        $agendamento = find('agendamentos', $id);
        
        if (!(isset($_SESSION['user']) && $_SESSION['user'] == "admin")) {
            if ($agendamento && $agendamento['id_cliente'] != $_SESSION['id']) {
                $_SESSION['message'] = "Você não tem permissão para visualizar este agendamento.";
                $_SESSION['type'] = 'danger';
                header('location: index.php');
                exit;
            }
        }
    }
    
    function add() {
        if (!empty($_POST['agendamento'])) {

            $agendamento = $_POST['agendamento'];

            if (!isset($agendamento['id_cliente']) || empty($agendamento['id_cliente'])) {
                $agendamento['id_cliente'] = $_SESSION['id']; 
            }
            
            $agendamento['nome_cliente'] = $_SESSION['nome'];
            
            save("agendamentos", $agendamento);
            header('location: index.php');
        }
    }

    function edit() {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            
            global $agendamento;
            $agendamento = find('agendamentos', $id);
            
            if (!(isset($_SESSION['user']) && $_SESSION['user'] == "admin")) {
                if ($agendamento && $agendamento['id_cliente'] != $_SESSION['id']) {
                    $_SESSION['message'] = "Você não tem permissão para editar este agendamento.";
                    $_SESSION['type'] = 'danger';
                    header('location: index.php');
                    exit;
                }
            }
    
            if (isset($_POST['agendamento'])) {
                $agendamento_data = $_POST["agendamento"];
                
                if (!(isset($_SESSION['user']) && $_SESSION['user'] == "admin")) {
                    $agendamento_data['id_cliente'] = $_SESSION['id'];
                }
                
                update("agendamentos", $id, $agendamento_data);
                header("location: index.php");
            }
        } else {
            header('location: index.php');
        }
    }
    
    function delete($id = null) {

        global $agendamento;
        $agendamento = remove('agendamentos', $id);
    
        header('location: index.php');
    }

    function verificarMultiplosAgendamentos($agendamentos) {
        if (!$agendamentos) {
            return $agendamentos;
        }
        
        $database = open_database();

        foreach ($agendamentos as &$agendamento) {
            $data = new DateTime($agendamento['data']);
            
            $inicio_semana = clone $data;
            $inicio_semana->modify('last monday');
            if ($data->format('N') == 1) { 
                $inicio_semana = clone $data;
            }
            
            $fim_semana = clone $inicio_semana;
            $fim_semana->modify('+6 days');
            
            $inicio_semana_sql = $inicio_semana->format('Y-m-d');
            $fim_semana_sql = $fim_semana->format('Y-m-d');
            
            $sql = "SELECT COUNT(*) as total FROM agendamentos
                    WHERE id_cliente = " . $agendamento['id_cliente'] . "
                    AND DATE(data) BETWEEN '$inicio_semana_sql' AND '$fim_semana_sql'";
            
            $resultado = $database->query($sql);
            $row = $resultado->fetch_assoc();
            
            $agendamento['mesma_semana'] = ($row['total'] > 1);
            $agendamento['total_semana'] = $row['total'];
        }
        
        close_database($database);
        return $agendamentos;
    }
?>