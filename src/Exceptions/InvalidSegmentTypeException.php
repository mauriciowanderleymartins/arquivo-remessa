<?php

namespace Morrice\Remessa\Exceptions;

/**
 * Description of BatchService
 *
 * @author Morrice256 <mauriciowanderleymartins@gmail.com>
 * @github https://github.com/morrice256/
 */
class InvalidSegmentTypeException extends \Exception {

    public function __construct($segmnet, $type) {

        $this->message = "SEGMNET INVALID: Segment {$segmnet} - Type expected {$type}";
        
    }
    
}
