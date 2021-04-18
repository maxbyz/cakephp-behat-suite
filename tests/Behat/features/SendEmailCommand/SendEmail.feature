Feature: Send email via the CLI

  Scenario: Send an email with no argument
    When I run command 'send_email'
    Then the exit code is 1

  Scenario: Send an email with missing recipient
    When I run command 'send_email -f me@test.test'
    Then the exit code is 1

  Scenario: Send an email with all required options
    When I run command 'send_email -f me@test.test -r you@test.test -s test'
    Then the exit code is 0
    And the output contains 'Message successfully sent to you@test.test'
    And a mail from 'me@test.test' is sent
    And a mail to 'you@test.test' is sent
    And a mail with subject containing 'test' is sent
