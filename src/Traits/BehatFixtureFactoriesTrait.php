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

use Cake\ORM\Table;
use Cake\Utility\Inflector;
use CakephpFixtureFactories\Factory\FactoryAwareTrait;

trait BehatFixtureFactoriesTrait
{
    use BehatUtilTrait;
    use FactoryAwareTrait;

    public function createModelWithField($n, string $modelName, string $field, $value)
    {
        return $this->getFactory($modelName)
            ->patchData([$field => $value])
            ->setTimes($this->processN($n))
            ->persist();
    }

    public function createModelWithData($n, string $modelName, $data = null)
    {
        $factory = $this->getFactory($modelName)->setTimes($this->processN($n));

        if ($data !== null) {
            $factory->patchData($this->payloadToArray($data));
        }

        return $factory->persist();
    }

    public function createModelWithAssociatedField($n, string $modelName, $m, string $associationPath, string $field, $value)
    {
        $m = $this->processN($m);
        return $this->getFactory($modelName)
            ->setTimes($this->processN($n))
            ->with($associationPath."[$m]", [$field => $value])
            ->persist();
    }

    public function createModelWithAssociatedData($n, string $modelName, string $associationPath, $data = null)
    {
        $data = $this->payloadToArray($data);

        return $this->getFactory($modelName)
            ->setTimes($this->processN($n))
            ->with($associationPath, $data)
            ->persist();
    }

    /**
     * @param string $table
     *
     * @return Table
     */
    public function getTable(string $table): Table
    {
        return $this->getFactory(ucfirst(Inflector::pluralize($table)))->getRootTableRegistry();
    }
}
