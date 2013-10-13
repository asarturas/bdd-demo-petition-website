<?php

namespace spec\Acme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PetitionControllerSpec extends ObjectBehavior
{
    function let(\Twig_Environment $twig)
    {
        $twig->render(Argument::any(), Argument::type('array'))->willReturn('');

        $this->beConstructedWith($twig);
    }

    function its_index_action_returns_a_string()
    {
        $this->indexAction()->shouldBeString();
    }

    function its_sign_action_returns_a_string()
    {
        $this->signAction()->shouldBeString();
    }

}
