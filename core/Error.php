<?php

namespace Core;

class Error
{
    /**
     * @param int $level Nivel do Erro
     * @param string $message Mensagem do Erro
     * @param string $file Nome do arquivo onde está o erro
     * @param int $line Linha do arquivo onde está o erro
     * 
     * @return void
     */
    public static function errorHandler($level, $message, $file, $line)
    {
        if (error_reporting() !== 0) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * @param Exception $exception A exception
     * 
     * @return void
     */
    public static function exceptionHandler($exception)
    {
        
        $code = $exception->getCode();
        
        //Verificando se o erro é 404 (não encontrado) ou 500 (Erro geral)
        if ($code != 404) {
            $code = 500;
        }

        http_response_code($code);

        if (\Agenda\Config::SHOW_ERRORS) {
            echo "<h1>Fatal error</h1>";
            echo "<p> Uncaunght exception:". get_class($exception) ."</p>";
            echo "<p>Message: '" . $exception->getMessage() . "'</p>";
            echo "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
        }
        else {
            $log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);
            
            $message = "Uncaught exception: '" . get_class($exception) . "'";
            $message .= " with message '" . $exception->getMessage() . "'";
            $message .= "\nStack trace: " . $exception->getTraceAsString();
            $message .= "\nThrown in '" . $exception->getFile() . "' on line " . $exception->getLine();
            
            error_log($message);
            View::renderTemplate("$code.html");
        }
    }
}