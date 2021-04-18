<?php
namespace TestApp\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Mailer\Mailer;
use Cake\Mailer\Transport\DebugTransport;

class SendEmailCommand extends Command
{
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser->addOption('recipient', [
            'help' => 'Recipient.',
            'short' => 'r',
            'required' => true
        ]);
        $parser->addOption('from', [
            'help' => 'From.',
            'short' => 'f',
            'required' => true
        ]);
        $parser->addOption('subject', [
            'help' => 'Subject.',
            'short' => 's',
            'required' => true
        ]);

        return $parser;
    }

    public function execute(Arguments $args, ConsoleIo $io): ?int
    {
        $recipient = $args->getOption('recipient');
        $from = $args->getOption('from');
        $subject = $args->getOption('subject');

        $Email = new Mailer();
        $Email
            ->setTransport(new DebugTransport())
            ->setFrom($from)
            ->setTo($recipient)
            ->setSubject($subject)
            ->send();

        $io->success("Message successfully sent to " . $recipient);

        return self::CODE_SUCCESS;
    }
}
