<?php  
  /**
  * View Pedido 
  * Autor: Plínio Araújo
  */
 ?>

<!DOCTYPE html>
<html>
<head>
  <title>Relatório Pedidos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="../control/ajax.js"></script>
  <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
  <?php        
    session_start();      
    include_once("../model/pedido.php");
    $msg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '';

    if ($msg == 1) {
        echo "<script> alert('Pedido excluído com sucesso')</script>";
      }elseif ($msg == 2){
        echo "<script> alert('Falha ao excluir o pedido')</script>";
      }     
  ?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>      
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="pedido.php">Pedidos</a></li>
        <li><a href="cadCliente.php">Cadastro Cliente</a></li>
        <li><a href="cadProduto.php">Cadastro Produto</a></li>
        <li><a href="relatorio.php">Relatórios</a></li>
      </ul>      
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
    
    </div>
    <div class="col-sm-8 text-left"> 
      <h1 align="center">Relatórios</h1>
      
       <table class="table">
        <th>Nº Pedido</th>   
        <th>Cliente</th>
        <th>Valor Total</th>
        <th>Ação</th>
        <tr>
          <?php
            $pedido = new Pedido();
            $x = $pedido->buscar();
            foreach ($x as $key) {              
              echo "<td>".$key['id_pedido']."</td>";              
              echo "<td>".$key['Nome']."</td>";
              echo "<td>R$ ".$key['Total']."</td>";
              echo "<td><a href='../control/pedido.php?deletar=".$key['id_pedido']."'>Excluir</a></td>";
              echo "</tr>";              
            }
           ?>        
       </table>      
    </div>
    <div class="col-sm-2 sidenav">
      
    </div>
  </div>
</div>
<footer class="container-fluid text-center">
  <p>Candidato Plínio Araújo</p>
  <p>E-mail: obrplinio18@gmail.com</p>
  <p>Contato: 9 9803-1955</p>
</footer>
</body>
</html>
