<?php

namespace App\Command;

use App\Message\BoomMessage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Transport\AmqpExt\AmqpStamp;

class EventTestCommand extends Command
{
    protected static $defaultName = 'app:event:test';
    
    private $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        parent::__construct(self::$defaultName);
        $this->messageBus = $messageBus;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $this->messageBus->dispatch(new BoomMessage('this is a boom message'), [new AmqpStamp('spotahome.booking_was_created')]);
        
        $io->success('You sent the message to the transport!');

        return 0;
    }
}
