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
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use PHPUnit\Framework\Assert;

trait BehatTableRegistryTrait
{
    /**
     * @var EntityInterface
     */
    public $entity;

    /**
     * @param string $table
     *
     * @return Table
     */
    public function getTable(string $table): Table
    {
        return TableRegistry::getTableLocator()->get(
            ucfirst(Inflector::pluralize($table))
        );
    }

    /**
     * @Then this :model exists:
     *
     * @param string    $model
     * @param TableNode $data
     * @return void
     */
    public function thisModelExists(string $model, TableNode $data): void
    {
        $data = $this->tableNodeToArray($data);
        Assert::assertTrue($this->getTable($model)->exists($data), "The {$model} could not be found.");
    }

    /**
     * @Then the table registry :model has:
     *
     * @param string    $model
     * @param TableNode $data
     * @return void
     */
    public function theTableRegistryHas(string $model, TableNode $data): void
    {
        $data = $this->tableNodeToArray($data);
        Assert::assertTrue(
            TableRegistry::getTableLocator()->get($model)->exists($data),
            "The {$model} could not be found."
        );
    }

    /**
     * @Then the :model with id :id exists
     *
     * @param string    $model
     * @param int       $id
     * @return void
     */
    public function theModelWithIdExists(string $model, int $id): void
    {
        Assert::assertTrue(
            $this->getTable($model)->exists(compact('id')),
            "The {$model} could not be found."
        );
    }

    /**
     * @Then the :model with id :id does not exist
     *
     * @param string    $model
     * @param int       $id
     * @return void
     */
    public function theModelWithIdDoesNotExists(string $model, int $id): void
    {
        Assert::assertFalse($this->getTable($model)->exists(compact('id')));
    }
}
