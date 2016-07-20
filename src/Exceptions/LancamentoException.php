<?php

namespace Morrice\Remessa\Exceptions;

/**
 * Description of OperacaoException
 *
 * @author Morrice <mauriciowanderleymartins@gmail.com>
 */
class LancamentoException extends \Exception {

    public function __construct() {

        $this->message = "LANÇAMENTO NÃO IMPLEMENTADO";
        
    }
    
}
