<?php

declare(strict_types=1);

namespace M2\Knockout\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements ActionInterface
{
    public function __construct(
        private readonly PageFactory $resultPageFactory
    ) {
    }

    public function execute(): ResultInterface
    {
        return $this->resultPageFactory->create();
    }
}
