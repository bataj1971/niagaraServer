<?php
namespace Util;
/**
 * Description of FileHandler
 *
 * @author Bata Jozsef 
 */
trait FileHandler
{
    /**
     * 
     * @param string $directoryName
     * @param bool $throwException
     * @return bool
     * @throws Exception
     */
    protected function createOrCheckDirectory(string $directoryName,  bool $throwException = true) : bool
    {
        if (is_dir($directoryName)) {
            return true;
        }
        
        mkdir($directoryName , 0755 , true);
        
        if (is_dir($directoryName)) {
            return true;
        }
        
        if ( $throwException ) {
            throw new \Exception("Directory [$directoryName] does not exists and even can not be created.");
        }
        
        return false;
        
    }
        
}
