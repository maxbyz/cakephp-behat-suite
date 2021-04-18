<?php
declare(strict_types=1);

/**
 * Passbolt ~ Open source password manager for teams
 * Copyright (c) Passbolt SA (https://www.passbolt.com)
 *
 * Licensed under GNU Affero General Public License version 3 of the or any later version.
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Passbolt SA (https://www.passbolt.com)
 * @license       https://opensource.org/licenses/AGPL-3.0 AGPL License
 * @link          https://www.passbolt.com Passbolt(tm)
 * @since         1.0.0
 */

namespace CakephpBehatSuite\Context;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Cake\Datasource\EntityInterface;
use Cake\TestSuite\IntegrationTestTrait;
use CakephpBehatSuite\Traits\BehatFixtureFactoriesTrait;
use Exception;

class HttpRequestContext extends BaseContext
{
    use BehatFixtureFactoriesTrait;
    use IntegrationTestTrait;

    /**
     * @var EntityInterface|array $user
     */
    protected $user;

    /** @BeforeScenario */
    public function beforeScenario(): void
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
    }

    /**
     * @Given I am a/an :model with :field :value
     *
     * @param string $model
     * @param string $field
     * @param string|int $value
     * @return void
     * @throws \Exception
     */
    public function iAmModelWithField(string $model, string $field, $value): void
    {
        $this->user = $this->createModelWithField(1, $model, $field, $value);
    }

    /**
     * @Given I am a/an :model
     *
     * @param string $modelName
     * @param PyStringNode|TableNode|null $data
     * @return void
     * @throws Exception
     */
    public function iAmModelWithData(string $modelName, $data = null): void
    {
        $this->user = $this->createModelWithData(1, $modelName, $data);
    }

    /**
     * @Given I am a/an :modelName with :m :associationPath :field :value
     *
     * @param string $modelName
     * @param int|string  $m
     * @param string $associationPath
     * @param string $field
     * @param string|int $value
     * @return void
     * @throws Exception
     */
    public function iAmModelWithAssociatedField(string $modelName, $m, string $associationPath, string $field, $value): void
    {
        $this->user = $this->createModelWithAssociatedField(1, $modelName, $m, $associationPath, $field, $value);
    }

    /**
     * @Given I am a/an :modelName with :associationPath
     *
     * @param string $modelName
     * @param int|string  $m
     * @param string $associationPath
     * @param TableNode $data
     * @return void
     * @throws Exception
     */
    public function iAmModelWithAssociatedData(string $modelName, $m, string $associationPath, TableNode $data): void
    {
        $this->user = $this->createModelWithAssociatedData(1, $modelName, $associationPath, $data);
    }

    /**
     * @Given I log in
     *
     * @return void
     * @throws Exception
     */
    public function logIn(): void
    {
        if (!isset($this->user)) {
            throw new Exception('You should define who you are before you log in.');
        }
        if ($this->user instanceof EntityInterface) {
            $user = $this->user->toArray();
        } else {
            $user = $this->user;
        }

        $this->session(['Auth' =>  $user]);
    }

    /**
     * @Given I log in as :model with id :id
     *
     * @param string $model
     * @param int $id
     * @return void
     * @throws Exception
     */
    public function logInWithId(string $model, int $id): void
    {
        $this->user = $this->getTable($model)->get($id);

        $this->logIn();
    }

    /**
     * @Given I get :url
     *
     * @param string    $url
     * @return void
     */
    public function getUrl(string $url): void
    {
        $this->get($url);
    }

    /**
     * @Given I post :url with payload:
     *
     * @param string    $url
     * @param string|array|TableNode $payload
     * @return void
     */
    public function postUrlWithPayload($url, $payload): void
    {
        $this->post($url, $this->payloadToArray($payload));
    }

    /**
     * @Given I post :url
     *
     * @param string    $url
     * @return void
     */
    public function postUrl(string $url): void
    {
        $this->post($url);
    }

    /**
     * @Given I put :url with payload
     *
     * @param string    $url
     * @param array|TableNode|string     $payload
     * @return void
     */
    public function putUrlWithPayload(string $url, $payload): void
    {
        $this->put($url, $this->payloadToArray($payload));
    }

    /**
     * @Given I put :url
     *
     * @param string    $url
     * @return void
     */
    public function putUrl(string $url): void
    {
        $this->put($url);
    }

    /**
     * @Given I delete :url
     *
     * @param string    $url
     * @return void
     */
    public function deleteUrl(string $url): void
    {
        $this->delete($url);
    }

    /**
     * @Given Csrf token is disabled
     *
     * @return void
     */
    public function csrfTokenIsDisabled(): void
    {
        $this->_csrfToken = false;
    }

    /**
     * @Then the response is successful
     *
     * @return void
     */
    public function theResponseIsOK(): void
    {
        $this->assertResponseOk();
    }

    /**
     * @Then I am redirected
     *
     * @return void
     */
    public function iShallBeRedirected(): void
    {
        $this->assertResponseCode(302);
    }

    /**
     * @Then I am redirected to :string
     *
     * @param string $url
     * @return void
     */
    public function iShallBeRedirectedTo(string $url): void
    {
        $this->assertRedirect($url);
        $this->iShallBeRedirected();
    }

    /**
     * @Then the response fails
     *
     * @return void
     */
    public function theResponseFails(): void
    {
        $this->assertResponseFailure();
    }

    /**
     * @Then I am not authorized
     *
     * @return void
     */
    public function authorizationFails(): void
    {
        $this->assertResponseCode(401);
    }

    /**
     * @Then the response has code :int
     */
    public function theResponseHasCode(int $code): void
    {
        $this->assertResponseCode($code);
    }

    /**
     * @Then the response triggers an error
     *
     * @return void
     */
    public function theResponseTriggersAnError(): void
    {
        $this->assertResponseError();
    }

    /**
     * @Then the response contains :string
     *
     * @param string $string
     * @return void
     */
    public function theResponseContains(string $string): void
    {
        $this->assertResponseContains($string);
    }

    /**
     * @Then the flash message shows :msg
     *
     * @param string $msg
     */
    public function theFlashMessageShows(string $msg): void
    {
        $this->assertFlashMessage($msg);
    }
}
