<?php

require_once "classes/Lista.php";
require_once "classes/Prato.php";

$json = json_decode(file_get_contents('data/pratos.json'), true);
$pratos = array();
foreach ($json as $item) {
    $prato = new Prato($item['nome'], $item['caracteristicas']);
    array_push($pratos, $prato);
}

$lista = new Lista($pratos);

/** @var Prato $aleatorio */
$aleatorio = $lista->pratoAleatorio();
$caracteristicaAleatoria = $aleatorio->getCaracteristicaAleatoria();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo Gourmet Shiguemori</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
            integrity="sha384-P7sRymMEsGy7V32yv0n6UaR6RY1nb6UWkDvSkd6qGLi6oy9cegj1YVTb+eAWE1l6"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4">
        <div class="step" id="step-1">
            <h2>Pense em um prato que gosta</h2>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary" id="sim-1">OK</button>
            </div>
        </div>
        <div class="step" id="step-2">
            <h2>O prato que você pensou tem, possui ou é <label class="caracteristica"><?= $caracteristicaAleatoria ?></label>?</h2>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary mr-2" id="sim-2">Sim</button>
                <button class="btn btn-secondary" id="nao-2">Não</button>
            </div>
        </div>

        <div class="step" id="step-3">
            <h2>O prato que você pensou é <label id="palpite" class="nome"><?= $aleatorio->getNome() ?> ?</label></h2>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary mr-2" id="sim-3">Sim</button>
                <button class="btn btn-secondary" id="nao-3">Não</button>
            </div>
        </div>

        <div class="step" id="step-4">
            <h2>Acertei de novo!</h2>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary" id="sim-4">Ok</button>
            </div>
        </div>


        <div class="step" id="step-5">
            <h2>Qual prato você pensou?</h2>
            <input class="form-control" type="text" id="prato"><br>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary mr-2" id="sim-5">Ok</button>
                <button class="btn btn-secondary" id="nao-5">Cancelar</button>
            </div>
        </div>

        <div class="step" id="step-6">
            <h2>Qual característica <label class="novo-prato"></label> tem que o(a) <label id="prato-similar" class="nome">
                    <?= $aleatorio->getNome() ?>
                </label> não tem?</h2>
            <input class="form-control" type="text" id="nova-caracteristica"><br>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary" id="sim-6">Ok</button>
            </div>
        </div>
    </div>
    <input id="lista" type="hidden" value="<?= htmlspecialchars(json_encode($lista->getPratos())) ?>">
    <input id="nome" type="hidden" value="<?= htmlspecialchars($aleatorio->getNome()) ?>">
    <input id="categoria" type="hidden" value="<?= htmlspecialchars($caracteristicaAleatoria) ?>">
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>

