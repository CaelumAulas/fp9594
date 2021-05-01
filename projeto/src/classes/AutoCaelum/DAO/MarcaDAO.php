<?php 

namespace AutoCaelum\DAO;
use AutoCaelum\Models\Marca;
use Exception;

class MarcaDAO extends AbstractDAO
{
    protected $dto = null;

    public function __construct(?Marca $marca = null)
    {
        parent::__construct(); // chama o construtor da classe-mãe
        $this->table_name = "marcas";
        $this->dto = $marca;
    }

    public function setDataObj($dto)
    {
        if ( !($dto instanceof Marca) ) {
            throw new Exception('Objeto precisa ser uma instância da classe Marca!');
        }

        $this->dto = $dto;
    }

    public function existe(): bool
    {
        $this->validateDataObject();
        $values = array(
            $this->dto->getNome(),
            $this->dto->getId()
        );

        return (bool) $this->db->query( "SELECT * FROM $this->table_name WHERE marca = ? AND id != ?", $values, true );
    }

    public function cadastrar(): void
    {
        if ($this->existe()) throw new Exception('Marca informada já existe!');

        $resultado = $this->db->insert( $this->table_name, array('marca'), array( $this->dto->getNome() ) );

        if (!$resultado) {
            throw new Exception('Não foi possível realizar o cadastro da marca informada!');
        }
    }

    public function atualizar(): void
    {
        if ($this->existe()) throw new Exception('Marca informada já existe!');

        $cols_vals = array( 'marca' => $this->dto->getNome() );
        $where = array( 'id' => $this->dto->getId() );

        $resultado = $this->db->update( $this->table_name, $cols_vals, $where );

        if (!$resultado) {
            throw new Exception('Não foi possível realizar a atualização da marca informada!');
        }
    }

    public function excluir(int $id): void
    {
        $marca_info = $this->getPorId($id);
        if (!$marca_info) {
            throw new Exception('Marca não existe na base de dados!');
        }

        $resultado = $this->db->delete( $this->table_name, array('id' => $id) );
        if (!$resultado) {
            throw new Exception('Não foi possível realizar a exclusão da marca informada!');
        }
    }

    public function getPorId(int $id)
    {
        if ($id <= 0) throw new Exception('ID inválido!');

        $reg = $this->db->select( $this->table_name, where: array('id' => $id), single: true ); // PHP 8: named parameteres / named arguments

        if ($reg)
        {
            $marca = new Marca( $reg['marca'], (int) $reg['id'] );
            return $marca;
        }

        return null;
    }

    /**
     * @return Marca[]
     */
    public function listar(): ?array
    {
        $lista = array();

        $registros = $this->db->select( $this->table_name );

        foreach ($registros as $reg)
        {
            $marca = new Marca( $reg['marca'], (int) $reg['id'] );
            array_push( $lista, $marca );
        }

        return $lista;
    }

}