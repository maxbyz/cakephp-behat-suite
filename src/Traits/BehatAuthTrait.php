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
use CakephpFixtureFactories\Factory\BaseFactory;
use Exception;

trait BehatAuthTrait
{
    /**
     * @var EntityInterface|array $user
     */
    protected $user;

    /**
     * @Given I am a/an :model
     *
     * @param string $model
     * @return void
     * @throws Exception
     */
    public function iAmModel(string $model): void
    {
        $this->user = $this->iCreateModel(1, $model);
    }

    /**
     * @Given I am a/an :model with :field :value
     *
     * @param string $model
     * @param string $field
     * @param string|int $value
     * @return void
     * @throws Exception
     */
    public function iAmModelWithField(string $model, string $field, $value): void
    {
        $this->user = $this->iCreateModelWithField(1, $model, $field, $value);
    }

    /**
     * @Given I am a/an :model :
     *
     * @param string $modelName
     * @param TableNode  $data
     * @return void
     * @throws Exception
     */
    public function iAmModelWithData(string $modelName, TableNode $data): void
    {
        $this->user = $this->iCreateModelWithData(1, $modelName, $data);
    }

    /**
     * @Given I am a/an :modelName with :m :associationPath :field :value
     *
     * @param string $modelName
     * @param int|string  $m
     * @param string $associationPath
     * @param string $field
     * @param string|int $value
     * @return void
     * @throws Exception
     */
    public function iAmModelWithAssociatedField(string $modelName, $m, string $associationPath, string $field, $value): void
    {
        $this->user = $this->iCreateModelWithAssociatedField(1, $modelName, $m, $associationPath, $field, $value);
    }

    /**
     * @Given I am a/an :modelName with :associationPath :
     *
     * @param string $modelName
     * @param int|string  $m
     * @param string $associationPath
     * @param TableNode $data
     * @return void
     * @throws Exception
     */
    public function iAmModelWithAssociatedData(string $modelName, $m, string $associationPath, TableNode $data): void
    {
        $this->user = $this->iCreateModelWithAssociatedData(1, $modelName, $associationPath, $data);
    }

    /**
     * Helper function to create users from a factory instance
     *
     * @param BaseFactory $factory
     * @throws Exception
     */
    protected function iAmAFactory(BaseFactory $factory): void
    {
        $this->user = $factory->setTimes(1)->persist();
    }

    /**
     * @Given I log in
     *
     * @return void
     * @throws Exception
     */
    public function logIn(): void
    {
        if (!isset($this->user)) {
            throw new Exception('You should define who you are before you log in.');
        }
        if ($this->user instanceof EntityInterface) {
            $user = $this->user->toArray();
        } else {
            $user = $this->user;
        }

        $this->session(['Auth' =>  $user]);
    }

    /**
     * @Given I log in as :model with id :id
     *
     * @param string $model
     * @param int $id
     * @return void
     * @throws Exception
     */
    public function logInWithId(string $model, int $id): void
    {
        $this->user = $this->getTable($model)->get($id);

        $this->logIn();
    }
}
