<?php

namespace Agenda\Controllers;

use Core\Controller;
use Core\View;

use Agenda\Models\Contato;
use Agenda\Repositories\ContatoRepository as Repository;

class ContatoController extends Controller
{
    private $repository;

    public function __construct()
    {
        //$this->repository = new Repository();
    }

    public function index()
    {
        echo "test";
    }

    public function getContatos()
    {
        return $this->repository->todosContatos();
    }

    public function getContatoPorId($id)
    {
        return $this->repository->buscarContatoPeloId($id);
    }

    public function novoContato($req)
    {
        if ($req) {
            $contato = new Contato($req['nome'], $req['sobrenome'], $req['endereco'], 
                $req['num_endereco'], $req['cidade'], $req['telefone']);
            if ($this->repository->novoContato($contato)) {
                header('Location: index.php');
            }
            else {
                header('Location: novo_contato.php?error=bd_fail');
            }
        }
        else {
            header('Location: novo_contato.php?error=req_empty');
        }
    }
}