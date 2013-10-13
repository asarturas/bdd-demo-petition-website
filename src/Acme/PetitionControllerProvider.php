<?php

namespace Acme;

use Silex\Application;
use Silex\ControllerProviderInterface;

class PetitionControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controller = new \Acme\PetitionController($app['twig']);

        $controllers->get('/', array($controller, 'indexAction'));
        $controllers->get('/sign', array($controller, 'signAction'));

        return $controllers;
    }
}