Feature: Pages display

  Scenario:
    When I get '/'
    Then the response is successful

  Scenario:
    When I get '/pages/home'
    Then the response is successful

  Scenario:
    When I get 'pages/foo'
    Then the response fails
