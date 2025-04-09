<?php

declare(strict_types=1);

namespace Vendor\DynamicRows\Controller\Adminhtml\Row;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Vendor\DynamicCategory\Model\CategoryRuleFactory;
use Vendor\DynamicCategory\Model\ResourceModel\CategoryRuleResourceFactory;

class Save extends Action
{
   public function __construct(
       protected Context $context,
       private readonly CategoryRuleFactory $dynamicRowFactory,
       private readonly CategoryRuleResourceFactory $dynamicRowResource
   ) {
       parent::__construct($context);
   }

   public function execute(): ResultInterface
   {
       if ($this->_isAllowed()) {

           try {
               $dynamicRowData = $this->getRequest()->getParam('dynamic_rows_container');

               $dynamicRowResource = $this->dynamicRowResource->create();
               $dynamicRowResource->deleteDynamicRows();

               if (is_array($dynamicRowData) && !empty($dynamicRowData)) {
                   foreach ($dynamicRowData as $dynamicRowDatum) {
                       $model = $this->dynamicRowFactory->create();
                       unset($dynamicRowDatum['entity_id']);
                       $model->addData($dynamicRowDatum);

                       $model->save();
                   }
               }

               $this->messageManager->addSuccessMessage(__('Rows have been saved successfully'));
           } catch (Exception $e) {
               $this->messageManager->addErrorMessage(__('Exception saving rows') . ': ' . $e->getMessage());
           }
       }

       return $this->_redirect('*/*/index/scope/stores');
   }

   protected function _isAllowed(): bool
   {
       return $this->_authorization->isAllowed('Vendor_DynamicRows::dynamic_rows');
   }
}
