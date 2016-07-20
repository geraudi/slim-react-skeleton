<?php
/**
 *
 * @author Géraud ISSERTES <gissertes@galilee.fr>
 * @copyright © 2015 Galilée (www.galilee.fr)
 */

namespace Lib\View;

use Slim\Views\PhpRenderer;

class Renderer extends PhpRenderer
{

    /**
     * @var \Slim\Router
     */
    private $_router;

    /** @var  string */
    private $_headTitle;

    /**
     * Strict variables flag; when on, undefined variables accessed in the view
     * scripts will trigger notices
     * @var boolean
     */
    private $_strictVars = false;


    protected $bodyScriptUrls= [];
    protected $headScriptUrls= [];
    protected $headStyleSheetFiles = [];

    /**
     * Renderer constructor.
     * @param \Slim\Router $router
     * @param string $templatePath
     * @param array $attributes
     */
    public function __construct(\Slim\Router $router, $templatePath = "", $attributes = [])
    {
        $this->_router = $router;
        parent::__construct($templatePath, $attributes);
    }




    /**
     * Prevent E_NOTICE for nonexistent values
     *
     * If {@link strictVars()} is on, raises a notice.
     *
     * @param  string $key
     * @return null
     */
    public function __get($key)
    {
        $result = null;
        if ($this->getAttribute($key)) {
            $result = $this->getAttribute($key);
        } else {

            if ($this->_strictVars) {
                trigger_error('Key "' . $key . '" does not exist', E_USER_NOTICE);
            }

        }
        return $result;
    }

    public function __set($key, $val)
    {
        $this->$key = $val;
    }

    /**
     * Allows testing with empty() and isset() to work inside
     * templates.
     *
     * @param  string $key
     * @return boolean
     */
    public function __isset($key)
    {
        return isset($this->$key);
    }


    /**
     * @param string $headTitle
     */
    public function setHeadTitle($headTitle)
    {
        $this->_headTitle = $headTitle;
    }

    /**
     * @param $jsFile
     * @param string $type
     */
    public function appendBodyScript($jsFile, $type = 'text/javascript') {
        $this->bodyScriptUrls[] = sprintf(
            '<script src="%s" type=""%s"></script>',
            $jsFile,
            $type
        );
    }

    /**
     * @param $cssFile
     * @param string $media
     */
    public function appendStyleSheet($cssFile, $media = 'screen')
    {
        $this->headStyleSheetFiles[] = sprintf(
            '<link href="%s" media="%s" rel="stylesheet" type="text/css">',
            $cssFile,
            $media
        );
    }



    public function headTitle()
    {
        return $this->_headTitle;
    }

    public function headLink()
    {
        return implode(PHP_EOL, $this->headStyleSheetFiles);
    }

    public function bodyScript()
    {
        return implode(PHP_EOL, $this->bodyScriptUrls);
    }

    public function url($routeName)
    {
        return $this->_router->pathFor($routeName);
    }






}
