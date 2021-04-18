Feature: Users add

  Background:
    Given I am a user with a UsersGroups.Permissions name Users
    And I log in

  Scenario:
    When I get 'users/add'
    Then the response is successful

  Scenario:
    When I post 'users/add' with payload:
      | username  | email          | password |
      | foo       | foo@foo.foo    | 1234     |
    Then this users exist:
      | username  | email          |
      | foo       | foo@foo.foo    |
      | foo       | foo@foo.foo    |
    And I am redirected to 'users'
    And the flash message shows 'The user has been saved.'
