<?php


$conteudo = "nome:" . $_POST['nome-filme'] . ";" . "tempo:" . $_POST['tempo-filme'] . PHP_EOL;
 
$fp = fopen("filmes.txt","a+");
 
if (fwrite($fp,$conteudo) === FALSE) {
	fclose($fp);
	Header("Location:http://localhost/formacao-web/aula10/?" . "form=ERRO&nome-filme=" . $_POST['nome-filme'] . "&tempo-filme=" . $_POST['tempo-filme']);
	exit;
}else{
	fclose($fp);
	
	
	require_once("PHPMailerAutoload.php");

	$mail = new PHPMailer();
	$mail->IsSMTP();
	//$mail->SMTPDebug = 2;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "tls";
	$mail->Host = "smtp.live.com";
	$mail->Port = 587;

	$mail->Username = 'cursoformacaowebessencial@hotmail.com';
	$mail->Password = 'Curso#23s';
	$mail->Sender = "cursoformacaowebessencial@hotmail.com";
	$mail->From = "cursoformacaowebessencial@hotmail.com";
	$mail->FromName = "Curso Formação Desenvolvedor Web Full-Stack Essencial";
	
	$mail->AddAddress('cursoformacaowebessencial@hotmail.com', '');
	$mail->IsHTML(true);
	$mail->CharSet = 'utf-8';
	$mail->Subject  = "Mais um filme cadastrado!";
	$mail->Body = $conteudo;
	$mail->Send();
	


	$mail->ClearAllRecipients();



	Header("Location:http://localhost/formacao-web/aula10/?" . "form=OK&nome-filme=" . $_POST['nome-filme'] . "&tempo-filme=" . $_POST['tempo-filme']);
}
 



?>