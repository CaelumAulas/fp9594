<?php

include "08-namespaces.php";

$p = new Grupo1\Pessoa();
$p->email = 'email1@teste.com.br';
$p->id = 30;
$p->idade = 35;

$p2 = new Grupo2\Pessoa();
$p2->nome = "Amanda";
$p2->email = "amanda@teste.com.br";