<?php
namespace Application;

/**
 * Description of TemplateRenderer
 *
 * @author Bata Jozsef 
 */
class TemplateRenderer
{
    /**
     * 
     * @var type Latte\Engine
     */
    protected $latteInstance;
    
    /**
     * array to gather values for renderingtemplate
     * @var array
     */
    protected $data;
    
    /**
     * full calculated path to template
     * @var string
     */
    protected $templateFilePath;


    /**
     * 
     * @var Config
     */
    protected $config;
    /**
     * 
     * @return \Latte\Engine
     */
    public function __construct(string $templateName) {
        $this->config = \Config\Config::getInstance();
        $this->templateFilePath = TEMPLATEDIR.$templateName.".latte";
        $this->latteInstance = new \Latte\Engine;
        $this->latteInstance->setTempDirectory('cache');
        // $this->latteInstance->setSandboxMode();
        
        
        if (!file_exists($this->templateFilePath )) {        
                throw new \Exception("{$templateName} template can not be found");
        }        
    }
    
    public function render(array $data = []) {
        $this->data = $data;
        
        // add baseurl - mostly needed
        $this->data['baseurl'] = $this->config->getValue('baseurl');
        
        
        return $this->latteInstance->renderToString($this->templateFilePath, $this->data);        
    }
    
}
