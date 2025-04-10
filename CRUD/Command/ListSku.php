<?php

namespace M2\CRUD\Command;

use M2\CRUD\Services\GetFilteredProductList;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ListSku extends Command
{
    private const ARG_SKU_PART = 'skuLike';

    /**
     * @throws LocalizedException
     */
    public function __construct(
        private readonly GetFilteredProductList $getFilteredProductList,
        string $name = null
    ) {
        parent::__construct($name);
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName("vendor:search:items");
        $this->setDescription("A command the programmer was too lazy to enter a description for.");
        $this->addArgument(
            self::ARG_SKU_PART,
            InputArgument::REQUIRED,
            'SKU part to search for'
        );

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $skuPart = $input->getArgument(self::ARG_SKU_PART);
        $itemList = $this->getFilteredProductList->execute($skuPart);

        foreach ($itemList as $item) {
            echo '[' . $item->getItemsSku() . '] ' . $item->getTitle(), "\n";
        }

        return Command::SUCCESS;
    }
}
