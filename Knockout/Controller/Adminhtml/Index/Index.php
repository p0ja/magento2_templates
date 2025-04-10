<?php

namespace M2\Knockout\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    const ADMIN_RESOURCE = 'M2_Knockout::M2_knockout_menu';

    public function __construct(
        protected Context $context,
        private readonly PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
    }

    public function execute(): ResultInterface
    {
        return $this->resultPageFactory->create();
    }

    protected function _isAllowed(): bool
    {
        return parent::_isAllowed('M2_Knockout::menu_1');
    }
}
