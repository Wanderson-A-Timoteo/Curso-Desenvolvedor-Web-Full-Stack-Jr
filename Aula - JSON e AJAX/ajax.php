<?php

	require "conexao.php";


	foreach ($_POST as $key => $value) {
		$_POST[$key] = Conexao::anti_injection($value);
	}
	foreach ($_GET as $key => $value) {
		$_GET[$key] = Conexao::anti_injection($value);
	}

	$nome_filme = strtolower(utf8_decode($_GET['busca']));

	$con = Conexao::getInstance(1);
	$query = "SELECT * FROM filmes WHERE LOWER(nome) like '%$nome_filme%'";
	$filmes = $con->prepare($query);
	$filmes->execute();

	if($filmes->rowCount() < 1){
		echo "0";
		die();
	}
	
	$filmes_saida = array();
	
	$cont=0;
	while($filme = $filmes->fetch ( PDO::FETCH_OBJ )){
		$filmes_saida[$cont]['nome'] = utf8_encode($filme->nome);
		$filmes_saida[$cont]['tempo'] = $filme->tempo;
		$cont++;
	}
	
	echo json_encode($filmes_saida, JSON_UNESCAPED_UNICODE);

?>