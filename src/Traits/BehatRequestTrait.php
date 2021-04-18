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

namespace CakephpBehatSuite\Traits;

use Behat\Gherkin\Node\TableNode;

trait BehatRequestTrait
{
    /**
     * @var array
     */
    protected $payload = [];

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
     * @Given I set the payload to:
     *
     * @param string $payload
     */
    public function setPayload(string $payload): void
    {
        $this->payload = $this->jsonDecodeToArray($payload);
    }

    /**
     * @Given I post :url with payload:
     *
     * @param string    $url
     * @param array|TableNode     $payload
     * @return void
     */
    public function postUrlWithData(string $url, $payload): void
    {
        if ($payload instanceof TableNode) {
            $payload = $this->processTableNode($payload);
        }

        $this->post($url, $payload);
    }

    /**
     * @Given I post :url
     *
     * @param string    $url
     * @return void
     */
    public function postUrl(string $url): void
    {
        $this->postUrlWithData($url, $this->payload);
    }

    /**
     * @Given I put :url with data:
     *
     * @param string    $url
     * @param array|TableNode     $data
     * @return void
     */
    public function putUrlWithData(string $url, $data): void
    {
        if ($data instanceof TableNode) {
            $data = $this->processTableNode($data);
        }

        $this->put($url, $data);
    }

    /**
     * @Given I put :url
     *
     * @param string    $url
     * @return void
     */
    public function putUrl(string $url): void
    {
        $this->putUrlWithData($url, []);
    }

    /**
     * @Given I delete :url
     *
     * @param string    $url
     * @return void
     */
    public function deleteUrl(string $url): void
    {
        $this->enableSecurityToken();

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
}
