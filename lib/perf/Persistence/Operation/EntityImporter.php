<?php

namespace perf\Persistence\Operation;

use \perf\Persistence\EntityMetadata;

/**
 *
 *
 * @package perf
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
