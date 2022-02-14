<?php 

include_once('../model/produto.php');
/**
  * Control Produto
  * Autor: Plínio Araújo
  */


$nome 		= isset($_REQUEST['nome']) 			? $_REQUEST['nome'] 		: '';
$valor 		= isset($_REQUEST['valor']) 		? $_REQUEST['valor']		: 0;
$id_produto = isset($_REQUEST['id_produto']) 	? $_REQUEST['id_produto']	: 0;

if($nome == ' ' && $valor == 0){
	header("Location: ../view/cadProduto.php?msg=1");
	exit();
}


$produto = new produto();
$produto->setNome($nome);
$produto->setValor($valor);
$produto->setId_produto($id_produto);


if($_REQUEST['excluir']){
	$res = $produto->excluir();	
	header('Location: ../view/cadProduto.php?msg=4');
	exit();
}


if($id_produto == 0){
	$x = $produto->criar();	
	$msg = 2;
}else{
	$x = $produto->atualizar();
	$msg = 3;

}



unset($produto);

if($x == 0){
	header("Location: ../view/cadProduto.php?msg=1");	
	exit();
}else{
	header("Location: ../view/cadProduto.php?msg=".$msg);	
	exit();
}






?>