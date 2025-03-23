<?php

	function filter($table = null, $p = null) {
	   $database = open_database();
	   $found = null;
	   
	   try {
		   if ($p) {
			   $sql = "SELECT * FROM " . $table . " WHERE " . $p;
			   $result = $database->query($sql);
			   
			   if ($result->num_rows > 0) {
				   $found = array();
				   while ($row = $result->fetch_assoc()) {
					   array_push($found, $row);
				   }
			   } else {
				   throw new Exception("Não foram encontrados registros de dados!");
			   }
		   }
	   } catch (Exception $e) {
		   $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
		   $_SESSION['type'] = "danger";
	   }
	   
	   close_database($database);
	   return $found;
	}
   
   
	function find( $table = null, $id = null ) {
	
		$database = open_database();
		$found = null;
		

		try {
		if ($id) {
			$sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
			$result = $database->query($sql);
			
			if ($result->num_rows > 0) {
			$found = $result->fetch_assoc();
			}
			
		} else {
			
			$sql = "SELECT * FROM " . $table;
			$result = $database->query($sql);
			
			if ($result->num_rows > 0) {
			$found = $result->fetch_all(MYSQLI_ASSOC);
			}
		}
		} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
		
		close_database($database);
		return $found;
	}

	function criptografia($senha){

	
		/*
			==> Criptografia Blowfish
			http://www.linhadecodigo.com.br/artigo/3532/criptografando-senhas-usando-bcrypt-blowfish-no-php.aspx
		*/
		$custo = "08";
		$salt = "CflfllePArK1BJomMOF6aJ";

		$hash = crypt($senha, "$2a$" . $custo . "$" . $salt ."$");

		return $hash; 
	}


	function clear_messages(){
		$_SESSION['message'] = null;
		$_SESSION['type'] = null;
	}
	

	// Funções para formatar os valores de data e outros campos
	function formatadata($data, $formato) {
        $dt = new DateTime($data, new DateTimeZone("America/Sao_Paulo"));
        return $dt->format($formato);
    }
	function celPhone($phone)
	{
		$cel = "(" . substr($phone, 0, 2) . ") " .
			substr($phone, 2, 5) . "-" . substr($phone, 7);
		return $cel;
	}
		
	 	
	function update($table = null, $id = 0, $data = null) {

		$database = open_database();
	
		$items = null;
	
		foreach ($data as $key => $value) {
		$items .= trim($key, "'") . "='$value',";
		}
	
		$items = rtrim($items, ',');
	
		$sql  = "UPDATE . $table  SET $items WHERE id=" . $id . ";";
	
		try {
		$database->query($sql);
	
		$_SESSION['message'] = 'Registro atualizado com sucesso.';
		$_SESSION['type'] = 'success';
	
		} catch (Exception $e) { 
	
		$_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
		$_SESSION['type'] = 'danger';
		} 
	
		close_database($database);
	}

	function find_all( $table ) {
		return find($table);
	}

	function save($table = null, $data = null) {

		$database = open_database();

		$columns = null;
		$values = null;

		foreach ($data as $key => $value) {
			$columns .= trim($key, "'") . ",";
			$values .= "'$value',";
		}

		$columns = rtrim($columns, ',');
		$values = rtrim($values, ',');
		
		$sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";
		

		try {
			$database->query($sql);

			$_SESSION['message'] = 'Registro cadastrado com sucesso.';
			$_SESSION['type'] = 'success';
		
		} catch (Exception $e) { 
		
			$_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
			$_SESSION['type'] = 'danger';
		} 

		close_database($database);
	}
	
	//mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR );
	$driver = new mysqli_driver();
	$driver->report_mode = MYSQLI_REPORT_STRICT & ~ MYSQLI_REPORT_ERROR;

	function open_database() {
		try {
			$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			$conn->SET_charset("utf8");
			return $conn;
		} catch (Exception $e) {
			//echo "<h3>Ocorreu um erro: .$e->getMessage() </h3>";
			return null;
		}
	}

	function close_database($conn) {
		try {
			$conn = null;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
	function remove( $table = null, $id = null ) {

		$database = open_database();
		
		try {
		if ($id) {
	
			$sql = "DELETE FROM " . $table . " WHERE id = " . $id;
			$result = $database->query($sql);
	
			if ($result = $database->query($sql)) {   	
			$_SESSION['message'] = "Registro Removido com Sucesso.";
			$_SESSION['type'] = 'success';
			}
		}
		} catch (Exception $e) { 
	
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
		}
	
		close_database($database);
	}

	
?>