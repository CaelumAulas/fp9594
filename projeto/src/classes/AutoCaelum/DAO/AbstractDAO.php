<?php 

namespace AutoCaelum\DAO;
use AutoCaelum\Data\IDatabase;
use AutoCaelum\Data\Db;
use Exception;

abstract class AbstractDAO 
{
    protected ?IDatabase $db = null;
    protected $dto = null; // Data Transfer Object
    protected string $table_name = ''; // nome da tabela que o dao regencia no banco

    public function __construct()
    {
        $this->db = Db::getConnection(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);
    }

    protected final function validateDataObject()
    {
        if (!$this->dto) throw new Exception('Objeto de dados inválido!');
    }

    public abstract function setDataObj($dto);
    public abstract function cadastrar(): void;
    public abstract function atualizar(): void;
    public abstract function excluir(int $id): void;
    public abstract function getPorId(int $id);
    public abstract function listar(): ?array;
    public abstract function existe(): bool;
}
