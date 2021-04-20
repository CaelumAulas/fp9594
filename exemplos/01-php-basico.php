<?php 

    // Comentário de uma linha com barra dupla
    # Comentário de uma linha
    /* Comentário de bloco (Multi-linha) */

    print "Olá, Mundo! <br>";
    echo "Testando outro olá mundo!";

    /**
     * Variáveis no PHP precisam: 
     * 1) Começar com $
     * 2) Conter letras e/ou números (sem que os números sejam o primeiro caractere)
     * 3) Conter o caracter _ (underscore)
     */

     $preco = 17.50;
     $nome_completo = "Paulo Oliveira";
     $email1 = "paulo.oliveira@gmail.com";
     $is_aposentado = false;
     $idade = 30;

     /**
      * Constantes
      */
      define('URL_SITE', 'http://www.meusite.com.br'); // Definida em tempo de execução
      const ANO_SITE = 2021; // Definida em tempo de compilação

      print "<br>A URL do meu site é: " . URL_SITE;
      print "<br>Meu site foi publicado em: " . ANO_SITE;

      // Template String | String Literals
      print "
        <hr>
        <b>Nome completo:</b> $nome_completo <br>
        <b>E-mail:</b> $email1 <br>
        <b>Idade:</b> $idade anos <br>
        <b>Meu site:</b> " . URL_SITE . "
      ";

     // printf() e sprintf()
     $nome_produto = "Geladeira Brastemp";
     $preco_produto = 12582.96859;
     $desconto = 15.56;
     $codigo = 5263;
     $caracteristicas = array("Economiza energia", "5 anos de garantia", "110v");

    print "<hr>";

    printf("O produto %s, código %d, está com desconto de %d%% e agora custa R$ %.2f", $nome_produto, $codigo, $desconto, $preco_produto);
    $texto_formatado = sprintf("O produto %s, código %d, está com desconto de %d%% e agora custa R$ %.2f", $nome_produto, $codigo, $desconto, $preco_produto);

    echo "<br>O resultado da formatação foi: $texto_formatado";

    echo '<hr>';

    // Depuração básica de variáveis
    var_dump($caracteristicas);
    echo '<br>';
    var_export($caracteristicas);
    echo '<br>';
    
    echo '<pre>';
    print_r($caracteristicas);
    echo '</pre>';