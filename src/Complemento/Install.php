<?php

namespace Morrice\Remessa\Complemento;

/**
 * Description of Endereco
 *
 * @author Morrice <mauriciowanderleymartins@gmail.com>
 */
class Install {

    public static function install_config(){
        
        $source  = __DIR__ . "/vendor/morrice/arquivo-remessa/src/config/remetente.php" ;
        
        $dest  = __DIR__ . "/config/remetente.php" ;
        
        copy($source, $dest);
        
    }
    
    public static function update_config(){
        
        $source  = __DIR__ . "/vendor/morrice/arquivo-remessa/src/config/remetente.php" ;
        
        $dest  = __DIR__ . "/config/remetente.php" ;
        
        if(!file_exists($dest)){
            copy($source, $dest);
        }
        
    }
    
}
