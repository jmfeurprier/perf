<?php

namespace perf\Http;

/**
 * This class allows to redirect visitors to other web sites / pages, using HTTP header and HTTP status codes.
 *
 */
class Redirector
{

    /**
     * List of allowed HTTP status codes for redirecting.
     *
     * @var int[]
     */
    private $allowedStatusCodes = array(
        Status::MULTIPLE_CHOICES,
        Status::MOVED_PERMANENTLY,
        Status::MOVED_TEMPORARILY,
        Status::FOUND,
        Status::SEE_OTHER,
        Status::NOT_MODIFIED,
        Status::USE_PROXY,
        Status::TEMPORARY_REDIRECT,
    );

    /**
     * Base URL to use when redirecting internally.
     *
     * @var string
     */
    private $baseUrl;

    /**
     * Sets base URL to use when redirecting internally, including scheme.
     *
     * @param mixed $baseUrl string / null
     * @return void
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = is_null($baseUrl)
                       ? null
                       : (string) $baseUrl;
    }

    /**
     * Makes an internal HTTP redirect (ie, on the same HTTP host than the current page being browsed)
     *   with specified HTTP status code.
     *
     * @param string $path path to redirect visitor to, on the current HTTP host being browsed.
     * @param int $statusCode HTTP status code to use for the redirect.
     * @return void
     */
    public function internal($path, $statusCode = Status::FOUND)
    {
        $path = (string) $path;

        $baseUrl = $this->getBaseUrl();

        $this->redirect($baseUrl . $path, $statusCode);
    }

    /**
     * Returns the base URL to use when redirecting internally.
     *
     * @return string
     * @throws \RuntimeException
     */
    private function getBaseUrl()
    {
        if (isset($this->baseUrl)) {
            return $this->baseUrl;
        }

        throw new \RuntimeException('No base URL set.');
    }

    /**
     * Makes an external HTTP redirect (ie, on a different HTTP host than the current page being browsed)
     *   with specified HTTP status code.
     *
     * @param string $url URL to redirect to.
     * @param int $statusCode HTTP status code to use for the redirect.
     * @return void
     */
    public function external($url, $statusCode = Status::FOUND)
    {
        $this->redirect($url, $statusCode);
    }

    /**
     * Makes a HTTP redirect with specified HTTP status code.
     *
     * @param string $url URL to redirect to.
     * @param int $statusCode HTTP status code to use for the redirect.
     * @return void
     * @throws \DomainException
     */
    private function redirect($url, $statusCode)
    {
        $statusCode = (int)    $statusCode;
        $url        = (string) $url;

        if (!in_array($statusCode, $this->allowedStatusCodes, true)) {
            throw new \DomainException("HTTP status code not allowed for redirect: '{$statusCode}'.");
        }

        Status::send($statusCode);

        header('Location: ' . $url);
    }
}
