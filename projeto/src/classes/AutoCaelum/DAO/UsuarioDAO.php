<?php 

namespace AutoCaelum\DAO;
use AutoCaelum\Models\Usuario;
use Exception;

class UsuarioDAO extends AbstractDAO
{
    protected $dto = null;

    public function __construct(?Usuario $usuario = null)
    {
        parent::__construct();
        $this->table_name = "usuarios";
        $this->dto = $usuario;
    }

    public function setDataObj($dto)
    {
        if (! ($dto instanceof Usuario) ) throw new Exception('Objeto precisa ser uma instância da classe Usuario!');
        $this->dto = $dto;
    }

    public function existe(): bool
    {
        $this->validateDataObject();
        return (bool) $this->db->query( "SELECT * FROM $this->table_name WHERE login = ? AND id != ?", array($this->dto->getLogin(), $this->dto->getId()) );
    }

    public function cadastrar(): void
    {
        if ($this->existe()) throw new Exception('Usuário informado já existe!');

        $hash = password_hash($this->dto->getSenha(), PASSWORD_BCRYPT);
        $cols = array('login', 'senha', 'ativo');
        $vals = array( $this->dto->getLogin(), $hash, $this->dto->getAtivo() );

        $resultado = $this->db->insert( $this->table_name, $cols, $vals);
        if (!$resultado) {
            throw new Exception('Não foi possível realizar o cadastro do usuário informado!');
        }
    }

    public function atualizar(): void
    {
        if ($this->existe()) throw new Exception('Usuário informado já existe!');
        
        $cols_vals = array(
            'login' => $this->dto->getLogin(),
            'ativo' => $this->dto->getAtivo()
        );

        if ($this->dto->getSenha()) 
        {
            $cols_vals['senha'] = password_hash($this->dto->getSenha(), PASSWORD_BCRYPT);
        }

        $where = array('id' => $this->dto->getId());

        $resultado = $this->db->update( $this->table_name, $cols_vals, $where );
        if (!$resultado) {
            throw new Exception('Não foi possível realizar a atualização do usuário informado!');
        }
    }

    public function excluir(int $id): void
    {
        $user_info = $this->getPorId($id);
        if (!$user_info) {
            throw new Exception('Usuário não existe na base de dados!');
        }

        $resultado = $this->db->delete( $this->table_name, array('id' => $id) );
        if (!$resultado) {
            throw new Exception('Não foi possível realizar a exclusão do usuário informado!');
        }
    }

    public function getPorId(int $id)
    {
        if ($id <= 0) throw new Exception('ID inválido!');
        $reg = $this->db->select( $this->table_name, where: array('id' => $id), single: true );

        if ($reg)
        {
            $user = new Usuario( $reg['login'], ativo: (bool) $reg['ativo'], id: (int) $reg['id'] );
            return $user;
        }

        return null;
    }

    /**
     * @return Usuario[]
     */
    public function listar(): ?array
    {
        $lista = array();

        $registros = $this->db->select( $this->table_name );

        foreach ($registros as $reg) 
        {
            $user = new Usuario( $reg['login'], ativo: (bool) $reg['ativo'], id: (int) $reg['id'] );
            array_push($lista, $user);
        }

        return $lista;
    }

    public function getUsuario() : ?Usuario
    {
        if (!$this->existe()) throw new Exception('Usuário informado não existe!');
        $reg = $this->db->select( $this->table_name, where: ['login' => $this->dto->getLogin()], single: true );

        if ($reg) 
        {
            $user = new Usuario( $reg['login'], $reg['senha'], (bool) $reg['ativo'], (int) $reg['id'] );
            return $user;
        }

        return null;
    }
}