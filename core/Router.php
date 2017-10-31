<?php

namespace Core;

class Router 
{
    /**
     * Array associativo de rotas (Tabela de rotas).
     * @var array
     */
    protected $routes = [];

    /**
     * Array de parametros da rota.
     * @var array
     */
    protected $params = [];

    /**
     * Adiciona uma rota a tabela de rotas.
     * 
     * @param string $route O url da rota
     * @param array $params Parametros (controller, action, etc)
     * 
     * @return void
     */
    public function add($route, $params = [])
    {
        // Converte a rota para uma expressão regular: escapa as barras
        $route = preg_replace('/\//', '\\/', $route);

        // Converte as variáveis, ex: {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // Converte variáveis com expressões regulares personalizadas, ex: {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Adiciona delimitadores inciais e finais, e flag case insensitive
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    /**
     * Pega todas as rotas da tabela de rotas.
     * 
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Combina a rota as demais rotas na tabela de rotas,
     * setando a propriedade $params se a rota for encontrada.
     * 
     * @param string $url O url da rota
     * 
     * @return boolean true se for encontrado, false caso contrário
     */
    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                //Pega os valores do grupo capturado
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * Pega os parametros atuais encontrados
     * 
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Despacha a rota, criando o controller e acionando o
     * método
     * 
     * @param string $url O url da rota
     * 
     * @return void
     */
    public function dispatch($url)
    {
        $url = $this->removeQueryStringVariables($url);

        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
            $controller = $this->getNamespace() . $controller;
            
            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if (preg_match('/action$/i', $action) == 0) {
                    $controller_object->$action();
                }
                else {
                    throw new Exception("Metódo $action no controller $controller não pode ser acionado " .
                        "diretamente - remova o sufixo da ação para chama este método");
                }
            }
            else {
                throw new Exception("Controller $controller não encontrado");
            }
        }
        else {
            throw new Exception('Rota não encontrada', 404);
        }
    }

    /**
     * Converte a string com hífens para StudlyCaps
     * ex: post-authors => PostAuthors
     * 
     * @param string $string A string para conversão
     * 
     * @return string
     */
    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * Converte a string com hífens para camelCase,
     * ex: add-new => addNew
     * 
     * @param string $string A string para conversão
     * 
     * @return string
     */
    protected function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    /**
     * Remove as variáveis query string da url (se existirem).
     * 
     * @param string $url The full URL
     * 
     * @return string A url com as variáveis query removidas
     */
    protected function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            }
            else {
                $url = '';
            }
        }
        return $url;
    }

    /**
     * Retorna o namespace da classe controller. O namespace definido
     * nos parametros da rota é adicionado se presente.
     * 
     * @return string A url de requisição
     */
    protected function getNamespace()
    {
        $namespace = 'Agenda\Controllers\\';

        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }
        return $namespace;
    }
}