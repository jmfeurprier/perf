<?php

$rootPath = realpath(__DIR__ . '/../..') . '/';

require($rootPath . 'lib/perf/Autoloader.php');

\perf\Autoloader::register($rootPath . 'lib/perf')->setClassPrefix('perf');
