<?php

declare(strict_types=1);

namespace Vendor\DynamicRows\Controller\Adminhtml\Row;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\ImportExport\Controller\Adminhtml\Export\Index as BaseIndex;

class Index extends BaseIndex
{
   public function execute(): ResultInterface
   {
       $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
       $resultPage->setActiveMenu('Vendor_DynamicRows::dynamic_rows');
       $resultPage->getConfig()->getTitle()->prepend(__('Dynamic Rows'));
       $resultPage->addBreadcrumb(__('Dynamic Rows'), __('Dynamic Rows'));

       return $resultPage;
   }
}
