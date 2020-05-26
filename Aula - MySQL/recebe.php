<?php

	require "conexao.php";


	foreach ($_POST as $key => $value) {
		$_POST[$key] = Conexao::anti_injection($value);
	}
	foreach ($_GET as $key => $value) {
		$_GET[$key] = Conexao::anti_injection($value);
	}

	$nome_filme = utf8_decode($_POST['nome-filme']);
	$tempo_filme = $_POST['tempo-filme'];

	$con = Conexao::getInstance(1);
	$query = "INSERT INTO filmes VALUES (NULL, '$nome_filme', '$tempo_filme', now())";
	$stmt = $con->prepare($query);
	$stmt->execute();
	
	if($stmt->errorCode() != 0){
		Header("Location:http://localhost/formacao-web/aula12/?" . "form=ERRO&nome-filme=" . $_POST['nome-filme'] . "&tempo-filme=" . $_POST['tempo-filme']);
		die();
	}else{
		Header("Location:http://localhost/formacao-web/aula12/?" . "form=OK&nome-filme=" . $_POST['nome-filme'] . "&tempo-filme=" . $_POST['tempo-filme']);
		die();
	}




?>