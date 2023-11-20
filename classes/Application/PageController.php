<?php

namespace Application;

use Config\config;

/**
 * All controllers producing a html page should be extended from this class
 *
 * @author Bata Jozsef 
 */
abstract class PageController extends BaseController
{

    /**
     * 
     * @var type
     */
    protected $renderer;
    
    protected $data = [];

    /**
     * 
     * @param array $profileData
     */
    public function renderPage(string $templateName) {
        $this->renderer = new TemplateRenderer($templateName);
        return $this->renderer->render($this->data);
    }

    public function renderErrorPage(int $errorCode, string $errorMessage) {

        $data = [
            'message' => $errorMessage,
            'errorcode' => $errorCode
        ];
        $this->renderer = new \Application\TemplateRenderer('error');

        $output = $this->renderer->render($data);
        echo $output;
    }
    
    protected function assign(string $paramName,$value) {
        $this->data[$paramName] = $value;
    }

}
