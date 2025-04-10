<?php

declare(strict_types=1);

namespace M2\MVVM\Controller\Controller;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Action implements ActionInterface
{
    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        protected Context $context,
        private readonly PageFactory $pageFactory,
    ) {
    }

    /**
     * In Magento2, each controller has one, and only one, entry point.
     * That’s the execute method
     * https://magento.example/m2_mvvm/controller/action/
     */
    public function execute(): ResultInterface
    {
        var_dump(__METHOD__);

        return $this->pageFactory->create();
    }
}
