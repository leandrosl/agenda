<?php

namespace Agenda\Repositories;

use Agenda\Models\Conexao;

class ContatoRepository
{
    private $db;

    public function __construct()
    {
        $db = Conexao::getConexao();
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
        //return $this->db->query("select * from contatos");
        return "Foi";
    }

    public function buscarContatoPeloId($id)
    {
        
    }
}