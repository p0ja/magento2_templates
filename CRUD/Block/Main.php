<?php

namespace M2\CRUD\Block;

use M2\CRUD\Model\ItemFactory;
use M2\CRUD\Model\ItemRepository;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Psr\Log\LoggerInterface;

class Main extends Template
{
    /**
     * @param Context $context
     * @param ItemFactory $itemFactory
     * @param ItemRepository $itemRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        protected Context $context,
        private readonly ItemFactory $itemFactory,
        private readonly ItemRepository $itemRepository,
        private readonly LoggerInterface $logger,
    ) {
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $item = $this->itemFactory->create();
        $item->setData('item_text', 'Finish my Magento article');

        try {
            $this->itemRepository->save($item);
        } catch (CouldNotSaveException $e) {
            $this->logger->critical('Problem saving item: ' . $e->getMessage());
        }

        $collection = $item->getCollection();

        foreach ($collection as $item) {
            var_dump('Item ID: ' . $item->getId());
            var_dump($item->getData());
        }
    }
}
