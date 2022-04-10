<?php
namespace appweb;

class UsuarioYaExisteException extends \Exception {
    function __construct(string $message = "" , int $code = 0 , \Throwable $previous = null ) {
        parent::__construct($message, $code, $previous);
    }
}