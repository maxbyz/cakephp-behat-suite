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

use Behat\Behat\Context\Context;
use Cake\Event\EventManager;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use CakephpTestSuiteLight\FixtureInjector;
use CakephpTestSuiteLight\FixtureManager;

final class BootstrapContext extends TestCase implements Context
{
    /**
     * @var FixtureInjector $fixtureInjector
     */
    protected $fixtureInjector;

    /**
     * BootstrapContext constructor.
     *
     * @param string $bootstrap
     */
    public function __construct(string $bootstrap)
    {
        require_once $bootstrap;
        $this->fixtureInjector = new FixtureInjector(new FixtureManager());
    }

    /** @BeforeScenario */
    public function beforeScenario(): void
    {
        $this->fixtureInjector->startTest($this);

        TableRegistry::getTableLocator()->clear();
        $this->clearPlugins();
        EventManager::instance(new EventManager());
    }
}
