<?php  
  /**
  * View Produto 
  * Autor: Plínio Araújo
  */
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Cadastro Produto</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
  <?php
    include_once('../model/produto.php');

        $msg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '';

      if ($msg == 1) {
        echo "<script> alert('Falha ao cadastrar Produto!')</script>";
      }elseif ($msg == 2){
        echo "<script> alert('Produto Cadastrado com sucesso!')</script>";
      }elseif ($msg == 3) {
        echo "<script> alert('Produto atualizado com sucesso!')</script>";
      }elseif ($msg == 4) {
        echo "<script> alert('Produto Excluido com sucesso!')</script>";
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
      <h1 align="center">Cadastro Produtos</h1>
      <form class="form-group col-lg-12 " action="../control/cadProduto.php" method="post">
        <div class="form-group col-lg-6 " >
          <input type="number" name="id_produto" id="id_produto" hidden>
          <label  for="nome">Nome</label>
          <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group col-lg-6">
          <label for="valor">Valor Un.</label>
          <input type="number" step=0.01 class="form-control" id="valor" name="valor" required>          
        </div>           
        <div class="col-lg-6">
          <br>
          <button type="submit" class="btn btn-success">Salvar</button>
          <button type="reset" class="btn btn-default">Limpar</button>
          <button type="submit" name="excluir" value="exclur" class="btn btn-danger">Excluir</button>    
          <br>
          <br><br>
        </div>

      </form>

      <button class="btn btn-block btn-success btn-lg" onclick="javascript:relProdutos();" type="button">Produtos Cadastrados</button> 
      <div class="container col-lg-12" id="rels" style="display: none;">
        <h5>**Clique para editar.</h5>
        <table class="table " >
          <th>Cod.</th>
          <th>Nome</th>
          <th>Valor Unitário</th>

          <tr onclick='javascript:getValue(this)'>
            <?php
              $pr = new Produto();
              $x = $pr->buscar();
              foreach ($x as $k ) {
                echo "<tr onclick='javascript:getValue(this)'>";
                echo "<td>".$k['id_produto']."</td>";
                echo "<td>".$k['nome']."</td>";
                echo "<td>".$k['valor']."</td></tr>";
              }
             ?>
        </table>
      </div>
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

<script>
   function relProdutos(){
    var div1 = document.getElementById("rels").style.display;
    if(div1 == 'none'){
      document.getElementById("rels").style.display='block';
    }else{
      document.getElementById("rels").style.display='none';
      }
    }
    function getValue(obj){
      document.querySelector("[name='id_produto']").value   = obj.getElementsByTagName("td")[0].innerHTML;
      document.querySelector("[name='nome']").value         = obj.getElementsByTagName("td")[1].innerHTML;
      document.querySelector("[name='valor']").value           = obj.getElementsByTagName("td")[2].innerHTML;
    }
</script>

</body>
</html>
