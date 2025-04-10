<?php

declare(strict_types=1);

namespace M2\MVVM\Controller\Adminhtml\Thing;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    public const ADMIN_RESOURCE = 'M2_MVVM::things';

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
