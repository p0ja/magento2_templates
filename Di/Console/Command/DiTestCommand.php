<?php

namespace Vendor\Di\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DiTestCommand extends Command
{
    public function __construct(
        private string $arg1,
        private string $arg2,
        protected ?string $name = null,
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setName('vendor:di');
        $this->setDescription('Sample playground for Vendor_Di module');

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        //Playground code here...
        var_dump($this->arg1);
        var_dump($this->arg2);


        return Command::SUCCESS;
    }
}
