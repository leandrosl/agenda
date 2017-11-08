<?php

namespace Core;

class View
{
    /**
     * Renderizar um arquivo de view
     * 
     * @param string $view O arquivo a ser renderizado
     * @param array $args Array associativo de dados para serem exibidos na view (Opcional)
     * 
     * @return void
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = dirname(__DIR__) . "/app/Views/$view";

        if (is_readable($file)) {
            require $file;
        }
        else {
            throw new \Exception("$file não encontrado");
        }
    }

    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/app/Views');
            $twig = new \Twig_Environment($loader);
        }

        echo $twig->render($template, $args);
    }
}