<?php

namespace perf\Http;

/**
 * This class lists all available HTTP/1.0 and HTTP/1.1 header status codes, and allows to send complete
 *   header status strings.
 *
 */
class Status
{

    const HTTP_1_0 = '1.0';
    const HTTP_1_1 = '1.1';

    const _CONTINUE                       = 100; // HTTP/1.1 only, "continue" is a reserved keyword
    const SWITCHING_PROTOCOLS             = 101; // HTTP/1.1 only
    const OK                              = 200; // HTTP/1.0 + HTTP/1.1
    const CREATED                         = 201; // HTTP/1.0 + HTTP/1.1
    const ACCEPTED                        = 202; // HTTP/1.0 + HTTP/1.1
    const NON_AUTHORITATIVE_INFORMATION   = 203; // HTTP/1.1 only
    const NO_CONTENT                      = 204; // HTTP/1.0 + HTTP/1.1
    const RESET_CONTENT                   = 205; // HTTP/1.1 only
    const PARTIAL_CONTENT                 = 206; // HTTP/1.1 only
    const MULTIPLE_CHOICES                = 300; // HTTP/1.0 + HTTP/1.1
    const MOVED_PERMANENTLY               = 301; // HTTP/1.0 + HTTP/1.1
    const MOVED_TEMPORARILY               = 302; // HTTP/1.0 only (@see also FOUND)
    const FOUND                           = 302; // HTTP/1.1 only (@see also MOVED_TEMPORARILY)
    const SEE_OTHER                       = 303; // HTTP/1.1 only
    const NOT_MODIFIED                    = 304; // HTTP/1.0 + HTTP/1.1
    const USE_PROXY                       = 305; // HTTP/1.1 only
    const TEMPORARY_REDIRECT              = 307; // HTTP/1.1 only
    const BAD_REQUEST                     = 400; // HTTP/1.0 + HTTP/1.1
    const UNAUTHORIZED                    = 401; // HTTP/1.0 + HTTP/1.1
    const PAYMENT_REQUIRED                = 402; // HTTP/1.1 only
    const FORBIDDEN                       = 403; // HTTP/1.0 + HTTP/1.1
    const NOT_FOUND                       = 404; // HTTP/1.0 + HTTP/1.1
    const METHOD_NOT_ALLOWED              = 405; // HTTP/1.1 only
    const NOT_ACCEPTABLE                  = 406; // HTTP/1.1 only
    const PROXY_AUTHENTICATION_REQUIRED   = 407; // HTTP/1.1 only
    const REQUEST_TIMEOUT                 = 408; // HTTP/1.1 only
    const CONFLICT                        = 409; // HTTP/1.1 only
    const GONE                            = 410; // HTTP/1.1 only
    const LENGTH_REQUIRED                 = 411; // HTTP/1.1 only
    const PRECONDITION_FAILED             = 412; // HTTP/1.1 only
    const REQUEST_ENTITY_TOO_LARGE        = 413; // HTTP/1.1 only
    const REQUEST_URI_TOO_LONG            = 414; // HTTP/1.1 only
    const UNSUPPORTED_MEDIA_TYPE          = 415; // HTTP/1.1 only
    const REQUESTED_RANGE_NOT_SATISFIABLE = 416; // HTTP/1.1 only
    const EXPECTATION_FAILED              = 417; // HTTP/1.1 only
    const INTERNAL_SERVER_ERROR           = 500; // HTTP/1.0 + HTTP/1.1
    const NOT_IMPLEMENTED                 = 501; // HTTP/1.0 + HTTP/1.1
    const BAD_GATEWAY                     = 502; // HTTP/1.0 + HTTP/1.1
    const SERVICE_UNAVAILABLE             = 503; // HTTP/1.0 + HTTP/1.1
    const GATEWAY_TIMEOUT                 = 504; // HTTP/1.1 only
    const HTTP_VERSION_NOT_SUPPORTED      = 505; // HTTP/1.1 only

    /**
     * Default HTTP version to use.
     *
     * @var string
     */
    private static $httpVersionDefault = self::HTTP_1_1;

    /**
     * List of supported HTTP versions.
     *
     * @var string[]
     */
    private static $supportedHttpVersions = array(
        self::HTTP_1_0,
        self::HTTP_1_1,
    );

