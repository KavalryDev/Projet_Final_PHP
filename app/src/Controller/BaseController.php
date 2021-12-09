<?php

namespace App\Controller;

abstract class BaseController
{
    protected array $params;
    private string $viewsDir = __DIR__ . './../Views/Frontend/';
    private string $templateFile = __DIR__ . './../Views/template.php';

    /**
     * @param string $action
     * @param array $params
     */
    public function __construct(string $action, array $params = [])
    {
        $this->params = $params;

        $method = 'execute' . ucfirst($action);
        if (is_callable([$this, $method])) {
            $this->$method();
        }
    }

    /**
     * @param string $template
     * @param array $arguments
     * @param string $title
     */
    public function render(string $template, array $arguments, string $title)
    {
        // je suis un commentaire
        $view = $this->viewsDir . $template;

        foreach ($arguments as $key => $value) {
            ${$key} = $value;
        }


        ob_start();
        require $view;
        $content = ob_get_clean();
        require $this->templateFile;
        exit;

    }
}