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
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use CakephpBehatSuite\Traits\BehatFixtureFactoriesTrait;
use CakephpBehatSuite\Traits\BehatTableRegistryTrait;
use CakephpBehatSuite\Traits\BehatUtil;
use CakephpBehatSuite\Traits\BehatUtilTrait;

abstract class BaseContext extends TestCase implements Context
{
    use BehatUtilTrait;
}
