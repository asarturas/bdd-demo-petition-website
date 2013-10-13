<?php

namespace Acme;

class PetitionController
{
    const PETITION_TITLE = 'Doughnuts should be banned because they are too fascinating';

    protected $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function indexAction()
    {
        return $this->twig->render('index.html.twig', array('title' => self::PETITION_TITLE));
    }

    public function signAction()
    {
        return $this->twig->render('sign.html.twig', array());
    }
}
