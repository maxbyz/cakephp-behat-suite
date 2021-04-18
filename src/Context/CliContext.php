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

use Cake\TestSuite\ConsoleIntegrationTestTrait;

class CliContext extends BaseContext
{
    use ConsoleIntegrationTestTrait;

    /** @BeforeScenario */
    public function beforeScenario(): void
    {
        $this->useCommandRunner();
    }

    /**
     * @When I run command :cmd
     *
     * @param string $cmd The command to run
     */
    public function runCommand(string $cmd)
    {
        $this->exec($cmd);
    }

    /**
     * @Then the exit code is :n
     */
    public function theExitCodeIs(int $n)
    {
        $this->assertExitCode($n);
    }

    /**
     * @Then the output contains :output
     */
    public function theOutputContains(string $ouput)
    {
        $this->assertOutputContains($ouput);
    }
}
