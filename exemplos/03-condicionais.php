<?php 

    $idade = 10;

    // IF...ELSE | Sintaxe #1 usando chaves 
    if ($idade >= 12 && $idade <= 17) {
        print 'Seu plano é o TEEN!!!';
    }
    else if ($idade >= 18 && $idade <= 29) {
        print 'Seu plano é o PROFESSIONAL!!!';
    }
    else {
        print 'Não há planos para você!!!';
    }

    print '<br>';

    // IF...ELSE | Sintaxe #2 com dois pontos
    if ($idade >= 12 && $idade <= 17) : 
        print "Seu plano é o TEEN!";
    elseif ($idade >= 18 && $idade <= 29) : 
        print "Seu plano é o PROFESSIONAL";
    else : 
        print "Não há planos para você!";
    endif;

    print '<br>';

    // Operador Ternário
    $email_enviado = false; 
    $mensagem = ($email_enviado == true) ? "E-mail enviado com sucesso!" : "Não foi possível enviar o e-mail!";
    print $mensagem;

    print '<hr>';

    // Até o PHP 5.6
    // $nome = (isset($_GET['nome'])) ? $_GET['nome'] : 'Não definido!';
    // $idade = (isset($_GET['idade'])) ? $_GET['idade'] : 'Não definida!';

    // PHP 7+ | Null Coalescing Operator
    $nome = $_GET['nome'] ?? 'Não definido!';
    $idade = $_GET['idade'] ?? 'Não definido!';

    print "Seu nome é: " . $nome . '<br>';
    print "Sua idade é: " . $idade;

    print '<hr>';

    // switch() : ... endswitch;
    switch($idade)
    {
        case 28:
        case 29: 
            print 'Você tem 28 ou 29 anos';
        break;
        case 35: 
            print 'Você tem 35 anos';
        break;
        default: 
            print 'Não sei qual a sua idade';
        break;
    }
