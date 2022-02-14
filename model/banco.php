<?php

/**
  * Classe Banco
  * Autor: Plínio Araújo
  */
	class Conexao{
		
		function executaSQL($sql) {
		
			
			$dsn = 'mysql:dbname=elitesoft;host=localhost';
			$user = 'root';
			$pass = '';			

			try{
	        	$con = new PDO($dsn, $user, $pass);
	        	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        	$res = $con->query($sql);
	        	return $res;
	    	}catch(PDOException $e){
		        echo 'ERROR: ' . $e->getMessage();
	    	}
		
		}
	}



  ?>