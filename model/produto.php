<?php 
	
	include_once('Banco.php');
	/**
  * Classe Produto
  * Autor: Plínio Araújo
  */
	
	class Produto{

		public $id_produto;
		public $nome;
		public $valor;

		function __construct(){

		}

		function getNome(){
			return $this->nome;
		}

		function getValor(){
			return $this->valor;
		}

		function getId_produto(){
			return $this->id_produto;
		}

		function setNome($nome){
			$this->nome = $nome;
		}

		function setValor($valor){
			$this->valor = $valor;
		}

		function setId_produto($id_produto){
			$this->id_produto = $id_produto;
		}

		function criar(){
			try {
				$sql = " insert into produto (nome,valor)
					values ('".$this->nome."',".$this->valor.");";					
				$bd = new Conexao();
				return $bd->executaSQL($sql);
				unset($bd);

			} catch (Exception $e) {
				print $e;				
			}

		}

		function atualizar(){
			try {
				$sql = "update produto set nome = '".$this->nome."', 
					valor = ".$this->valor." where id_produto = ".$this->id_produto.";";				
				$bd = new Conexao();
				return $bd->executaSQL($sql);
				unset($bd);
				
			} catch (Exception $e) {
				print $e;
			}
		}

		function buscar(){
			try{

				$sql = "select * from produto;";
				$bd = new Conexao();
				return $bd->executaSQL($sql);				 
				unset($bd);

			} catch(Exception $e){
				print $e;
			}
		}

		function buscarP($id_produto){
			try{

				$sql = "select * from produto where id_produto = ".$id_produto.";";
				$bd = new Conexao($sql);				
				return $bd->executaSQL($sql);				 
				unset($bd);

			} catch (Exception $e){
				print $e;
			}
		}

		function excluir(){
			try{
				$sql = "delete from produto where id_produto = ".$this->id_produto.";";
				$bd = new Conexao();
				return $bd->executaSQL($sql);
				unset($bd);

			} catch (Exception $e){
				print $e;
			}
		}
	}

 ?>