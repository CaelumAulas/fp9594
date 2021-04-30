<?php 

interface IVoavel {
    public function voar():void;
}

class Pessoa { }

class Dragao implements IVoavel {
    public function voar() : void {
        print "Voando igual um dragão <br>";
    }
}

class Borboleta implements IVoavel {
    public function voar() : void {
        print "Voando igual uma borboleta <br>";
    }
}

class Aviao implements IVoavel {
    public function voar() : void {
        print "Voando igual um avião <br>";
    }
}

$p1 = new Pessoa();
$p2 = new Dragao();
$p3 = new Borboleta();
$p4 = new Aviao();

function fazerPersonagemVoar(IVoavel $personagem)
{
    $personagem->voar();
}

// fazerPersonagemVoar("asdkjhfaksjdf"); // String não implementa IVoavel
// fazerPersonagemVoar($p1); // Pessoa não implementa IVoavel
fazerPersonagemVoar($p2);
fazerPersonagemVoar($p3);
fazerPersonagemVoar($p4);