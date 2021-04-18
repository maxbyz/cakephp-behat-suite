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

use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

trait BehatRequestTrait
{
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
     * @Given I post :url with payload
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
     * Convert the payload to an array
     *
     * @param string    $url
     * @param PyStringNode|TableNode $payload
     * @return void
     */
    protected function payloadToArray($payload): array
    {
        if ($payload instanceof TableNode) {
            $payload = $this->tableNodeToArray($payload);
        } elseif ($payload instanceof PyStringNode) {
            $payload = $this->jsonDecodeToArray($payload->getRaw());
        } else {
            throw new \Exception("Unknown payload type :" . get_class($payload));
        }

        return $payload;
    }
}
