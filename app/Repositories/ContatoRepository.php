<?php

namespace Agenda\Repositories;

use Agenda\Models\Conexao;

class ContatoRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Conexao::getConexao();
    }

    public function novoContato($info)
    {

    }

    public function deletarContato($id)
    {

    }

    public function editarContato($info)
    {

    }

    public function todosContatos()
    {
        try {
            $stmt = $this->db->query('select * from contatos');
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }
        catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function buscarContatoPeloId($id)
    {
        try {
            $stmt = $this->db->prepare('select * from contatos where id = :id');
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_OBJ);
        }
        catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}