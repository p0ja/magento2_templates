<?php

declare(strict_types=1);

namespace M2\MVVM\Controller\Adminhtml\Thing;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;

class Index extends Action
{
    public const ADMIN_RESOURCE = 'M2_MVVM::things';

    public function execute(): Redirect
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/index/index');

        return $resultRedirect;
    }
}
