<?php
declare(strict_types=1);

namespace M2\Frontend\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    public function __construct(
        protected Context $context,
        private readonly PageFactory $resultPageFactory,
    ) {
        parent::__construct($context);
    }

    public function execute(): ResultInterface
    {
        return $this->resultPageFactory->create();
    }
}
