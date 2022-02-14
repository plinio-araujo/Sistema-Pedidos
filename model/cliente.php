<?php
	
	include_once('banco.php');
 /**
  * Classe Cliente
  * Autor: Plínio Araújo
  */
 class Cliente
 {
 	
 	public $nome;
 	public $UF;
 	public $id;

 	function __construct(){

 	}
 	
 	function getNome(){
 		return $this->nome;
 	}

 	function getUF(){
 		return $this->UF;
 	}

 	function getId(){
 		return $this->id;
 	}

 	function setId($id){
 		$this->id = $id;
 	}

 	function setNome($nome){
 		$this->nome = $nome;
 	}

 	function setUF($UF){
 		$this->UF = $UF;
 	}


 	function criar(){
 		try{

 			$sql = "insert into Cliente (nome,UF)
 					values('".$this->nome."','".$this->UF."');"; 					
 			$bd = new Conexao(); 				

 		return $bd->executaSQL($sql);
 		}catch(exeption $e ){
 			return print $e;
 		}
 		
 	}

 	function atualizar(){
 		
 		try {
 			$sql = "update cliente set nome = '".$this->nome."',UF = '".$this->UF."' where id_Cliente = ".$this->id.";";

 			$bd = new Conexao(); 			
 			return $bd->executaSQL($sql);
 			unset($bd);

 			} catch (Exception $e) {
 				return print $e;
 			}	
 			
 	}

 	function excluir(){
 		try {
 				
 			$sql = " delete from cliente where id_Cliente = ".$this->id.";";

 			$bd = new Conexao();
 			return $bd->executaSQL($sql);
 			unset($bd);
 		} catch (Exception $e) {
 			return print $e;
 			
 		}
 	}

 	function buscar(){
 		try{

 			$sql = "select * from cliente;";
 			$bd = new Conexao(); 		
 			
 			return $bd->executaSQL($sql);
 			unset($bd);

 		}catch(exeption $e ){
 			return print $e;
 		}

 	}

 		function buscaCl($id){
 		try{

 			$sql = "select * from cliente where id_Cliente = $id;";
 			$bd = new Conexao(); 

 		return $bd->executaSQL($sql);
 		unset($bd);
 		}catch(exeption $e ){
 			return print $e;
 		}

 	}

 }







 ?>