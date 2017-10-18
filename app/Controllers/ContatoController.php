<?php

namespace Agenda\Controllers;

use Agenda\Models\Contato;
use Agenda\Repositories\ContatoRepository as Repository;

class ContatoController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new Repository();
    }

    public function getContatos()
    {
        return $this->repository->todosContatos();
    }

    public function getContatoPorId($id)
    {
        return $this->repository->buscarContatoPeloId($id);
    }
}