<?php


	function getActiveItems(){
		$sql = "SELECT istb.idItemPagina, pizr.telefone, istb.idPizzaria, istb.imagemEstabelecimento, istb.iconeBanda, istb.ativo, pizr.idEndereco, estd.idEstado, estd.estado, cdde.idCidade, cdde.cidade, endc.cep, endc.logradouro, endc.numero, endc.bairro, estd.uf FROM tbl_item_estabelecimento AS istb INNER JOIN tbl_pizzaria AS pizr ON istb.idPizzaria = pizr.idPizzaria INNER JOIN tbl_endereco AS endc ON endc.idEndereco = pizr.idEndereco INNER JOIN tbl_cidade AS cdde ON cdde.idCidade = endc.idCidade INNER JOIN tbl_estado AS estd ON estd.idEstado = cdde.idEstado WHERE istb.ativo = 1;";

		return mysql_query($sql);
	}



?>