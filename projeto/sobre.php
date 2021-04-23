<?php

/** Configurações Gerais */
require_once "src/config.php";

$titulo_pagina = "Sobre a Empresa";
$texto_destaque = "Saiba um pouco mais sobre a história da nossa empresa.";
$menu_ativo = 'sobre';
require_once "src/includes/cabecalho.php";

?>
<div class="row mx-0">
    <div class="col-md-3 px-0">
        <img src="img/cars.jpg" class="img-thumbnail" alt="" />
    </div>
    <div class="col-md-9 p-4">
        <h1>Sobre a Empresa</h1>
        <hr>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero possimus in rerum cum odio sapiente maxime saepe, accusamus enim asperiores dolores unde eaque architecto aut eveniet ad maiores. Alias, enim.</p>
        <p>Veritatis, ducimus? Eum voluptate totam quis nam hic quod quo. Aliquam ex quas deleniti a accusantium voluptatem voluptate tenetur consequatur vitae sit quo, esse placeat saepe maxime. Expedita, tenetur obcaecati?</p>
        <p>Nam, error nisi aspernatur commodi fugit, laboriosam alias ullam sequi iusto maiores neque harum impedit consequatur, ipsam placeat eveniet vitae porro recusandae optio voluptate. Tenetur quidem alias aut sit facilis.</p>
        <p>Velit, numquam. Rem perferendis consectetur itaque, excepturi nihil mollitia culpa odit facere id voluptas accusantium temporibus vel cupiditate iure impedit libero tenetur reiciendis deleniti. Odio nihil et iste facere alias!</p>
        <p>Sed eaque explicabo iure voluptatum excepturi obcaecati ullam officia modi necessitatibus iste, dolorum laborum consequuntur blanditiis enim optio sit maxime nemo commodi quisquam placeat! Obcaecati debitis rerum cupiditate numquam natus!</p>
    </div>
</div>
<?php

require_once "src/includes/rodape.php";
