<?php

namespace Acme;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class PetitionControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controller = new \Acme\PetitionController($app['twig'], $app['db']);

        $controllers->get('/', array($controller, 'indexAction'));
        $controllers->get(
            '/sign',
            function(Request $request) use ($controller) {
                return $controller->signAction($request->get('name'));
            }
        );

        return $controllers;
    }
}