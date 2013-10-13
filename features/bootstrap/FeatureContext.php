<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\MinkExtension\Context\MinkContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Doctrine\DBAL\DriverManager;

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
     * @When /^I sign a petition as "([^"]*)"$/
     */
    public function iSignAPetitionAs($name)
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
        $config = new \Doctrine\DBAL\Configuration();
        $connectionParams = array(
            'driver'   => 'pdo_sqlite',
            'path'     => __DIR__.'/../../res/app.db',
        );
        /* @var $conn \Doctrine\DBAL\Connection */
        $conn = DriverManager::getConnection($connectionParams, $config);

        $conn->executeQuery("DROP TABLE IF EXISTS `signers`");
        $conn->executeQuery("CREATE TABLE `signers` (`name` TEXT NOT NULL)");

        foreach ($table->getHash() as $row) {
            $conn->insert('signers', $row);
        }

        $numberOfSigners = $conn->fetchColumn("SELECT COUNT(1) AS `count` FROM `signers`");
        if (2 != $numberOfSigners) {
            throw new \RuntimeException("Expected to find two signers, but {$numberOfSigners} found.");
        }
    }

    /**
     * @Then /^I should see these signers:$/
     */
    public function iShouldSeeTheseSigners(TableNode $table)
    {
        foreach ($table->getHash() as $row) {
            $this->assertPageContainsText($row['name']);
        }
    }
}
