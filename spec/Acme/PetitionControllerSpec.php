<?php

namespace spec\Acme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PetitionControllerSpec extends ObjectBehavior
{
    function let(\Twig_Environment $twig, \Doctrine\DBAL\Connection $conn)
    {
        $twig->render(Argument::any(), Argument::any())->willReturn('');

        $this->beConstructedWith($twig, $conn);
    }

    function its_index_action_returns_a_string()
    {
        $this->indexAction()->shouldBeString();
    }

    function its_sign_action_redirects_to_thankyou_page_on_success()
    {
        $response = $this->signAction('Chuck Norris');
        $response->shouldHaveType('\Symfony\Component\HttpFoundation\RedirectResponse');
        $response->getTargetUrl()->shouldBe('/thankyou');
    }

    function its_sign_action_adds_signer_to_database(\Doctrine\DBAL\Connection $conn)
    {
        $conn->insert('signers', Argument::type('array'))->shouldBeCalled();
        $this->signAction('Chuck Norris');
    }

    function its_thankyou_action_fetches_all_signers(\Doctrine\DBAL\Connection $conn)
    {
        $conn->fetchAll(Argument::type('string'))->shouldBeCalled();
        $this->thankyouAction();
    }

    function its_sign_action_redirects_to_error_page_when_empty_name_is_supplied()
    {
        $response = $this->signAction('');
        $response->shouldHaveType('\Symfony\Component\HttpFoundation\RedirectResponse');
        $response->getTargetUrl()->shouldBe('/error');
    }

    function its_error_action_returns_a_string()
    {
        $this->errorAction()->shouldBeString();
    }

}
