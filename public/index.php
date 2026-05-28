<?php

declare(strict_types=1);

use Velt\Http\Dispatcher;
use Velt\Http\Request;

$kernel = require __DIR__ . '/../bootstrap/app.php';

/** @var Dispatcher $dispatcher */
$dispatcher = $kernel['dispatcher'];
$dispatcher->dispatch(Request::capture())->send();
