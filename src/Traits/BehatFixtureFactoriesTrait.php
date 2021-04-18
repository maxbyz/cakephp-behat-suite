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
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use CakephpFixtureFactories\Factory\FactoryAwareTrait;
use Exception;

trait BehatFixtureFactoriesTrait
{
    use FactoryAwareTrait;

    /**
     * @Given I create :n :model
     *
     * @param int|string $n
     * @param string $model
     * @return array|EntityInterface|EntityInterface[]|ResultSetInterface|false|null
     * @throws Exception
     */
    public function iCreateModel($n, string $model)
    {
        return $this->getFactory($model)
            ->setTimes($this->processN($n))
            ->persist();
    }

    /**
     * @Given I create :n :modelName with :field :value
     *
     * @param int|string $n
     * @param string $modelName
     * @param string  $field
     * @param int|string  $value
     * @return array|EntityInterface|EntityInterface[]|ResultSetInterface|false|null
     * @throws Exception
     */
    public function iCreateModelWithField($n, string $modelName, string $field, $value)
    {
        return $this->getFactory($modelName)
            ->patchData([$field => $value])
            ->setTimes($this->processN($n))
            ->persist();
    }

    /**
     * @Given I create :n :modelName :
     *
     * @param int|string    $n
     * @param string $modelName
     * @param TableNode  $data
     * @return array|EntityInterface|EntityInterface[]|ResultSetInterface|false|null
     * @throws Exception
     */
    public function iCreateModelWithData($n, string $modelName, TableNode $data)
    {
        return $this->getFactory($modelName)
            ->patchData($this->processTableNode($data))
            ->setTimes($this->processN($n))
            ->persist();
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
     * @return array|EntityInterface|EntityInterface[]|ResultSetInterface|false|null
     */
    public function iCreateModelWithAssociatedField($n, string $modelName, $m, string $associationPath, string $field, $value)
    {
        $m = $this->processN($m);
        return $this->getFactory($modelName)
            ->setTimes($this->processN($n))
            ->with($associationPath."[$m]", [$field => $value])
            ->persist();
    }

    /**
     * @Given I create :n :modelName with :associationPath :
     *
     * @param int|string    $n
     * @param string $modelName
     * @param string $associationPath
     * @param TableNode $data
     * @return array|EntityInterface|EntityInterface[]|ResultSetInterface|false|null
     */
    public function iCreateModelWithAssociatedData($n, string $modelName, string $associationPath, TableNode $data)
    {
        $data = $this->processTableNode($data);

        return $this->getFactory($modelName)
            ->setTimes($this->processN($n))
            ->with($associationPath, $data)
            ->persist();
    }
}
