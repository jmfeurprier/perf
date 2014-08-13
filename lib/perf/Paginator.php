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
     * Constructor.
     *
     * @param int $itemCount Total number of items to paginate.
     * @param int $itemsPerPage Number of items to be shown per page.
     * @param int $currentPage Index of the current page.
     * @param int $firstPage Index of the first page.
     * @return void
     */
    public function __construct($itemCount, $itemsPerPage, $currentPage, $firstPage = 1)
    {
        $this->itemCount    = max(0, (int) $itemCount);
        $this->itemsPerPage = max(1, (int) $itemsPerPage);

        $this->pageCount    = max(1, (int) ceil($this->itemCount / $this->itemsPerPage));

        $this->firstPage    = (int) $firstPage;
        $this->lastPage     = ($this->firstPage + $this->pageCount - 1);

        $this->setCurrentPage($currentPage);
    }

    /**
     * Alters the value of current page index.
     *
     * @param int $currentPage current page to be shown. Value will be corrected automatically if not valid.
     * @return Paginator Fluent return.
     */
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = min($this->lastPage, max($this->firstPage, (int) $currentPage));

        return $this;
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
     * Returns the index of the previous page (may be equal to the current page index, if current page
     *   is the first page).
     *
     * @return int
     */
    public function getPreviousPage()
    {
        return max($this->firstPage, ($this->currentPage - 1));
    }

    /**
     * Returns the index of the next page (may be equal to current page index, if current page is the last page).
     *
     * @return int
     */
    public function getNextPage()
    {
        return min($this->lastPage, ($this->currentPage + 1));
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
