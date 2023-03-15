<?php

require_once "../Prato.php";

use PHPUnit\Framework\TestCase;

class PratoTest extends TestCase
{
    public function testConstrutor()
    {
        $prato = new Prato('Nhoque', ['massa', 'molho']);
        $this->assertEquals('Nhoque', $prato->nome);
        $this->assertEquals(['massa', 'molho'], $prato->caracteristicas);
    }

    public function testGetCaracteristicaAleatoria()
    {
        $prato = new Prato('Nhoque', ['massa', 'molho']);
        $caracteristica = $prato->getCaracteristicaAleatoria();
        $this->assertContains($caracteristica, ['massa', 'molho']);
    }

    public function testSalvarPrato()
    {
        // Arrange
        $prato = new Prato('Nhoque', ['massa', 'molho']);

        // Act
        $prato->salvar();

        // Assert
        $jsonString = file_get_contents(__DIR__ . '/../../data/pratos.json');
        $jsonArray = json_decode($jsonString, true);
        $this->assertEquals('Nhoque', $jsonArray[count($jsonArray) -1]['nome']);
        $this->assertEquals(['massa', 'molho'], $jsonArray[count($jsonArray) -1]['caracteristicas']);
    }
}
