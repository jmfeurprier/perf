<?php

namespace perf\Template;

/**
 *
 *
 * @package perf
 */
class Php
{

    /**
     *
     *
     * @var string
     */
    private $templateFile = '';

    /**
     *
     *
     * @var array
     */
    private $vars = array();

    /**
     * Constructor.
     *
     * @param string $templateFile
     * @param array $vars
     * @return void
     */
    public function __construct($templateFile = '', array $vars = array())
    {
        $this->setTemplateFile($templateFile);
        $this->setVars($vars);
    }

    /**
     *
     *
     * @param array $vars
     * @return Php Fluent return.
     */
    public function setVars(array $vars)
    {
        $this->vars = array();

        foreach ($vars as $var => $value) {
            $this->__set($var, $value);
        }

        return $this;
    }

    /**
     *
     *
     * @return array
     */
    public function getVars()
    {
        return $this->vars;
    }

    /**
     *
     * Magic method.
     *
     * @param string $var
     * @param mixed $value
     * @return void
     */
    public function __set($var, $value)
    {
        $this->vars[(string) $var] = $value;
    }

    /**
     *
     * Magic method.
     *
     * @param string $var
     * @return mixed
     */
    public function &__get($var)
    {
        return $this->vars[(string) $var];
    }

    /**
     *
     *
     * @param string $templateFile
     * @return Php Fluent return.
     */
    public function setTemplateFile($templateFile)
    {
        $this->templateFile = (string) $templateFile;

        return $this;
    }

    /**
     *
     *
     * @return string
     */
    public function __toString()
    {
        return $this->fetch();
    }

    /**
     *
     *
     * @param array $vars
     * @return string
     */
    public function fetch(array $vars = array())
    {
        ob_start();

        $this->render($vars);

        return ob_get_clean();
    }

    /**
     *
     *
     * @param array $vars
     * @return Php Fluent return.
     */
    public function render(array $vars = array())
    {
        $this->renderTemplateFile($this->templateFile, $vars);

        return $this;
    }

    /**
     *
     *
     * @param string $templateFile
     * @param array $vars
     * @return Php Fluent return.
     */
    private function renderTemplateFile($templateFile, array $vars = array())
    {
        extract($this->vars);
        extract($vars);

        include($templateFile);

        return $this;
    }
}
