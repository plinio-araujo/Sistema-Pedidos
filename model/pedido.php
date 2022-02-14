<?php 
	include_once('banco.php');
	/**
  * Classe Pedido
  * Autor: Plínio Araújo
  */

	class Pedido{
	
		
		public $id_cliente;		
		public $total;


		function __construct(){

		}

	
		function criar(){
			try{
				$sql = "insert into pedido (id_cliente,total) 
						values (".$this->id_cliente.",".$this->total.");";
				$bd = new Conexao();
				return $bd->executaSQL($sql);
				unset($bd);

			} catch (Exception $e){
				print $e;
			}
		}

		
		function buscar(){
			try {
				$sql = "select id_pedido,nome as Nome,total as Total from pedido as p 
						inner join cliente as cl
						where p.id_cliente = cl.id_cliente;";
				$bd = new Conexao();
				return $bd->executaSQL($sql);
				uset($bd);

			} catch (Exception $e){
				print $e;
			}
		}

		function ultimoPedido(){
			try{
				$sql = "select max(pedido) from pedido;";
				$bd = new Conexao();
				return $bd->executaSQL($sql);
				unset($bd);

			} catch (Exception $e){
				print $e;
			}

		}

		function buscarP($id){
			try{
				$sql = "select id_pedido,nome as Nome,total as Total from pedido as p 
					inner join cliente as cl
					where p.id_cliente = cl.id_cliente and id_pedido = $id";

				$bd = new Conexao();
				return $bd->executaSQL($sql);

				unset($bd);

			} catch (Exception $e){
				print $e;
			}
		}

		function excluir(){
			try{
				$sql = "delete from pedido where id_pedido = ".$this->id_pedido.";";				
				$bd = new Conexao();
				return $bd->executaSQL($sql);
				unset($bd);
			} catch (Exception $e){
				print $e;
			}

		}

		function getId_pedido(){
			return $this->id_pedido;
		}		

		function getId_cliente(){
			return $this->id_cliente;
		}

		function getId_produto(){
			return $this->id_produto;
		}

		function getTotal(){
			return $this->total;
		}

		function setId_pedido($id_pedido){
			$this->id_pedido = $id_pedido;
		}

		function setId_cliente($id_cliente){
			$this->id_cliente = $id_cliente;
		}		

		function setTotal($total){			
			$this->total = $total;
		}

	
	}



 ?>