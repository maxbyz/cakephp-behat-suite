Feature: Users authentication

  Background:
   Given I create 1 user with id 1

#  User with correct permission
  Scenario:
    Given I am a user with a UsersGroups.Permissions name Users
    And I log in
    When I get 'users/view/1'
    Then the response is successful

#  User with correct permission on non existing entity
  Scenario:
    Given I am a user with a UsersGroups.Permissions name Users
    And I log in
    When I get 'users/view/2'
    Then the response triggers an error

#  User without permission
  Scenario:
    Given I am a user
    And I log in
    When I get 'users/view/1'
    Then I am redirected to 'home'
