<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$app->get('/', function () use ($app) {
    return 'Nothing to see here.';
});

$app->get('/event/push', function () use ($app) {
    /**
     * do the update.
     * 1 - cd to /dev-human/dev-human and pull from main repo
     * 2 - run the sculpin command and generate the prod output
     */

    $local_path = "/www/dev-human/dev-human";
    //$local_path = "/home/erika/Projects/dev-human";
    $update_log = __DIR__ . '/../../logs/update.log';

    shell_exec("cd $local_path && git pull 2>&1");
    shell_exec("cd $local_path && sculpin generate --env=prod 2>&1");

    $fp = fopen($update_log, "a+");
    if ($fp !== false) {
        fwrite($fp, date('[Y-m-d H:i:s]') . " Updated production website.\n");
        fclose($fp);
    }

    return new \Symfony\Component\HttpFoundation\Response("Done.");
});

$app->run();