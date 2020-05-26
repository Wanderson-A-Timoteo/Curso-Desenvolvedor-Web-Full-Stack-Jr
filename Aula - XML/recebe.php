<?php

$dom = new DomDocument('1.0', 'utf-8');
$dom->formatOutput = true;    
$dom->preserveWhiteSpace = false;
$dom->load('filmes.xml');


$filmes = $dom->getElementsByTagName('filmes')->item(0);

$filme = $dom->createElement('filme');

$nome = $dom->createElement('nome');
$tempo = $dom->createElement('tempo');

$nome_filme = $dom->createTextNode($_POST['nome-filme']); 
$tempo_filme = $dom->createTextNode($_POST['tempo-filme']); 

$nome->appendChild($nome_filme);
$tempo->appendChild($tempo_filme);

$filme->appendChild($nome);
$filme->appendChild($tempo);

$filmes->appendChild($filme);

$dom->save('filmes.xml');

Header("Location:http://localhost/formacao-web/aula11/?" . "form=OK&nome-filme=" . $_POST['nome-filme'] . "&tempo-filme=" . $_POST['tempo-filme']);


?>