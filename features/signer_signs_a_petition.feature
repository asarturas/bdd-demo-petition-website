Feature: Signer signs a petition
  A a concerned citizen
  In order to express my support towards initiative, which I like
  I want to sign a petition on internet

  Background:
    And the following petitions exist:
      | code | name                    | description                                         |
      | DNT1 | Ban Doughnuts | Doughnuts should be banned, because they are too fascinating. |

  Scenario: view a petition
    Given I am on homepage
    When I select "MOTO1" petition
    Then I see "Doughnuts should be banned, because they are too fascinating."

  Scenario: sign a petition
    Given I am on "DNT1" petition page
    When I sign petition as "Chuck Norris"
    Then I see "Thank you for your support."

  Scenario: view signers on petition page
    Given I am "MOTO1" petition page
    And the following people already signed petition "DNT1":
      | name               |
      | Bruce Willis       |
      | Sylvester Stallone |
    When I sign a petition as "Chuck Norris"
    Then I see "Chuck Norris" in signers list
