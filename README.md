CakePHP Behat Suite
==============
	      ____                  __          ____
	     / __ \____  _____ ____/ /_  ____  / / /_
	    / /_/ / __ `/ ___/ ___/ __ \/ __ \/ / __/
	   / ____/ /_/ (__  |__  ) /_/ / /_/ / / /_
	  /_/    \__,_/____/____/_.___/\____/_/\__/

	The open source password manager for teams
	(c) 2021 Passbolt SA

License
==============

Passbolt - Open source password manager for teams

(c) 2021 Passbolt SA

This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General
Public License (AGPL) as published by the Free Software Foundation version 3.

The name "Passbolt" is a registered trademark of Passbolt SA, and Passbolt SA hereby declines to grant a trademark
license to "Passbolt" pursuant to the GNU Affero General Public License version 3 Section 7(e), without a separate
agreement with Passbolt SA.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License along with this program. If not,
see [GNU Affero General Public License v3](http://www.gnu.org/licenses/agpl-3.0.html).

Images and logos in /src/img/third_party belongs to their respective owner.

About
=========

This is CakePHP adapter for the well-known Behat test suite, dedicated to behavioral driven testing.

Credits
=========

https://www.passbolt.com/credits

Juan Pablo Ramirez `&&` Nicolas Masson

Install
=========

For CakePHP ^4.0:
```
composer require --dev passbolt/cakephp-behat-suite "^0.2"
```

For CakePHP ^3.8:
```
composer require --dev passbolt/cakephp-behat-suite "^0.1"
```

Copy this file in the main directory of your app, under the name `behat.yml:
```
#behat.yml
default:
  autoload:
    '': '%paths.base%/tests/Behat'
  suites:
    app:
      paths:
        - '%paths.base%/tests/Behat/features'
      contexts:
        - CakephpBehatSuite\Context\BootstrapContext:
            bootstrap: '%paths.base%/tests/bootstrap.php'
        - Context\AppContext
```

The `behat.yml` file is the equivalent to the PHPUnit's `phpunit.xml` file. `%paths.base%` points to your main directory.

Once your `behat.yml` file has been created, run `vendor/bin/behat --init` to automatically create the folders and Context
classes as defined in the config file.

You can define more suites additional to app, for example for your plugins.

IMPORTANT: the `CakephpBehatSuite\Context\BootstrapContext` should be present in each of your suites.
The argument `bootstrap:` should direct to the `bootstrap.php` file of your tests.
 
For each suite, you will have to specify the location of your features under the key `path`. 

The package provides a set of steps defined by `CakephpBehatSuite\Context\BootstrapContext`.

How to use the suite?
=============================

## Run your tests
The command `vendor/bin/behat` will run your tests as defined in the `behat.yml file.

## Fixture factories
The package makes uses of the CakePHP fixture factories plugin. Make sure your factories are
baked and working, in order to use the present package.

You will find the package and its documentation [here](https://github.com/vierge-noire/cakephp-fixture-factories).

## The BootstrapContext class
The `CakephpBehatSuite\Context\BootstrapContext` contains a set of steps, documented below.

The Context will ensure that the test database gets emptied before each scenario.

## Example
### Feature
This is how an integration on the edit action of your UsersController could be: 
```
Feature: Users edit

  Background:
    Given I create 1 user with id 1
    And I am a user with a UsersGroups.Permissions name Users
    And I log in

  Scenario:
    When I get 'users/edit/1'
    Then the response is OK

# Edit a non existent user
  Scenario:
    When I get 'users/edit/2'
    Then the response triggers an error
    
# Edit an existing user
  Scenario:
    When I post 'users/edit/1' with data:
      | username  | email          |
      | foo       | foo@foo.foo    |
    Then I am redirected to 'users'
    And this user exists:
      | id  | username  | email          |
      | 1   | foo       | foo@foo.foo    |

```

### behat.yml with plugin

This behat file includes a suite for a dummy plugin MyCustomPlugin. For each suite, a Context has been added too.

```
#behat.yml
default:
  autoload:
    '': '%paths.base%/tests/Behat'
  suites:
    app:
      paths:
        - '%paths.base%/tests/Behat/features'
      contexts:
        - CakephpBehatSuite\Context\BootstrapContext:
            bootstrap: '%paths.base%/tests/bootstrap.php'
        - Context\AppContext
    my-custom-plugin:
      paths:
        - '%paths.base%/plugins/MyCustomPlugin/tests/Behat/features'
      contexts:
        - CakephpBehatSuite\Context\BootstrapContext:
            bootstrap: '%paths.base%/tests/bootstrap.php'
        - Context\TestPluginContext
```

## Use Migrations

Take full advantage of the [Phinx migrations](https://book.cakephp.org/migrations/3/en/index.html) in order to maintain the schema
of your test DB. This is optional, but __highly recommended__.

The [CakePHP Test Migrator package](https://github.com/vierge-noire/cakephp-test-migrator) will assist you in doing this very simply.
