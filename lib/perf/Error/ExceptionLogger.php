<?php

namespace perf\Error;

/**
 *
 *
 */
class ExceptionLogger
{

    /**
     *
     *
     * @param \Exception $exception
     * @return void
     */
    public function log(\Exception $exception)
    {
        $exceptions = array(
            $exception,
        );

        while ($previousException = $exception->getPrevious()) {
            $exceptions[] = $previousException;

            $exception = $previousException;
        }

        $exceptionMessages = array();

        foreach ($exceptions as $exception) {
            $exceptionMessage = "{$exception->getFile()}:{$exception->getLine()} "
                              . "{$exception->getMessage()}\n"
                              . "{$exception->getTraceAsString()}";

            $exceptionMessages[] = $exceptionMessage;
        }

        $message = join("\n", $exceptionMessages);

        error_log($message);
    }
}
