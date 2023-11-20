<?php

/**
 * Description of ApiException
 *
 * @author Bata Jozsef 
 */
class ApiException extends \Exception
{
    
    /**
     * messages
     *
     * @var array
     */
    private $messages  = [];
    
    /**
     * __construct
     *
     * @param  mixed $message
     * @return void
     */
    public function __construct($message,
            $messages = [],
            $code = 0,
            \Exception $previous = null
    )
    {
        parent::__construct($message, $code, $previous);

        $this->messages = $messages;
    }
    
    /**
     * getMessageList
     *
     * @return void
     */
    public function getMessageList()
    {
        return $this->messages;
    }
    
    /**
     * addMessagesToList
     *
     * @param  array $arrayItems
     * @return void
     */
    public function addMessagesToList(array $arrayItems)
    {
        array_replace_recursive($this->messages, $arrayItems);
    }

}
