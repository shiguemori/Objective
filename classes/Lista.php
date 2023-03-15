<?php

/**
 *
 */
class Lista {
    /**
     * @var
     */
    public $pratos;

    /**
     * @return mixed
     */
    public function getPratos()
    {
        return array_values($this->pratos);
    }

    /**
     * @param $pratos
     */
    function __construct($pratos) {
        $this->pratos = $pratos;
    }

    /**
     * @param $caracteristica
     * @param $nome
     * @return void
     */
    public function filtrar($caracteristica, $nome)
    {
        if ($nome) {
            $this->pratos = array_filter($this->pratos, function ($prato) use ($caracteristica) {
                return in_array($caracteristica, $prato->caracteristicas);
            });
            $this->pratos = array_filter($this->pratos, function () use ($nome) {
                return !in_array($nome, $this->pratos);
            });
        } else {
            if ($caracteristica) {
                $this->pratos = array_filter($this->pratos, function ($prato) use ($caracteristica) {
                    return !in_array($caracteristica, $prato->caracteristicas);
                });
            }
        }
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->pratos);
    }

    /**
     * @return mixed
     */
    public function pratoAleatorio(){
        $aleatorio = $this->getPratos()[rand(0, $this->count() - 1)];
        $this->pratos = array_filter($this->pratos, function ($prato) use ($aleatorio) {
            return $prato !== $aleatorio;
        });
        return $aleatorio;
    }

}