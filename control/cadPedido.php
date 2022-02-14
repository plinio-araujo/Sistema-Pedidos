<?php
	session_start();
	/**
  * Control Pedido Sessao
  * Autor: Plínio Araújo
  */

	header('Access-Control-Allow-Origin: *');
	include_once('../model/cliente.php');
	include_once('../model/produto.php');

/******************Limpar Itens da sessão************************/
	if(isset($_REQUEST['resetar'])){
		unset($_SESSION['itensCarrinho']);
		$msg = 2;
		header("Location: ../view/pedido.php?msg=".$msg);
		exit();
	}
/*****************************************************************/	


/******************Deletar Itens da sessão************************/
	if(isset($_REQUEST['deletar'])){
		if(isset($_SESSION['itensCarrinho'])){
			$itensold = $_SESSION['itensCarrinho'];
			foreach ($itensold as $i => $item) {
					if($i != $_REQUEST['deletar']){
						$itens[]=$item;
					}
			}
			if(!isset($itens)){
				unset($_SESSION['itensCarrinho']);
				$msg =2;
				header("Location: ../view/pedido.php?msg=".$msg);
				exit();
			}else{
				$_SESSION['itensCarrinho'] = $itens; 
				header("Location: ../view/pedido.php");
				exit();
			}
		}		
	}
/*****************************************************************/	

	
/******************Inclur Itens da sessão************************/
	
	if (isset($_REQUEST['id_produto']) && isset($_REQUEST['qtd'])) {
		if (isset($_SESSION['itensCarrinho'])) {
			$itens = $_SESSION['itensCarrinho'];
		} else {
			$itens = array();
		}

		$qtd = isset($_REQUEST['qtd']) ? $_REQUEST['qtd'] : 0;

		if($qtd == 0){
			$msg = 1;
			header("Location: ../view/pedido.php?msg=".$msg);
			exit();
		}else{
			$qtd = $_REQUEST['qtd'];	
		}

		


		$valor = 0;
		$produto = new Produto();
		$x = $produto->BuscarP($_REQUEST['id_produto']);
		foreach ($x as $key ) {
			$valor = $qtd * $key['valor'];
			$itens[] = array($key['id_produto'],$key['nome'],$key['valor'],$qtd, $valor);
		}

		
		var_dump($itens);
		$_SESSION['itensCarrinho'] = $itens;
		header("Location: ../view/pedido.php");
		exit();	
	}
	$msg =1;
	header("Location: ../view/pedido.php?msg=".$msg);
/*****************************************************************/	

	
 ?>