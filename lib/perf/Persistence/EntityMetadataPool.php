<?php

namespace perf\Persistence;

use \perf\Persistence\Annotation\EntityAnnotationParser;

/**
 *
 *
 * @package perf
 */
class EntityMetadataPool
{

    /**
     * Entity annotation parser.
     *
     * @var EntityAnnotationParser
     */
    private $entityAnnotationParser;

    /**
     *
     *
     * @var \perf\Caching\CacheClient
     */
    private $cacheClient;

    /**
     *
     *
     * @var string
     */
    private $cacheId = 'PERF_PERSISTENCE_ENTITIES_METADATA';

    /**
     *
     *
     * @var bool
     */
    private $cacheRestored = false;

    /**
     * Entity metadatas.
     *
     * @var {string:EntityMetadata}
     */
    private $entityMetadatas = array();

    /**
     *
     *
     * @param EntityAnnotationParser $parser
     * @return void
     */
    public function setEntityAnnotationParser(EntityAnnotationParser $parser)
    {
        $this->entityAnnotationParser = $parser;
    }

    /**
     *
     *
     * @param \perf\Caching\CacheClient $client
     * @return void
     */
    public function setCacheClient(\perf\Caching\CacheClient $client)
    {
        $this->cacheClient = $client;
    }

    /**
     *
     *
     * @param string $entityClass
     * @return EntityMetadata
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function fetch($entityClass)
    {
        if (!is_string($entityClass)) {
            throw new \InvalidArgumentException();
        }

        if (!$this->cacheRestored) {
            $this->restoreCache();

            $this->cacheRestored = true;
        }

        if (!array_key_exists($entityClass, $this->entityMetadatas)) {
            try {
                $entityMetadata = $this->getEntityAnnotationParser()->parse($entityClass);
            } catch (\Exception $e) {
                throw new \RuntimeException("Failed to parse entity class '{$entityClass}' annotations. << {$e->getMessage()}", 0, $e);
            }

            $this->storeEntityMetadata($entityMetadata);

            $this->persistCache();
        }

        return $this->entityMetadatas[$entityClass];
    }

    /**
     *
     *
     * @return void
     */
    private function restoreCache()
    {
        $this->entityMetadatas = array();

        $cacheFetchResult = $this->cacheClient->fetch($this->cacheId);

        if ($cacheFetchResult->hit()) {
            $entityMetadatas = $cacheFetchResult->data();

            if (!is_array($entityMetadatas)) {
                throw new \RuntimeException();
            }

            foreach ($entityMetadatas as $entityMetadata) {
                $this->storeEntityMetadata($entityMetadata);
            }
        }
    }

    /**
     *
     *
     * @return EntityAnnotationParser
     */
    private function getEntityAnnotationParser()
    {
        if (!$this->entityAnnotationParser) {
            $this->setEntityAnnotationParser(new EntityAnnotationParser());
        }

        return $this->entityAnnotationParser;
    }

    /**
     *
     *
     * @return EntityMetadata $entityMetadata
     */
    private function storeEntityMetadata(EntityMetadata $entityMetadata)
    {
        $this->entityMetadatas[$entityMetadata->getClass()] = $entityMetadata;
    }

    /**
     *
     *
     * @return void
     */
    private function persistCache()
    {
        $this->cacheClient->store($this->cacheId, $this->entityMetadatas);
    }

    /**
     *
     *
     * @return void
     */
    public function purgeCache()
    {
        $this->cacheClient->flushAll();
    }
}
