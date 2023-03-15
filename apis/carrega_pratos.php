<?php

require_once "../classes/Prato.php";
require_once "../classes/Lista.php";

header('Content-Type: application/json');

try {

    $json = json_decode($_POST['json'], true);
    $pratos = [];
    foreach ($json as $item) {
        $prato = new Prato($item['nome'], $item['caracteristicas']);
        $pratos[] = $prato;
    }

    $lista = new Lista($pratos);

    $caracteristica = $_POST['caracteristica'] ?? null;
    $nome = $_POST['nome'] ?? null;

    $lista->filtrar($caracteristica, $nome);

    if ($lista->count() == 0) {
        echo json_encode(["selecionado" => null,]);
        return;
    }

    /** @var Prato $aleatorio */
    $aleatorio = $lista->pratoAleatorio();

    http_response_code(200);
    echo json_encode(["pratos" => $lista->getPratos(), "selecionado" => $aleatorio, "caracteristica" => $aleatorio->getCaracteristicaAleatoria()]);
} catch (Exception $exception) {
    http_response_code(500);
    echo json_encode($exception->getMessage());
}