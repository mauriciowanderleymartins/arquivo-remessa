<?php

namespace Morrice\Remessa\Exceptions;

/**
 * Description of OperacaoException
 *
 * @author Morrice <mauriciowanderleymartins@gmail.com>
 */
class OperacaoException extends \Exception {

    public function __construct() {

        $this->message = "OPERAÇÃO INEXISTENTE";
        
    }
    
}
