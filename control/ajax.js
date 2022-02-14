function ajaxGet(obj) {
	// Exemplo de requisição GET
	var ajax = new XMLHttpRequest();

	var caminho = "../control/cadPedido.php?id_produto=" + obj;
	

	// Seta tipo de requisição e URL com os parâmetros
	ajax.open("GET", caminho, true);

	// Envia a requisição
	ajax.send();

	// Cria um evento para receber o retorno.
	ajax.onreadystatechange = function() {
	  // Caso o state seja 4 e o http.status for 200,
	  // é porque a requisiçõe deu certo.
		if (ajax.readyState == 4 && ajax.status == 200) {
			var data = ajax.responseText;
		// Retorno do Ajax
			
			//preencherTabela(data);
		}
	}
} 

function preencherTabela(data) {
	var tab1 = document.getElementById("pedido");
	var html = '<table class="table">';
	var obj = JSON.parse(data);
	
	html = html + "<th>Cod.</th>";
	html = html + "<th>Nome</th>";
	html = html + "<th>Valor</th>";	
	html = html + "</tr>";
	

	for (i=0; i < obj.length; i++) {
		html = html + "<tr>";
		html = html + "<td>"+obj[i].id_produto+"</td>";
		html = html + "<td>"+obj[i].nome+"</td>";
		html = html + "<td>"+obj[i].valor+"</td>";		
		//html = html + "<td>1</td>";	
		html = html + "</tr>";
	}
	html = html + "</table>";
	tab1.innerHTML = html;


}
