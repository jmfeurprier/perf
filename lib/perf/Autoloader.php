<?php

namespace perf;

/**
 *
 *
 * @package perf
 */
class Autoloader
{

    const CLASS_PREFIX_DEFAULT      = '';
    const CLASS_FILE_SUFFIX_DEFAULT = '.php';

    /**
     *
     *
     * @var string
     */
    private $classesBasePath;

    /**
     *
     *
     * @var string
     */
    private $classPrefix = self::CLASS_PREFIX_DEFAULT;

    /**
     *
     *
     * @var string
     */
    private $classFileSuffix = self::CLASS_FILE_SUFFIX_DEFAULT;

    /**
     *
     *
     * @param string $classesBasePath
     * @return Autoloader fluent return
     */
    public static function register($classesBasePath)
    {
        $loader = new self($classesBasePath);

        spl_autoload_register($loader->getAutoloadCallback());

        return $loader;
    }

    /**
     *
     *
     * @param string $classesBasePath
     * @return void
     */
    public function __construct($classesBasePath)
    {
        $this->setClassesBasePath($classesBasePath);
    }

    /**
     *
     *
     * @param string $path
     * @return Autoloader fluent return
     */
    public function setClassesBasePath($path)
    {
        $this->classesBasePath = rtrim($path, '\\/') . DIRECTORY_SEPARATOR;

        return $this;
    }

    /**
     *
     *
     * @param string $prefix
     * @return Autoloader fluent return
     */
    public function setClassPrefix($prefix)
    {
        $this->classPrefix = (string) $prefix;

        return $this;
    }

    /**
     *
     *
     * @param string $suffix
     * @return Autoloader fluent return
     */
    public function setClassFileSuffix($suffix)
    {
        $this->classFileSuffix = (string) $suffix;

        return $this;
    }

    /**
     *
     *
     * @return array
     */
    public function getAutoloadCallback()
    {
        return array($this, 'autoload');
    }

    /**
     *
     *
     * @param string $class
     * @return void
     */
    public function autoload($class)
    {
        if ($this->hasClassExpectedPrefix($class)) {
            $classPath = $this->getPathFromClass($class);

            if (is_readable($classPath)) {
                require($classPath);
            }
        }
    }

    /**
     *
     *
     * @param string $class
     * @return bool
     */
    protected function hasClassExpectedPrefix($class)
    {
        if ('' === $this->classPrefix) {
            return true;
        }

        if (0 === strpos($class, $this->classPrefix)) {
            return true;
        }

        return false;
    }

    /**
     * Returns absolute path according to provided class name.
     *
     * @param string $class
     * @return string
     */
    private function getPathFromClass($class)
    {
        $classWithoutPrefix = substr($class, strlen($this->classPrefix));

        $classRelativePath = str_replace(
            array('_', '\\'),
            DIRECTORY_SEPARATOR,
            $classWithoutPrefix
        );

        return $this->classesBasePath . $classRelativePath . $this->classFileSuffix;
    }
}
