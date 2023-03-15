<?php

require_once "../Prato.php";
require_once "../Lista.php";

use PHPUnit\Framework\TestCase;

class ListaTest extends TestCase
{
    public function testGetPratos()
    {
        $pratos = [
            new Prato('Nhoque', ['massa']),
            new Prato('Sashimi', ['peixe cru']),
        ];
        $lista = new Lista($pratos);
        $this->assertEquals($pratos, $lista->getPratos());
    }

    public function testFiltrar()
    {
        $pratos = [
            new Prato('Nhoque', ['massa']),
            new Prato('Coxinha', ['massa']),
            new Prato('Sashimi', ['peixe cru']),
        ];
        $lista = new Lista($pratos);

        $lista->filtrar("massa", 'Nhoque');
        $this->assertCount(2, $lista->getPratos());
        $this->assertEquals('Nhoque', $lista->getPratos()[0]->nome);

        $lista->filtrar('massa', null);
        $this->assertCount(0, $lista->getPratos());
    }

    public function testCount()
    {
        $pratos = [
            new Prato('Nhoque', ['massa']),
            new Prato('Sashimi', ['peixe cru']),
        ];
        $lista = new Lista($pratos);
        $this->assertEquals(2, $lista->count());
    }

    public function testPratoAleatorio()
    {
        $pratos = [
            new Prato('Lasanha', ['massa']),
            new Prato('Sushi', ['peixe cru']),
        ];
        $lista = new Lista($pratos);
        $aleatorio = $lista->pratoAleatorio();
        $this->assertContains($aleatorio, $pratos);
        $this->assertEquals(1, $lista->count());
    }
}