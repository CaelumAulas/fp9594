<?php 

require '../projeto/src/lib/utils.php';

/**
 * Modificadores de Acesso
 * public = acesso público, isto é acessível pela instância da classe (objeto)
 * private = acesso privado, isto é acessível somente de forma interna pela instância da classe
 * protected = acesso protegido, isto é acessível somente de forma interna pela instância da classe e pelas instâncias de suas classes-filha
 */
class Usuario
{
    private int $id = 0;
    private string $email = '';

    /**
     * Construtor da Classe
     */
    public function __construct(string $email = '', int $id = 0)
    {
        if ($email) $this->setEmail($email);
        if ($id) $this->setId($id);
    }

    /**
     * Destrutor de Classe
     */
    public function __destruct()
    {
        
    }

    public function getId() {
        return $this->id;
    }

    public function setId(int $id) {
        if ($id <= 0) {
            throw new Exception('ID inválido!');
        }

        $this->id = $id;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail(string $email) {
        $this->email = filter_var($email, FILTER_VALIDATE_EMAIL) ?: throw new Exception('E-mail inválido!');
        return $this;
    }
}

$u1 = new Usuario();
$u1->setId(63)->setEmail('jhonatan@caelum.com.br'); // Method Chaining = Encadeamento de Métodos

$u2 = new Usuario('teste@teste.com.br', 30);

custom_print($u1->getEmail());
custom_print($u2->getEmail());