<?php

/**
 * Class Prato
 */
class Prato
{
    /**
     * @var
     */
    public $nome;
    /**
     * @var
     */
    public $caracteristicas;

    /**
     * @param $nome
     * @param $caracteristicas
     */
    function __construct($nome, $caracteristicas)
    {
        $this->nome = ucfirst($nome);
        $this->caracteristicas = $caracteristicas;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return mixed
     */
    public function getCaracteristicas()
    {
        return $this->caracteristicas;
    }

    /**
     * @return string
     */
    function getCaracteristicaAleatoria(): string
    {
        return $this->caracteristicas[rand(0, count($this->caracteristicas) - 1)];
    }

    /**
     * @return bool
     */
    public function salvar(): bool
    {
        $filePath = __DIR__ . '/../data/pratos.json';
        $jsonString = file_get_contents($filePath);
        $jsonArray = [];

        if (strlen($jsonString) > 0) {
            $jsonArray = json_decode($jsonString, true);
        }

        $pratoExistente = false;
        foreach ($jsonArray as $key => $value) {
            if ($value['nome'] === $this->nome) {
                $jsonArray[$key]['caracteristicas'] = array_unique(array_merge($jsonArray[$key]['caracteristicas'], $this->caracteristicas));
                $pratoExistente = true;
                break;
            }
        }

        if (!$pratoExistente) {
            $jsonArray[] = $this;
        }

        $novoJsonString = json_encode($jsonArray);
        return !(file_put_contents($filePath, $novoJsonString) == false);
    }
}