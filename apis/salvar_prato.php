<?php

require_once "../classes/Prato.php";
require_once "../classes/Lista.php";

header('Content-Type: application/json');

try {
    $caracteristica = $_POST['caracteristica'] ?? null;
    $similar = $_POST['similar'] ?? null;
    $nome = $_POST['nome'] ?? null;

    $caracteristicas[] = $caracteristica;
    if (strlen($similar) > 0) {
        $caracteristicas[] = $similar;
    }
    $prato = new Prato($nome, $caracteristicas);
    $prato->salvar();
    http_response_code(201);
    echo json_encode(["response" => $prato->salvar()]);
} catch (Exception $exception) {
    http_response_code(500);
    echo json_encode($exception->getMessage());
}