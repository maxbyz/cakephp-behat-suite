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
use CakephpBehatSuite\Traits\BehatFixtureFactoriesTrait;
use Exception;

class FixtureFactoriesContext extends BaseContext
{
    use BehatFixtureFactoriesTrait;

    /**
     * @Given I create :n :modelName with :field :value
     *
     * @param int|string $n
     * @param string $modelName
     * @param string  $field
     * @param int|string  $value
     * @return void
     * @throws Exception
     */
    public function iCreateModelWithField($n, string $modelName, string $field, $value): void
    {
        $this->createModelWithField($n, $modelName, $field, $value);
    }

    /**
     * @Given I create :n :modelName
     *
     * @param int|string    $n
     * @param string $modelName
     * @param PyStringNode|TableNode|null  $data
     * @return  EntityInterface | EntityInterface[]
     * @throws Exception
     */
    public function iCreateModelWithData($n, string $modelName, $data = null)
    {
        return $this->createModelWithData($n, $modelName, $data);
    }

    /**
     * @Given I create :n :modelName with :m :associationPath :field :value
     *
     * @param int|string    $n
     * @param string $modelName
     * @param int|string  $m
     * @param string $associationPath
     * @param string $field
     * @param string|int $value
     * @return  EntityInterface | EntityInterface[]
     */
    public function iCreateModelWithAssociatedField($n, string $modelName, $m, string $associationPath, string $field, $value)
    {
        return $this->createModelWithAssociatedField($n, $modelName, $m, $associationPath, $field, $value);
    }

    /**
     * @Given I create :n :modelName with :associationPath
     *
     * @param int|string    $n
     * @param string $modelName
     * @param string $associationPath
     * @param PyStringNode|TableNode|null $data
     * @return  EntityInterface | EntityInterface[]
     */
    public function iCreateModelWithAssociatedData($n, string $modelName, string $associationPath, $data = null)
    {
        return $this->createModelWithAssociatedData($n, $modelName, $associationPath, $data);
    }
}
