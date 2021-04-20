<?php 

    // while() { ... }
    // while() : ... endwhile;
    $contador = 1;
    while ($contador <= 10) : 
        print "Contador $contador <br>";
        $contador++;
    endwhile;

    print '<hr>';

    // for () { ... }
    // for () : ... endfor;
    for ($i = 10; $i >= 1; $i--) :
        print "$i <br>";
    endfor;

    print '<hr>';

    // foreach() { ... }
    // foreach() : ... endforeach;
    $animais = array('Gato', 'Cachorro', 'Papagaio', 'Porco');
    // foreach ($animais as $animal)
    foreach ($animais as $indice => $animal)
    {
        echo "Posição: $indice, Valor: $animal <br>";
        if ($animal == 'Papagaio') break;
    }

    echo 'Qualquer outra coisa aqui!!!';