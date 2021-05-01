<?php

/** Configurações Gerais */
require_once "src/config.php";
use PHPMailer\PHPMailer\PHPMailer;

try 
{
    if ($_POST)
    {
        $nome = filter_input(INPUT_POST, 'nome_completo', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) ?: throw new Exception('Nome é obrigatório!');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?: throw new Exception('E-mail é obrigatório!');
        $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) ?: throw new Exception('Assunto é obrigatório!');
        $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) ?: throw new Exception('Mensagem é obrigatório!');
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "mail.jhonatanjacinto.dev";
        $mail->SMTPAuth = true;
        $mail->Username = "cursophp@jhonatanjacinto.dev";
        $mail->Password = "Xcfe$#@34";
        $mail->SMTPSecure = '';
        $mail->SMTPAutoTLS = false;
        $mail->Port = 587;
        $mail->setFrom("no-reply@autocaelum.com.br", 'AutoCaelum');
        $mail->addAddress('jhonatanjacinto@gmail.com');
        $mail->Subject = $assunto;
        $mail->Body = "
            Nova mensagem enviada por um cliente da AutoCaelum:
            Nome: $nome
            E-mail: $email
            Mensagem: 
            $mensagem
        ";

        if (!$mail->send()) {
            throw new Exception($mail->ErrorInfo);
        }

        set_app_mensagem('E-mail enviado com sucesso!');
    }
}
catch(Exception $exc)
{
    set_app_mensagem($exc->getMessage(), 'erro');
}

$titulo_pagina = "Entre em Contato";
$texto_destaque = "Use o formulário abaixo para entrar em contato conosco.";
$menu_ativo = 'contato';
require_once "src/includes/cabecalho.php";

?>
<h1>Contato</h1>
<hr>

<?php show_app_mensagem(); ?>

<form method="POST" action="" class="row mx-0">
    <div class="form-group col-md-6">
        <label>Nome completo:</label>
        <input type="text" name="nome_completo" class="form-control" />
    </div>
    <div class="form-group col-md-6">
        <label>E-mail:</label>
        <input type="email" name="email" class="form-control" />
    </div>
    <div class="form-group col-md-12">
        <label>Assunto:</label>
        <input type="text" name="assunto" class="form-control" />
    </div>
    <div class="form-group col-md-12">
        <label>Mensagem:</label>
        <textarea class="form-control" name="mensagem" rows="5"></textarea>
    </div>
    <div class="form-group col-md-12">
        <button class="btn btn-primary">
            Enviar
        </button>
    </div>
</form>
<?php

require_once "src/includes/rodape.php";
