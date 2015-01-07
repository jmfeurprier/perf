<?php

namespace perf;

/**
 * This class helps computing the different page indexes (first, previous, next, etc.) related to pagination.
 *
 * @package perf
 */
class Paginator
{

    /**
     * Total number of items to paginate.
     *
     * @var int
     */
    private $itemCount;

    /**
     * Number of items to be shown per page.
     *
     * @var int
     */
    private $itemsPerPage;

    /**
     * Index of the current page.
     *
     * @var int
     */
    private $currentPage;

    /**
     * Total number of pages.
     *
     * @var int
     */
    private $pageCount;

    /**
     * Index of the first page.
     *
     * @var int
     */
    private $firstPage;

    /**
     * Index of the last page.
     *
     * @var int
     */
    private $lastPage;

    /**
     * Index of the previous page, if any.
     *
     * @var null|int
     */
    private $previousPage;

    /**
     * Index of the next page, if any.
     *
     * @var null|int
     */
    private $nextPage;

    /**
     * Constructor.
     *
     * @param int $itemCount Total number of items to paginate.
     * @param int $itemsPerPage Number of items to be shown per page.
     * @param int $currentPage Index of the current page.
     * @param int $firstPage Index of the first page.
     * @return void
     * @throws \InvalidArgumentException
     */
    public function __construct($itemCount, $itemsPerPage, $currentPage, $firstPage = 1)
    {
        $this->validateGreaterOrEquals('item count', 0, $itemCount);
        $this->validateGreaterOrEquals('items per page', 1, $itemsPerPage);
        $this->validateGreaterOrEquals('first page', 0, $firstPage);
        
        $this->itemCount    = $itemCount;
        $this->itemsPerPage = $itemsPerPage;
        $this->pageCount    = max(1, (int) ceil($this->itemCount / $this->itemsPerPage));
        $this->firstPage    = $firstPage;
        $this->lastPage     = ($this->firstPage + $this->pageCount - 1);

        $this->setCurrentPage($currentPage);
    }

    /**
     *
     *
     * @param string $parameter
     * @param int $threshold
     * @param int $value
     * @return void
     * @throws \InvalidArgumentException
     */
    private function validateGreaterOrEquals($parameter, $threshold, $value)
    {
        $this->validateInteger($parameter, $value);

        if ($value < $threshold) {
            $message = "Provided {$parameter} is not greater or equal to {$value}.";

            throw new \InvalidArgumentException($message);
        }
    }

    /**
     * Alters the value of current page index.
     *
     * @param int $currentPage current page to be shown. Value will be corrected automatically if not valid.
     * @return Paginator Fluent return.
     */
    public function setCurrentPage($currentPage)
    {
        $this->validateInteger('current page', $currentPage);

        // Fix current page index if needed.
        $this->currentPage = min($this->lastPage, max($this->firstPage, $currentPage));

        if ($this->currentPage > $this->firstPage) {
            $this->previousPage = $this->currentPage - 1;
        } else {
            $this->previousPage = null;
        }

        if ($this->currentPage < $this->lastPage) {
            $this->nextPage = $this->currentPage + 1;
        } else {
            $this->nextPage = null;
        }

        return $this;
    }

    /**
     *
     *
     * @param string $parameter
     * @param int $value
     * @return void
     * @throws \InvalidArgumentException
     */
    private function validateInteger($parameter, $value)
    {
        if (!is_int($value)) {
            $message = "Provided {$parameter} is not an integer.";

            throw new \InvalidArgumentException($message);
        }
    }

    /**
     * Returns the total number of items to paginate.
     *
     * @return int
     */
    public function getItemCount()
    {
        return $this->itemCount;
    }

    /**
     * Returns the number of items to be shown per page.
     *
     * @return int
     */
    public function getItemsPerPage()
    {
        return $this->itemsPerPage;
    }

    /**
     * Returns the total number of pages.
     *
     * @return int
     */
    public function getPageCount()
    {
        return $this->pageCount;
    }

    /**
     * Returns the index of the current page.
     *
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * Returns the index of the first page.
     *
     * @return int
     */
    public function getFirstPage()
    {
        return $this->firstPage;
    }

    /**
     * Returns the index of the previous page.
     *
     * @return int
     */
    public function getPreviousPage()
    {
        if ($this->hasPreviousPage()) {
            return $this->previousPage;
        }

        throw new \RuntimeException();
    }

    /**
     * Returns true if a previous page exists (ie, if current page is not the first page).
     *
     * @return bool
     */
    public function hasPreviousPage()
    {
        return !is_null($this->previousPage);
    }

    /**
     * Returns the index of the next page (may be equal to current page index, if current page is the last page).
     *
     * @return int
     */
    public function getNextPage()
    {
        if ($this->hasNextPage()) {
            return $this->nextPage;
        }

        throw new \RuntimeException();
    }

    /**
     * Returns true if a next page exists (ie, if current page is not the last page).
     *
     * @return bool
     */
    public function hasNextPage()
    {
        return !is_null($this->nextPage);
    }

    /**
     * Returns the index of the last page.
     *
     * @return int
     */
    public function getLastPage()
    {
        return $this->lastPage;
    }

    /**
     * Returns the index of the first item in the current page (may be useful to compute a SQL LIMIT clause).
     *
     * @return int
     */
    public function getItemIndex()
    {
        return (($this->currentPage - $this->firstPage) * $this->itemsPerPage);
    }
}
