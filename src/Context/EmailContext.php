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

use Cake\Mailer\TransportFactory;
use Cake\Mailer\TransportRegistry;
use Cake\TestSuite\EmailTrait;

class EmailContext extends BaseContext
{
    use EmailTrait;

    /**
     * @Then the mail contains :string
     *
     * @param string $string The command to run
     */
    public function mailContains(string $string)
    {
        $this->assertMailContains($string);
    }

    /**
     * @Then :n mail/mails is/are sent
     *
     * @param int $n number of mails sent
     */
    public function nMailsSent(int $n)
    {
        $this->assertMailCount($n);
    }

    /**
     * @Then a mail from :from is sent
     *
     * @param string $from From
     */
    public function mailSentFrom(string $from)
    {
        $this->assertMailSentFrom($from);
    }

    /**
     * @Then a mail to :to is sent
     *
     * @param string $to From
     */
    public function mailSentTo(string $to)
    {
        $this->assertMailSentTo($to);
    }

    /**
     * @Then a mail with subject containing :subject is sent
     *
     * @param string $to From
     */
    public function mailSubjectContains(string $subject)
    {
        $this->assertMailSubjectContains($subject);
    }
}
