<?php

namespace Agenda\Repositories;

use Agenda\Models\Conexao;
use Agenda\Models\Contato;

class ContatoRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Conexao::getConexao();
    }

    public function novoContato(Contato $contato)
    {
        if ($contato != null) {
            try {
                $insert = $this->db->prepare('insert into contatos (nome, sobrenome, endereco, num_endereco, cidade, telefone) ' . 
                    'values (:nome, :sobrenome, :endereco, :num_endereco, :cidade, :telefone)');
                $insert->bindParam(':nome', $contato->nome);
                $insert->bindParam(':sobrenome', $contato->sobrenome);
                $insert->bindParam(':endereco', $contato->endereco);
                $insert->bindParam(':num_endereco', $contato->num_endereco);
                $insert->bindParam(':cidade', $contato->cidade);
                $insert->bindParam(':telefone', $contato->telefone);
                return $insert->execute();
            }
            catch (\PDOException $e) {
                echo "PDO Error = {$e->getMessage()}";
            }
        }
        else {
            throw new Exception('Usuário vazio');
        }
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