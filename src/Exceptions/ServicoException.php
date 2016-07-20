<?php

namespace Morrice\Remessa\Exceptions;

/**
 * Description of OperacaoException
 *
 * @author Morrice <mauriciowanderleymartins@gmail.com>
 */
class ServicoException extends \Exception {

    public function __construct() {

        $this->message = "SERVIÇO INEXISTENTE";
        
    }
    
}
