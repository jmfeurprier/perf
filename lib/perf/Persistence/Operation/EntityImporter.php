<?php

namespace perf\Persistence\Operation;

use \perf\Persistence\EntityMetadata;
use \perf\Persistence\Column;

/**
 *
 *
 */
class EntityImporter
{

    /**
     *
     * Temporary property.
     *
     * @var object
     */
    private $entity;

    /**
     *
     * Temporary property.
     *
     * @var \ReflectionClass
     */
    private $reflectionClass;

    /**
     *
     *
     * @param EntityMetadata $entityMetadata
     * @param {string:mixed} $row
     * @return object
     */
    public function import(EntityMetadata $entityMetadata, array $row)
    {
        $entityClass = $entityMetadata->getClass();

        $this->entity = new $entityClass();

        $this->loadReflectionClass($entityClass);

        foreach ($entityMetadata->getColumns() as $column) {
            $columnName   = $column->getColumnName();
            $propertyName = $column->getPropertyName();

            if (array_key_exists($columnName, $row)) {
                $value = $row[$columnName];

                $value = $this->setValueType($value, $column);

                $this->setPropertyValue($propertyName, $value);
            }
        }

        return $this->entity;
    }

    /**
     *
     *
     * @param string $entityClass
     * @return void
     */
    private function loadReflectionClass($entityClass)
    {
        static $cache = array();

        if (!array_key_exists($entityClass, $cache)) {
            $cache[$entityClass] = new \ReflectionClass($entityClass);
        }

        $this->reflectionClass = $cache[$entityClass];
    }

    /**
     *
     *
     * @param null|string $value
     * @param Column $column
     * @return mixed
     */
    private function setValueType($value, Column $column)
    {
        if (is_null($value)) {
            return null;
        }

        switch ($column->getType()) {
            case 'int':
            case 'integer':
                return (int) $value;

            case 'float':
            case 'double':
                return (float) $value;

            case 'bool':
            case 'boolean':
                return (bool) $value;
        }

        return $value;
    }

    /**
     *
     *
     * @param string $propertyName
     * @param mixed $value
     * @return void
     */
    private function setPropertyValue($propertyName, $value)
    {
        $reflectionProperty = $this->reflectionClass->getProperty($propertyName);

        if ($reflectionProperty->isPublic()) {
            $reflectionProperty->setValue($this->entity, $value);
        } else {
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this->entity, $value);
            $reflectionProperty->setAccessible(false);
        }
    }
}
