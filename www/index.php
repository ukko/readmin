<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
error_reporting(E_ALL);

require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/controllers.php';

$app['debug'] = 1;

$app->run();
