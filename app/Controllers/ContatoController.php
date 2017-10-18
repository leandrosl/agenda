<?php

namespace Agenda\Controllers;

use Agenda\Models\Contato;

class ContatoController
{
    public function __construct()
    {

    }

    public function getContatos()
    {
        $contatos = array();
        array_push($contatos, new Contato("Leandro", "Souza", "Av. Paulista", 
            "1256", "São Paulo", "(11) xxxx-xxxx"));
        
        return $contatos;
    }
}