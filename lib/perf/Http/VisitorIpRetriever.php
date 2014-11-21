<?php

namespace perf\Http;

use \perf\String\IpV4;

/**
 *
 *
 */
class VisitorIpRetriever
{

    /**
     * Attempts to retrieve current visitor IPv4 address.
     *
     * @param null|array $serverValues Values from $_SERVER superglobal variable (optional).
     * @return IpV4 Current visitor IPv4 address.
     * @throws \RuntimeException
     */
    public function retrieve(array $serverValues = null)
    {
        static $keys = array(
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'REMOTE_ADDR',
        );

        $serverValues = $this->getServerValues($serverValues);

        foreach ($keys as $key) {
            if (isset($serverValues[$key])) {
                $ip = $serverValues[$key];

                if (IpV4::validate($ip)) {
                    return new IpV4($ip);
                }

                throw new \RuntimeException('Invalid IP format.');
            }
        }

        throw new \RuntimeException('Unable to retrieve visitor IP address.');
    }

    /**
     *
     *
     * @param null|array $serverValues Values from $_SERVER superglobal variable.
     * @return array
     * @throws \RuntimeException
     */
    private function getServerValues(array $serverValues = null)
    {
        if (is_null($serverValues)) {
            if (!isset($_SERVER)) {
                $message = 'Unable to retrieve visitor IP address: '
                         . 'superglobal variable $_SERVER is not set. '
                         . 'Calling retriever from command line?';

                throw new \RuntimeException($message);
            }

            $serverValues = $_SERVER;
        }

        return $serverValues;
    }
}
