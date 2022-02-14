<?php 

include_once('../model/cliente.php');
/**
  * Control Cliente
  * Autor: Plínio Araújo
  */

session_start();

$nome 		= isset($_REQUEST['nome']) 			? $_REQUEST['nome'] 		: '';
$UF 		= isset($_REQUEST['UF']) 			? $_REQUEST['UF']			: 0;
$id_cliente = isset($_REQUEST['id_cliente']) 	? $_REQUEST['id_cliente']	: 0;

if(isset($_REQUEST['resetar'])){
	unset($_SESSION['cliente']);
	unset($_SESSION['itensCarrinho']);
	header("Location: ../view/pedido.php");
	exit();
}

if(isset($_REQUEST['busca'])){
	$busca = new Cliente();
	$x = $busca->buscaCl($_REQUEST['busca']);
	
	foreach ($x as $k) {
		$cliente = array($k['id_cliente'],$k['nome'],$k['uf']);	
	}
	unset($_SESSION['cliente']);
	unset($_SESSION['itensCarrinho']);
	$_SESSION['cliente'] = $cliente;	
	header("Location: ../view/pedido.php");
	exit();
}

if($nome == ' ' && $UF == 0){
	header("Location: ../view/cadCliente.php?msg=1");
	exit();
}


$cliente = new Cliente();
$cliente->setNome($nome);
$cliente->setUF($UF);
$cliente->setId($id_cliente);

if($_REQUEST['excluir']){
	$res = $cliente->excluir();
	header('Location: ../view/cadCliente.php?msg=4');
	exit();
}


if($id_cliente == 0){
	$x = $cliente->criar();	
	$msg = 2;
}else{
	$x = $cliente->atualizar();
	$msg = 3;

}
unset($cliente);

if($x == 0){
	header("Location: ../view/cadCliente.php?msg=1");	
	exit();
}else{
	header("Location: ../view/cadCliente.php?msg=".$msg);	
	exit();
}






?>