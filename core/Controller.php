<?php

namespace Core;

abstract class Controller
{
    /**
     * Parametros da rota
     * @var array
     */
    protected $route_params = [];

    /**
     * Construtor
     * 
     * @param array $route_params Parametros da rota
     * 
     * @return void
     */
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    /**
     * Método mágico que é chamado em caso um método não existente
     * ou inacessível for chamado nessa classe
     * 
     * @param string $name Nome do Método
     * @param array $args Argumentos passados para o método
     * 
     * @return void
     */
    public function __call($name, $args)
    {
        $method = $name;

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        }
        else {
            throw new \Exception("Método $method não encontrado no controller " . get_class($this));
        }
    }

    /**
     * Before filtro - chamado antes de um método de ação
     * 
     * @return void
     */
    protected function before()
    {

    }

    /**
     * After filtro - chamado depois de um método de ação
     * 
     * @return void
     */
    protected function after()
    {

    }
}