<?php

namespace perf\Template;

/**
 *
 *
 */
class Token
{

    /**
     *
     *
     * @var string
     */
    private $tokenPrefix = '<#';

    /**
     *
     *
     * @var string
     */
    private $tokenSuffix = '#>';

    /**
     *
     *
     * @var string
     */
    private $template = '';

    /**
     *
     *
     * @var {string:string}
     */
    private $vars = array();

    /**
     *
     *
     * @param string $tokenPrefix
     * @return Token Fluent return.
     */
    public function setTokenPrefix($tokenPrefix)
    {
        $this->tokenPrefix = (string) $tokenPrefix;

        return $this;
    }

    /**
     *
     *
     * @param string $tokenSuffix
     * @return Token Fluent return.
     */
    public function setTokenSuffix($tokenSuffix)
    {
        $this->tokenSuffix = (string) $tokenSuffix;

        return $this;
    }

    /**
     *
     *
     * @param array $vars
     * @return Token Fluent return.
     */
    public function setVars(array $vars)
    {
        $this->vars = array();

        foreach ($vars as $var => $value) {
            $this->setVar($var, $value);
        }

        return $this;
    }

    /**
     *
     *
     * @param string $var
     * @param string $value
     * @return void
     */
    public function __set($var, $value)
    {
        $this->setVar($var, $value);
    }

    /**
     *
     *
     * @param string $var
     * @param string $value
     * @return Token Fluent return.
     */
    public function setVar($var, $value)
    {
        $this->vars[(string) $var] = (string) $value;

        return $this;
    }

    /**
     *
     *
     * @return {string:string}
     */
    public function getVars()
    {
        return $this->vars;
    }

    /**
     *
     *
     * @param string $var
     * @return string
     */
    public function __get($var)
    {
        return $this->getVar($var);
    }

    /**
     *
     *
     * @param string $var
     * @return string
     */
    public function getVar($var)
    {
        $var = (string) $var;

        return array_key_exists($var, $this->vars)
             ? $this->vars[$var]
             : '';
    }

    /**
     *
     *
     * @param string $path
     * @return Token Fluent return.
     * @throws \RuntimeException
     */
    public function loadTemplateFile($path)
    {
        $content = file_get_contents($path);

        if (false === $content) {
            throw new \RuntimeException();
        }

        return $this->setTemplate($content);
    }

    /**
     *
     *
     * @param string $template
     * @return Token Fluent return.
     */
    public function setTemplate($template)
    {
        $this->template = (string) $template;

        return $this;
    }

    /**
     *
     *
     * @return void
     */
    public function render()
    {
        echo $this->fetch();
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
     * @return string
     */
    public function fetch()
    {
        $search  = array();
        $replace = array();

        foreach ($this->vars as $var => $value) {
            $search[]  = $this->tokenPrefix . $var . $this->tokenSuffix;
            $replace[] = $value;
        }

        return $this->cleanTokens(str_replace($search, $replace, $this->template));
    }

    /**
     * Cleans remaining tokens in provided template string.
     *
     * @param string $template
     * @return string
     */
    protected function cleanTokens($template)
    {
        $pattern = '/' . preg_quote($this->tokenPrefix, '/')
                 . '.*'
                 . preg_quote($this->tokenSuffix, '/') . '/U';

        return preg_replace($pattern, '', $template);
    }
}
