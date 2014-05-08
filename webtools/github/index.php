<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$app = new Silex\Application();

$app->get('/', function () use ($app) {
    return 'Nothing to see here.';
});

$app->get('/event/push', function () use ($app) {
    /**
     * do the update.
     * 1 - cd to /dev-human/dev-human and pull from main repo
     * 2 - run the sculpin command and generate the prod output
     */
});

$app->run();