
<?php  
  /**
  * View Cliente 
  * Autor: Plínio Araújo
  */
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Cadastro Cliente</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
  <?php
    include_once('../model/cliente.php');

        $msg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '';

      if ($msg == 1) {
        echo "<script> alert('Falha ao cadastrar Cliente!')</script>";
      }elseif ($msg == 2){
        echo "<script> alert('Cliente Cadastrado com sucesso!')</script>";
      }elseif ($msg == 3) {
        echo "<script> alert('Usuario atualizado com sucesso!')</script>";
      }elseif ($msg == 4) {
        echo "<script> alert('Usuario Excluido com sucesso!')</script>";
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
      <h1 align="center">Cadastro Cliente</h1>
      <form class="form-group col-lg-12 " action="../control/cadCliente.php" method="post">
        <div class="form-group col-lg-6 " >
          <input type="number" name="id_cliente" id="id_cliente" hidden>
          <label  for="nome">Nome</label>
          <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group col-lg-6">
          <label for="UF">Estado</label>
          <select required name="UF" id="uf" class="form-control ">  
            <option value="" disabled selected>Selecione....</option>
            <option value="PR">PR</option>
            <option value="RJ">RJ</option>
            <option value="SP">SP</option>
            <option value="RS">RS</option>
          </select>                
        </div>           
        <div class="col-lg-6">
          <br>
          <button type="submit" class="btn btn-success">Salvar</button>
          <button type="reset" class="btn btn-default">Limpar</button>
          <button type="submit" name="excluir" value="excluir" class="btn btn-danger">Excluir</button>    
          <br>
          <br><br>
        </div>

      </form>

      <button class="btn btn-block btn-success btn-lg" onclick="javascript:relCliente();" type="button">Clientes Cadastrados</button> 
      <div class="container col-lg-12" id="rels" style="display: none;">
        <h5>**Clique para editar.</h5>
        <table class="table" >
          <th>ID</th>
          <th>Nome</th>
          <th>UF</th>

          <tr onclick='javascript:getValue(this)'>
            <?php
              $cl = new Cliente();
              $x = $cl->buscar();

              foreach ($x as $k ) {
                echo "<tr onclick='javascript:getValue(this)'>";
                echo "<td>".$k['id_cliente']."</td>";
                echo "<td>".$k['nome']."</td>";
                echo "<td>".$k['uf']."</td></tr>";
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
   function relCliente(){
    var div1 = document.getElementById("rels").style.display;
    if(div1 == 'none'){
      document.getElementById("rels").style.display='block';
    }else{
      document.getElementById("rels").style.display='none';
      }
    }
    function getValue(obj){
      document.querySelector("[name='id_cliente']").value   = obj.getElementsByTagName("td")[0].innerHTML;
      document.querySelector("[name='nome']").value         = obj.getElementsByTagName("td")[1].innerHTML;
      document.querySelector("[name='UF']").value           = obj.getElementsByTagName("td")[2].innerHTML;
    }
</script>

</body>
</html>
