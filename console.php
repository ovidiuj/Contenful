#!/usr/bin/env php
<?php

set_time_limit(0);

require_once __DIR__ . '/vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

require __DIR__ . '/config/config.php';

require __DIR__ . '/src/app.php';

$console = &$app["console"];
$console->add(new \Command\RenderSpace($app));
$console->run();
