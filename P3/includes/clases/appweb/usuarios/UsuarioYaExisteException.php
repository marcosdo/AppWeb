<?php
namespace appweb\usuarios;

class UsuarioYaExisteException extends \Exception {
    function __construct(string $message = "" , int $code = 0 , \Throwable $previous = null ) {
        parent::__construct($message, $code, $previous);
    }
}