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

trait BehatResponseTrait
{
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
