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
use Cake\ORM\TableRegistry;
use CakephpBehatSuite\Traits\BehatFixtureFactoriesTrait;
use PHPUnit\Framework\Assert;

class DatabaseContext extends BaseContext
{
    use BehatFixtureFactoriesTrait;

    /**
     * @Then this :model exists/exist:
     *
     * @param string    $model
     * @param PyStringNode|TableNode $data
     * @return void
     */
    public function thisModelExists(string $model, $data): void
    {
        $data = $this->payloadToArray($data);
        if (!isset($data[0])) {
            $data = [$data];
        }
        foreach ($data as $conditions) {
            Assert::assertTrue(
                $this->getTable($model)->exists($conditions),
                "The {$model} with data " . implode(', ', $conditions) . " could not be found."
            );
        }
    }

    /**
     * @Then this :model does/do not exist:
     *
     * @param string    $model
     * @param PyStringNode|TableNode $data
     * @return void
     */
    public function thisModelDoesNotExists(string $model, $data): void
    {
        $data = $this->payloadToArray($data);
        if (!isset($data[0])) {
            $data = [$data];
        }
        foreach ($data as $conditions) {
            Assert::assertFalse(
                $this->getTable($model)->exists($conditions),
                "The {$model} with data " . implode(', ', $conditions) . " could be found."
            );
        }
    }

    /**
     * @Then the table registry :model has entry/entries:
     *
     * @param string    $model
     * @param PyStringNode|TableNode $data
     * @return void
     */
    public function theTableRegistryHas(string $model, $data): void
    {
        $data = $this->payloadToArray($data);
        if (!isset($data[0])) {
            $data = [$data];
        }
        foreach ($data as $conditions) {
            Assert::assertTrue(
                TableRegistry::getTableLocator()->get($model)->exists($conditions),
                "The {$model} could not be found."
            );
        }
    }

    /**
     * @Then the table registry :model does not have entry/entries:
     *
     * @param string    $model
     * @param PyStringNode|TableNode $data
     * @return void
     */
    public function theTableRegistryHasNot(string $model, $data): void
    {
        $data = $this->payloadToArray($data);
        if (!isset($data[0])) {
            $data = [$data];
        }
        foreach ($data as $conditions) {
            Assert::assertFalse(
                TableRegistry::getTableLocator()->get($model)->exists($conditions),
                "The {$model} could be found."
            );
        }
    }

    /**
     * @Then the :model with :field :value exists
     *
     * @param string    $model
     * @param string       $field
     * @param int|string   $value
     * @return void
     */
    public function theModelWithFieldExists(string $model, string $field, $value): void
    {
        Assert::assertTrue(
            $this->getTable($model)->exists([$field => $value]),
            "The {$model} could not be found."
        );
    }

    /**
     * @Then the :model with :field :value does not exist
     *
     * @param string    $model
     * @param string       $field
     * @param int|string   $value
     * @return void
     */
    public function theModelWithFieldDoesNotExists(string $model, string $field, $value): void
    {
        Assert::assertFalse(
            $this->getTable($model)->exists([$field => $value]),
            "The {$model} could be found."
        );
    }
}
