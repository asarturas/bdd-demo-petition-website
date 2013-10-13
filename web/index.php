<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../res/views',
));

$app->mount('/', new Acme\PetitionControllerProvider());

$app->run();