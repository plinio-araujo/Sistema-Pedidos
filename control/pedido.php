<?php

	session_start();
	include_once("../model/pedido.php");
	include_once("../model/cliente.php");
	include_once("../model/cliente.php");
	/**
  * Control Pedido
  * Autor: Plínio Araújo
  */
	
	if(isset($_REQUEST['deletar'])){		
		$pedido = new Pedido();
		$pedido->setId_pedido($_REQUEST['deletar']);				
		$x = $pedido->excluir();
		if($x){
			$msg = 1;
			header("Location: ../view/relatorio.php?msg=".$msg);
			exit();
		}else{
			$msg = 2;
			header("Location: ../view/relatorio.php?msg=".$msg);
			exit();
		}

	}

	if(isset($_SESSION['itensCarrinho']) && $_SESSION['cliente']){
		echo "Sessao Cliente <br>";
		var_dump($_SESSION['cliente']);
		echo "<hr><br>";
		echo "Sessao Carrinho <br>";
		var_dump($_SESSION['itensCarrinho']);
		echo "<hr><br>";
		
		$cliente = new Cliente();

		$cl = $_SESSION['cliente'];		
		
		$cliente->setId($cl[0]);
		$cliente->setNome($cl[1]);
		$cliente->setUF($cl[2]);
			
		

		echo "<hr><br>";
		echo "Obj Cliente <br>";
		var_dump($cliente);		
		echo "<hr><br>";


		$itens = $_SESSION['itensCarrinho'];
		$vFinal = $_SESSION['vFinal'];

		$pedido = new Pedido();
		$pedido->setId_cliente($cl[0]);		
		$pedido->setTotal($vFinal);

		$x = $pedido->criar();
		if($x){
			$msg = 4;
			unset($_SESSION['itensCarrinho']);
			unset($_SESSION['cliente']);
			header("Location: ../view/pedido.php?msg=".$msg);
			exit();
		}else{
			$msg = 3;
			header("Location: ../view/pedido.php?msg=".$msg);
			exit();
		}		
	}else{
		$msg = 3;
		header("Location: ../view/pedido.php?msg=".$msg);
		exit();
	}





 ?>