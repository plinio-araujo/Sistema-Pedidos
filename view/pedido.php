<?php  
  /**
  * View Pedido 
  * Autor: Plínio Araújo
  */
 ?>

<!DOCTYPE html>
<html>
<head>
  <title>Pedidos</title>
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
    include_once('../model/produto.php');
    include_once('../model/cliente.php');
        
        session_start();

        $msg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '';
        $id_cliente = isset($_REQUEST['id_cliente']) ? $_REQUEST['id_cliente'] : 0;  

        if(isset($_SESSION['cliente'])){
            $cliente = new Cliente();
            $x = $_SESSION['cliente'];
            $cliente->setId($x[0]);
            $cliente->setNome($x[1]);
            $cliente->setUF($x[2]);            
        }else{
          unset($_SESSION['itensCarrinho']);

        }

      if ($msg == 1) {
        echo "<script> alert('Falha ao Buscar o produto!')</script>";
      }elseif ($msg == 2){
        echo "<script> alert('Carrinho Vazio!')</script>";
      }elseif ($msg == 3) {
        echo "<script> alert('Falha ao Salvar o pedido')</script>";
      }elseif ($msg == 4) {
        echo "<script> alert('Pedido salvo com sucesso!')</script>";
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
      <h1 align="center">Criar Pedido</h1>
      <form class="form-group col-lg-12 " action="../control/pedido.php" method="post">
       
        <div class="col-lg-10">                    
            <input type="number" name="id_cliente" id="id_cliente" hidden <?php if (isset($cliente)) {echo "value='".$cliente->getId()."'";}?>>
            <div class=" col-lg-6">
              <label>Cliente:</label>
              <input class="form-control" type="text" name="nome" id="nome" disabled  <?php if (isset($cliente)) {echo "value='".$cliente->getNome()."'";}?>>
            </div>
            <div class="col-lg-6">
            <label>UF:</label>
            <input class="form-control" type="text" name="uf" id="uf" disabled  <?php if (isset($cliente)) {echo "value='".$cliente->getUF()."'";}?>>          
            </div>
        </div>

        <div class="col-lg-1">
          <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">Clientes</button>             
        </div>
        <div class="col-lg-1">
          <button type="button" class="btn btn-default btn-md" ><a href="../control/cadCliente.php?resetar=1"> Limpar</a></button>  
        </div>

        <div class="col-lg-12">
          <hr>
          <br>
          <h4 class="col-lg-10"><b>Pedido</b></h4>
          <div class="col-lg-2">
            <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal1">Produtos</button>
            
          </div>
          <br>
        </div>
        <div class="col-lg-12">
          <table class="table table-hover table-bordered" id="pedido">
            <th>ID:</th>
            <th>Nome</th>
            <th>Valor Uni.</th>
            <th>Quantidade</th>
            <th>Total</th>
            <th>Ação</th>
            <tr>
              <?php 
                $valor = 0;
                if(isset($_SESSION['itensCarrinho'])){
                  $itens = $_SESSION['itensCarrinho'];
                  foreach ($itens as $key => $item) {
                    echo "<td>".$item[0]."</td>";
                    echo "<td>".$item[1]."</td>";
                    echo "<td>".$item[2]."</td>";
                    echo "<td>".$item[3]."</td>";
                    echo "<td>".$item[4]."</td>";
                    echo "<td><a href='../control/cadPedido.php?deletar='".$key."'>Excluir</a></td>";
                    
                    $valor += $item[4];
                    $total = $valor;
                    echo "<tr>";
                  }

                }
                
              ?>
            
          </table>          
        </div>
        <div id="teste">
          
        </div>
        <div class="col-lg-12">
          <hr>
          <h5 align="right">Total: <?php if(isset($total)){echo $total;} ?></h5>
          <h5 align="right">Desconto: 
          <?php 
            if(isset($cliente) && $cliente->getUF() == "PR"){
                echo "10% ";
              }else{
                echo "0.00%";
              } 
            ?> 
          </h5>
          <h5 align="right">Valor Total: 
          <?php 
            if(isset($total)){
              if($cliente->getUF() == "PR"){
                $por = ($total * 10)/100; 
                $vFinal =  $total - $por;
                $vFinal = number_format($vFinal, 2, '.', '');
                echo $vFinal;
                $_SESSION['vFinal'] = $vFinal;
              }else{
                echo $total;
                $_SESSION['vFinal'] = $total;
              }
            } 
            ?></h5>
          
        </div>         
        <div class="col-lg-">
          <br>
          <br>
          <br>
          <br>

          <button type="submit" class="btn btn-success">Salvar</button>
          <button type="button" class="btn btn-default" ><a href="../control/cadPedido.php?resetar=1"> Limpar Carrinho</a></button>
          
          <br>
          <br><br>
        </div>

      </form>
        
          <!-- Modal -->
      <div class="modal fade" id="myModal1" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Selecione um produto</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
              <label for="produto">Produto:</label>
              <select name="produto" id="produto" required class="form-control">
                <option value="#" disabled selected>Selecione...</option>
                <?php
                  $pr = new Produto();
                  $x = $pr->buscar();
                  foreach ($x as $registro ) {
                    echo "<option value='".$registro['id_produto']."'>".$registro['nome']." - R$ ".$registro['valor']."</option>";
                  }
               ?>
             </select>
             </div>
             <div class="form-group">
              <label>Quantidade:</label>
             <input placeholder="Quantidade" type="number" name="qtd" id="qtd" class="form-control " required>
             </div>
            </div>
            <div class="modal-footer">
              <a class="btn btn-info" href="#"  onclick="Produto();">Buscar</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
          </div>
          
        </div>
      </div>
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Clientes</h4>
            </div>
            <div class="modal-body">
              <select required id="clientes" name="clientes" class="form-control">
              <option value="" disabled selected> Selecione...</option>
              <?php
                $cl = new Cliente();
                $x = $cl->buscar();
                foreach ($x as $k) {
                  echo "<option value='".$k['id_cliente']."'>".$k['nome']." -- UF: ".$k['uf']."</option>";
                  $clientes[] = array($k['id_cliente'],$k['nome'],$k['uf']);
                }
                
               ?>
            </select>      
            </div>
            <div class="modal-footer">
              <a class="btn btn-info" href="#"  onclick="abreLink();">Buscar</a>
              <button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:id();">Fechar</button>

            </div>
          </div>
          
        </div>
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

    function getValue(obj){
      document.querySelector("[name='id_produto']").value   = obj.getElementsByTagName("td")[0].innerHTML;
      document.querySelector("[name='nome']").value         = obj.getElementsByTagName("td")[1].innerHTML;
      document.querySelector("[name='valor']").value        = obj.getElementsByTagName("td")[2].innerHTML;
      document.querySelector("[name='qtd']").value          = obj.getElementsByTagName("td")[2].innerHTML;
    }

    function abreLink(){
      var v1 = document.querySelector("[name='clientes']").value;      
      if(v1 ==''){
        alert('Selecione um Cliente!');
      }else{
        location.href = "../control/cadCliente.php?busca="+v1;
      }
    }    
     function Produto(){
      var v1 = document.querySelector("[name='produto']").value;
      var v2 = document.querySelector("[name='qtd']").value;
      if(v1 ==''){
        alert('Selecione um Cliente!');
      }else{
        location.href = "../control/cadPedido.php?id_produto="+v1+"&qtd="+v2;
      }
    }    
  

</script>

</body>
</html>
