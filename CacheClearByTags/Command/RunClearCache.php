<?php

declare(strict_types=1);

namespace Vendor\CacheClearByTags\Command;

use Vendor\CacheClearByTags\Service\Process5minTags;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunClearCache extends Command
{
    /**
     * @param Process5minTags $process5minTags
     */
    public function __construct(
        private readonly Process5minTags $process5minTags
    ) {
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        parent::configure();

        $this->setName('vendor:cache:clear');
        $this->setDescription('Clears cache by tags.');
    }

    /**
     * @inheritDoc
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->process5minTags->cleanCacheByTag();
        } catch (Exception $e) {
            $msg = sprintf('Error running command: %s', $e->getMessage());
            $output->writeln($msg);
        }

        return Command::SUCCESS;
    }
}
