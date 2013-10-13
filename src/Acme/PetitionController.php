<?php

namespace Acme;

class PetitionController
{
    const PETITION_TITLE = 'Doughnuts should be banned because they are too fascinating';

    protected $twig;
    protected $dbConn;

    public function __construct(\Twig_Environment $twig, \Doctrine\DBAL\Connection $conn)
    {
        $this->twig = $twig;
        $this->dbConn = $conn;
    }

    public function indexAction()
    {
        return $this->twig->render('index.html.twig', array('title' => self::PETITION_TITLE));
    }

    public function signAction($name)
    {
        $this->dbConn->insert('signers', array('name' => $name));
        $signers = $this->dbConn->fetchAll('SELECT * FROM `signers`');
        return $this->twig->render('sign.html.twig', array('signers' => $signers));
    }
}
