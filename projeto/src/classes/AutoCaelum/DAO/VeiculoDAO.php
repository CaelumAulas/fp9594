<?php 

namespace AutoCaelum\DAO;
use AutoCaelum\Models\Veiculo;
use Exception;

class VeiculoDAO extends AbstractDAO
{
    protected $dto = null;

    public function __construct(?Veiculo $veiculo = null)
    {
        parent::__construct();
        $this->table_name = "veiculos";
        $this->dto = $veiculo;
    }

    public function setDataObj($dto)
    {
        if (! ($dto instanceof Veiculo) ) throw new Exception('Objeto precisa ser uma instância da classe Veículo!');
        $this->dto = $dto;
    }

    public function existe(): bool
    {
        return false;
    }

    public function cadastrar(): void
    {
        $this->validateDataObject();
        
        $cols = array('modelo', 'marca_id', 'preco', 'descricao', 'foto');
        $vals = array( 
            $this->dto->getModelo(), 
            $this->dto->getMarca()->getId(), 
            $this->dto->getPreco(),
            $this->dto->getDescricao(),
            $this->dto->getFoto()
        );

        $resultado = $this->db->insert( $this->table_name, $cols, $vals);
        if (!$resultado) {
            throw new Exception('Não foi possível realizar o cadastro do veículo informado!');
        }
    }

    public function atualizar(): void
    {
        $this->validateDataObject();

        $cols_vals = array(
            'modelo' => $this->dto->getModelo(),
            'marca_id' => $this->dto->getMarca()->getId(),
            'preco' => $this->dto->getPreco(),
            'descricao' => $this->dto->getDescricao()
        );

        if ($this->dto->getFoto()) 
        {
            $cols_vals['foto'] = $this->dto->getFoto();
        }

        $where = array('id' => $this->dto->getId());

        $resultado = $this->db->update( $this->table_name, $cols_vals, $where );
        if (!$resultado) {
            throw new Exception('Não foi possível realizar a atualização do veículo informado!');
        }
    }

    public function excluir(int $id): void
    {
        $veiculo_info = $this->getPorId($id);
        if (!$veiculo_info) {
            throw new Exception('Veículo não existe na base de dados!');
        }

        $resultado = $this->db->delete( $this->table_name, array('id' => $id) );
        if (!$resultado) {
            throw new Exception('Não foi possível realizar a exclusão do veículo informado!');
        }
    }

    public function getPorId(int $id)
    {
        if ($id <= 0) throw new Exception('ID inválido!');
        $reg = $this->db->select( $this->table_name, where: array('id' => $id), single: true );

        if ($reg)
        {
            $veiculo = new Veiculo();
            $veiculo->setModelo($reg['modelo']);
            $veiculo->setPreco((float) $reg['preco']);
            $veiculo->setDescricao($reg['descricao']);
            $veiculo->setFoto($reg['foto']);
            $veiculo->setId((int) $reg['id']);

            if ($reg['marca_id']) {
                $veiculo->getMarca()->setId((int) $reg['marca_id']);
            }

            return $veiculo;
        }

        return null;
    }

    /**
     * @return Veiculo[]
     */
    public function listar(): ?array
    {
        $lista = array();

        $sql = "SELECT v.*, m.marca FROM $this->table_name AS v LEFT JOIN marcas AS m ON v.marca_id = m.id ORDER BY v.id DESC";
        $values = array();

        if ($this->dto?->getMarca()->getId()) 
        {
            $sql = "SELECT v.*, m.marca FROM veiculos AS v LEFT JOIN marcas AS m ON v.marca_id = m.id WHERE v.marca_id = ? ORDER BY v.id DESC";
            $values = array( $this->dto->getMarca()->getId() );
        }

        $registros = $this->db->query( $sql, $values );

        foreach ($registros as $reg) 
        {
            $veiculo = new Veiculo();
            $veiculo->setModelo($reg['modelo']);
            $veiculo->setPreco((float) $reg['preco']);
            $veiculo->setDescricao($reg['descricao']);
            $veiculo->setFoto($reg['foto']);
            $veiculo->setId((int) $reg['id']);

            if ($reg['marca_id']) {
                $veiculo->getMarca()->setId((int) $reg['marca_id']);
                $veiculo->getMarca()->setNome($reg['marca']);
            }

            array_push($lista, $veiculo);
        }

        return $lista;
    }
}