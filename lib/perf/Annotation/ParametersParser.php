<?php

namespace perf\Annotation;

/**
 *
 *
 * @package perf
 */
class ParametersParser
{

    /**
     *
     * Temporary property.
     *
     * @var string
     */
    private $parametersString;

    /**
     *
     * Temporary property.
     *
     * @var string
     */
    private $parameterName;

    /**
     *
     *
     * @param string $parametersString
     * @return {string:string}
     * @throws \RuntimeException
     */
    public function parse($parametersString)
    {
        $this->parametersString = $parametersString;
        $parsedParameters       = array();

        while (true) {
            $this->name();
            $this->equals();
            $this->doubleQuote();
            $this->value();
            $this->doubleQuote();

            $parsedParameters[$this->parameterName] = $this->parameterValue;

            if ($this->nothingMoreToParse()) {
                break;
            }

            $this->comma();
        }

        return $parsedParameters;
    }

    /**
     *
     *
     */
    private function name()
    {
        $this->parameterName = $this->expectRegex('|^([a-zA-Z][a-zA-Z\d]*)\=|');
    }

    /**
     *
     *
     */
    private function equals()
    {
        $this->expectString('=');
    }

    /**
     *
     *
     */
    private function doubleQuote()
    {
        $this->expectString('"');
    }

    /**
     *
     *
     */
    private function value()
    {
        // @todo Take escaped double-quotes (\") into account.

        $this->parameterValue = $this->expectRegex('|^([^"]+)|');
    }

    /**
     *
     *
     */
    private function comma()
    {
        $this->expectRegex('|^(\s*,\s*)|');
    }

    /**
     *
     *
     * @param string $pattern
     * @return string
     */
    private function expectRegex($pattern)
    {
        $matches = array();

        if (1 !== preg_match($pattern, $this->parametersString, $matches)) {
            throw new \RuntimeException();
        }

        $match       = $matches[1];
        $matchLength = strlen($match);

        $this->chopLeft($matchLength);

        return $match;
    }

    /**
     *
     *
     * @param string $expectedString
     * @return void
     */
    private function expectString($expectedString)
    {
        if (0 !== strpos($this->parametersString, $expectedString)) {
            throw new \RuntimeException();
        }

        $stringLength = strlen($expectedString);

        $this->chopLeft($stringLength);
    }

    /**
     *
     *
     * @param int $lenght
     * @return void
     */
    private function chopLeft($length)
    {
        $this->parametersString = substr($this->parametersString, $length);
    }

    /**
     *
     *
     */
    private function nothingMoreToParse()
    {
        return (strlen($this->parametersString) < 1);
    }
}