    /**
     * Associative array matching HTTP status codes to HTTP status reasons.
     *
     * @var {int string}
     */
    private static $reasons = array(
        self::_CONTINUE                       => 'Continue',
        self::SWITCHING_PROTOCOLS             => 'Switching Protocols',
        self::OK                              => 'OK',
        self::CREATED                         => 'Created',
        self::ACCEPTED                        => 'Accepted',
        self::NON_AUTHORITATIVE_INFORMATION   => 'Non-Authoritative Information',
        self::NO_CONTENT                      => 'No Content',
        self::RESET_CONTENT                   => 'Reset Content',
        self::PARTIAL_CONTENT                 => 'Partial Content',
        self::MULTIPLE_CHOICES                => 'Multiple Choices',
        self::MOVED_PERMANENTLY               => 'Moved Permanently',
        self::FOUND                           => 'Found',
        self::SEE_OTHER                       => 'See Other',
        self::NOT_MODIFIED                    => 'Not Modified',
        self::USE_PROXY                       => 'Use Proxy',
        self::TEMPORARY_REDIRECT              => 'Temporary Redirect',
        self::BAD_REQUEST                     => 'Bad Request',
        self::UNAUTHORIZED                    => 'Unauthorized',
        self::PAYMENT_REQUIRED                => 'Payment Required',
        self::FORBIDDEN                       => 'Forbidden',
        self::NOT_FOUND                       => 'Not Found',
        self::METHOD_NOT_ALLOWED              => 'Method Not Allowed',
        self::NOT_ACCEPTABLE                  => 'Not Acceptable',
        self::PROXY_AUTHENTICATION_REQUIRED   => 'Proxy Authentication Required',
        self::REQUEST_TIMEOUT                 => 'Request Timeout',
        self::CONFLICT                        => 'Conflict',
        self::GONE                            => 'Gone',
        self::LENGTH_REQUIRED                 => 'Length Required',
        self::PRECONDITION_FAILED             => 'Precondition Failed',
        self::REQUEST_ENTITY_TOO_LARGE        => 'Request Entity Too Large',
        self::REQUEST_URI_TOO_LONG            => 'Request-URI Too Long',
        self::UNSUPPORTED_MEDIA_TYPE          => 'Unsupported Media Type',
        self::REQUESTED_RANGE_NOT_SATISFIABLE => 'Requested Range Not Satisfiable',
        self::EXPECTATION_FAILED              => 'Expectation Failed',
        self::INTERNAL_SERVER_ERROR           => 'Internal Server Error',
        self::NOT_IMPLEMENTED                 => 'Not Implemented',
        self::BAD_GATEWAY                     => 'Bad Gateway',
        self::SERVICE_UNAVAILABLE             => 'Service Unavailable',
        self::GATEWAY_TIMEOUT                 => 'Gateway Timeout',
        self::HTTP_VERSION_NOT_SUPPORTED      => 'HTTP Version Not Supported',
    );

    /**
     * Sets the default HTTP version to use.
     *
     * @param string $httpVersion default HTTP version to use.
     * @return void
     * @throws \InvalidArgumentException
     */
    public static function setHttpVersionDefault($httpVersion)
    {
        $httpVersion = (string) $httpVersion;

        if (!in_array($httpVersion, self::$supportedHttpVersions, true)) {
            throw new \InvalidArgumentException("HTTP Version '{$httpVersion}' not supported.");
        }

        self::$httpVersionDefault = $httpVersion;
    }

    /**
     * Returns the matching HTTP reason string for the specified HTTP status code.
     *
     * @param int $statusCode HTTP status code to use.
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function getReason($statusCode)
    {
        $statusCode = (int) $statusCode;

        if (array_key_exists($statusCode, self::$reasons)) {
            return self::$reasons[$statusCode];
        }

        throw new \InvalidArgumentException("Unknown HTTP Status Code: '{$statusCode}'.");
    }

    /**
     * Builds a HTTP status header string according to specified HTTP status code and HTTP version.
     *
     * @param int $statusCode HTTP status code to use for the HTTP header string.
     * @param null|string $httpVersion  HTTP version to use for the HTTP header string.
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function get($statusCode, $httpVersion = null)
    {
        $statusCode = (int) $statusCode;

        $httpVersion = is_null($httpVersion)
                     ? self::$httpVersionDefault
                     : $httpVersion;

        $prefix = self::getHttpVersionPrefix($httpVersion);

        $reason = self::getReason($statusCode);

        return $prefix . ' ' . $statusCode . ' ' . $reason;
    }

    /**
     * Build the HTTP version part of a HTTP header status string.
     *
     * @param string $httpVersion HTTP version to use.
     * @return string HTTP version part of a HTTP header status string.
     * @throws \InvalidArgumentException
     */
    private static function getHttpVersionPrefix($httpVersion)
    {
        $httpVersion = (string) $httpVersion;

        if (!in_array($httpVersion, self::$supportedHttpVersions, true)) {
            throw new \InvalidArgumentException("HTTP Version '{$httpVersion}' not supported.");
        }

        return "HTTP/{$httpVersion}";
    }

    /**
     * Sends a HTTP status header according to specified HTTP status code and HTTP version.
     *
     * @param int $statusCode HTTP status code to use for the HTTP header.
     * @param null|string $httpVersion HTTP version to use for the HTTP header.
     * @return void
     * @throws \InvalidArgumentException
     */
    public static function send($statusCode, $httpVersion = null)
    {
        header(self::get($statusCode, $httpVersion));
    }
}
