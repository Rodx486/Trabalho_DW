<?php
header('Content-Type: application/json');

$caminhoJson = '../data/catalogo.json';


if (file_exists($caminhoJson)) {

    $conteudoJson = file_get_contents($caminhoJson);


    echo $conteudoJson;
} else {


    echo json_encode(['erro' => 'Arquivo não encontrado']);
}
