<?php

declare(strict_types=1);

namespace M2\MVVM\Controller\Adminhtml\Thing;

use M2\MVVM\Model\ThingRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;

class Delete extends Action
{
    public const ADMIN_RESOURCE = 'M2_MVVM::things';

    protected ThingRepository $objectRepository;

    /**
     * @param ThingRepository $objectRepository
     * @param Context $context
     */
    public function __construct(ThingRepository $objectRepository, Context $context)
    {
        $this->objectRepository = $objectRepository;

        parent::__construct($context);
    }

    public function execute(): Redirect
    {
        $id = $this->getRequest()->getParam('object_id');
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($id) {
            try {
                $this->objectRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('You have deleted the object.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());

                return $resultRedirect->setPath('*/*/edit', ['thing_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can not find an object to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
