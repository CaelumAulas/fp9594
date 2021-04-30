<?php 

require "../projeto/src/lib/utils.php";

// classe abstrata
abstract class Passaro 
{
    private $características = array('bico', '2 olhos');
    public function voar() 
    {
        print "Voando....<br>";
    }

    public function getCaracteristicas()
    {
        return $this->características;
    }

    public abstract function piar();
}

// classe concreta
class Pombo extends Passaro 
{
    public function __construct()
    {
        print "Eu sou um pombo!<br>";
    }

    // Sobrescrita de método (Method Overwriting)
    public function voar() 
    {
        print "Voando como um pombo...<br>";
    }

    public function piar()
    {
        print "pru pru pru...<br>";
    }
}

class Papagaio extends Passaro 
{
    public function __construct()
    {
        print "eu sou um papagaio!<br>";
    }

    public function piar()
    {
        print "curupaco...<br>";
    }
}

$passaro = new Pombo();
$passaro->voar();
$passaro->piar();

$papagaio = new Papagaio();
$papagaio->voar();
$papagaio->piar();

custom_print($papagaio->getCaracteristicas());
custom_print($passaro->getCaracteristicas());
var_dump( $passaro instanceof Passaro );
var_dump( $papagaio instanceof Passaro );