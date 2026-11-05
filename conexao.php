<?php

$servidor = "localhost"
$usuario = "root";
$senha = "";
$banco = "premium_imoveis";

try {
    $conexao = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO:ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
    echo "Falha na conexão: " . $erro->getMessage();
}

?>