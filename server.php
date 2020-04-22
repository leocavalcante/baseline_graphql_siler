#!/usr/bin/env php
<?php declare(strict_types=1);

use Siler\Route;
use function Siler\Swoole\{graphql_handler, http};

require_once __DIR__ . '/bootstrap.php';
global $schema, $root_value, $context;

$handler = graphql_handler($schema, $root_value, $context);
$server = function () use ($handler): void {
    Route\post('/graphql', $handler);
};

http($server, 9501)->start();