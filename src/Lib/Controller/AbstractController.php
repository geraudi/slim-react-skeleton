<?php

namespace Lib\Controller;

use Slim\Views\PhpRenderer;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractController implements ControllerInterface
{
    /**
     * Injected
     * @var PhpRenderer
     */
    protected $viewRenderer;

    /**
     * Injected
     * @var LoggerInterface
     */
    protected $logger;


    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var ServerRequestInterface
     */
    protected $request;


    protected $layout = 'layout.phtml';

    protected $layoutPath;

    private $renderLayout = true;



    public function __construct(
        PhpRenderer $viewRenderer,
        LoggerInterface $logger,
        $layoutPath = 'src/layout/'
    )
    {
        $this->viewRenderer = $viewRenderer;
        $this->logger = $logger;
        $this->layoutPath = $layoutPath;
        $this->init();
    }

    protected function init() {}


    protected function setLayout($layout)
    {
        $this->layout = $layout;
    }



    /**
     * Callable class.
     * Entry point. Call execute method from parent Controller
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args route arguments.
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $this->request = $request;
        $this->response = $response;
        $this->execute($args);
    }


    /**
     * Render Layout with embedded action response.
     *
     * @param string $viewTemplate
     * @return ResponseInterface
     */
    public function render($viewTemplate = '')
    {
        if (empty($viewTemplate)) {
            $viewTemplate = $this->_getTemplateViewPath();
        }
        if ($this->renderLayout && $this->layout) {
            // Render View
            $actionContent = $this->viewRenderer->fetch($viewTemplate);
            $viewAttributes = $this->viewRenderer->getAttributes();
            $viewAttributes['content'] = $actionContent;
            $this->viewRenderer->setAttributes($viewAttributes);
            // Render layout
            return $this->viewRenderer->render($this->response, $this->getLayoutFile());
        } else {
            return $this->viewRenderer->render($this->response, $viewTemplate);
        }
    }

    protected function getLayoutFile()
    {
        return $this->layoutPath . $this->layout;
    }

    protected function disableLayout()
    {
        $this->renderLayout = false;
    }

    protected function enableLayout()
    {
        $this->renderLayout = true;
    }

    private function _getTemplateViewPath()
    {
        $classInfo = new \ReflectionClass($this);
        $classPath = dirname($classInfo->getFileName());
        $explodePath = explode('/', $classPath);
        return $classPath . '/../../view/' . strtolower($explodePath[count($explodePath) - 1] . '/' . $classInfo->getShortName()) . '.phtml';
    }

}
