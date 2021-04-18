<?php
declare(strict_types=1);

/**
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) 2020 Juan Pablo Ramirez and Nicolas Masson
 * @link          https://webrider.de/
 * @since         1.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace CakephpBehatSuite\Test\TestCase;

use Cake\TestSuite\TestCase;
use CakephpBehatSuite\Traits\BehatUtilTrait;
use CakephpTestSuiteLight\SkipTablesTruncation;

class BehatUtilTraitTest extends TestCase
{
    use BehatUtilTrait;

    public function dataProviderForTestProcessN()
    {
        return [
            [1, 1],
            ['a', 1],
            ['an', 1],
            ['the', 1],
            ['this', 1],
            ['that', 1],
            ['some', 1],
            [2, 2],
            [20, 20],
            ['20', 20],
        ];
    }

    /**
     * @dataProvider dataProviderForTestProcessN
     * @param $input
     * @param $expected
     */
    public function testProcessN($input, $expected)
    {
        $this->assertSame($expected, $this->processN($input));
    }
}
