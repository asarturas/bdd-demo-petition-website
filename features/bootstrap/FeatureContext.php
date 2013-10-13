<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\MinkExtension\Context\MinkContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    public function iAmOnHomepage()
    {
        $this->getSession()->visit($this->locatePath('/'));

        if ($this->getSession()->getStatusCode() != 200) {
            throw new \RuntimeException("Expected status code 200, but received {$this->getSession()->getStatusCode()}");
        }
    }

    /**
     * @Given /^I should see signing form$/
     */
    public function iShouldSeeSigningForm()
    {
        $form = $this->getSession()->getPage()->find('css', 'form.petition');

        if (!$form) {
            throw new \RuntimeException("Could not find petition form");
        }
    }

    /**
     * @When /^I sign petition as "([^"]*)"$/
     */
    public function iSignPetitionAs($name)
    {
        $page = $this->getSession()->getPage();

        $page->fillField('name', $name);
        $page->pressButton('Sign');
    }

    /**
     * @Given /^the following people already signed petition:$/
     */
    public function theFollowingPeopleAlreadySignedPetition(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @When /^I sign a petition as "([^"]*)"$/
     */
    public function iSignAPetitionAs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should see "([^"]*)" in the signers list$/
     */
    public function iShouldSeeInTheSignersList($arg1)
    {
        throw new PendingException();
    }
}
