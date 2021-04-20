<?php 

    // Declaração de Arrays
    $lista_nomes = array('Jhonatan', 'Maria', 'Rodrigo');
    $lista_idades = [29, 32, 12]; // 5.4
    $misto = array('Geladeira', true, 52.89, "Bla bla bla", 12);

    echo "O segundo nome é: " . $lista_nomes[1];

    // array multidimensional
    $usuarios = array(
        array('Jhonatan', 'jhonatan.jacinto@caelum.com.br', 30), # 0
        array('Fernanda', 'fernanda@caelum.com.br', 26), # 1
        array('Marcio', 'marcio@caelum.com.br', 40) # 2
    );

    print '<br>';
    print_r($usuarios[2][2]); // idade do Marcio = 40

    // Array de Chave nomeada
    $produto = array(
        'tamanhos' => array(42, 43, 44),
        'cores' => array('preto', 'branco', 'azul'),
        'foto' => 'tenis-rednose.jpg',
        'preco' => 150.69,
        'status_estoque' => true,
        'qtd_estoque' => 50,
        'descricao' => 'Este tenis é muito bom!',
        'nome_produto' => 'Tênis RedNose'
    );

    print "
        <hr>
        Nome do Produto: {$produto['nome_produto']} <br>
        Em estoque: {$produto['status_estoque']} <br>
        Tamanhos: " . implode(", ", $produto['tamanhos']) . " <br>
        Cores: " . implode(", ", $produto['cores']) . " <br>
        <br>
    ";

    array_push($lista_nomes, 'Mariana');
    $lista_nomes = array_reverse($lista_nomes);

    print_r($lista_nomes);