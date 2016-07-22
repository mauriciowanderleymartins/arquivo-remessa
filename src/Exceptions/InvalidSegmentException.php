<?php

namespace Morrice\Remessa\Exceptions;

/**
 * Description of BatchService
 *
 * @author Morrice256 <mauriciowanderleymartins@gmail.com>
 * @github https://github.com/morrice256/
 */
class InvalidSegmentException extends \Exception {

    public function __construct() {

        $this->message = "SEGMENT TYPE INVALID";
        
    }
    
}
