<?php

namespace Agenda\Models;

class Contato
{
    public $nome;
    public $sobrenome;
    public $endereco;
    public $num_endereco;
    public $cidade;
    public $telefone;

    public function __construct($_nome, $_sobrenome, $_endereco, 
        $_num_endereco, $_cidade, $_telefone)
    {
        $this->nome = $_nome;
        $this->sobrenome = $_sobrenome;
        $this->endereco = $_endereco;
        $this->num_endereco = $_num_endereco;
        $this->cidade = $_cidade;
        $this->telefone = $_telefone;
    }
}