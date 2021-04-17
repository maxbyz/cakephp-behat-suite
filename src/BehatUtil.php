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

namespace CakephpBehatSuite;

use Behat\Gherkin\Node\TableNode;

class BehatUtil
{
    /**
     * If only one entry is provided, it returns that first entry only
     *
     * @param TableNode $table
     *
     * @return array
     */
    public static function processTableNode(TableNode $table): array
    {
        $data = $table->getColumnsHash();
        if (count($data) === 1) {
            return $data[0];
        } else {
            return $data;
        }
    }

    /**
     * Convert words in 1, if they match a certain pattern
     *
     * @param int|string $n
     *
     * @return int
     */
    public static function processN($n): int
    {
        if (is_string($n)) {
            if (in_array($n, [
                'a', 'an', 'the', 'this', 'that', 'some',
            ])) {
                $n = 1;
            } else {
                $n = (int) $n;
            }
        }
        return $n;
    }
}
