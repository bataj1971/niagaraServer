<?php

namespace Controllers;

use Application\PageController;
use DataModel\ModelFactory;

/**
 * Description of TestController
 *
 * @author Bata Jozsef 
 */
class TestController extends PageController
{


    /**
     * 
     * @param array $paramList
     */
    public function render(array $paramList)
    {
        echo $this->renderPage('welcomePage');
    }
}
