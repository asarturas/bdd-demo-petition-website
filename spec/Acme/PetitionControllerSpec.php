<?php

namespace spec\Acme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PetitionControllerSpec extends ObjectBehavior
{
    function let(\Twig_Environment $twig, \Doctrine\DBAL\Connection $conn)
    {
        $twig->render(Argument::any(), Argument::type('array'))->willReturn('');

        $this->beConstructedWith($twig, $conn);
    }

    function its_index_action_returns_a_string()
    {
        $this->indexAction()->shouldBeString();
    }

    function its_sign_action_returns_a_string()
    {
        $this->signAction('Chuck Norris')->shouldBeString();
    }

    function its_sign_action_adds_signer_to_database_and_fetches_all_signers(\Doctrine\DBAL\Connection $conn)
    {
        $conn->insert('signers', Argument::type('array'))->shouldBeCalled();
        $conn->fetchAll(Argument::type('string'))->shouldBeCalled();
        $this->signAction('Chuck Norris');
    }

}
