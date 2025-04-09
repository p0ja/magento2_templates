<?php

namespace M2\CliEmail\Console;

use M2\CliEmail\Service\SendEmail;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendEmailCommand extends Command
{
    private const NAME = 'name';

    /**
     * @param SendEmail $helper
     */
    public function __construct(
        private readonly SendEmail $helper,
    ) {
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $options = [
            new InputOption(
                self::NAME,
                null,
                InputOption::VALUE_OPTIONAL,
                'Name'
            )
        ];

        $this->setName('vendor:send-email');
        $this->setDescription('Send email command');
        $this->setDefinition($options);

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getOption(self::NAME);
        $this->helper->sendMail($name);

        return Command::SUCCESS;
    }
}
