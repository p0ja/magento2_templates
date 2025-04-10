<?php

declare(strict_types=1);

namespace M2\MVVM\Controller\Adminhtml\Thing;

use Exception;
use M2\MVVM\Model\Thing;
use M2\MVVM\Model\ThingRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action
{
    /**
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'M2_MVVM::things';

    public function __construct(
        protected Context $context,
        private readonly DataPersistorInterface $dataPersistor,
        private readonly ThingRepository $objectRepository
    ) {
        parent::__construct($context);
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function execute(): Redirect
    {
        $data = $this->getRequest()->getPostValue();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = Thing::STATUS_ENABLED;
            }

            if (empty($data['thing_id'])) {
                $data['thing_id'] = null;
            }

            /** @var Thing $model */
            $model = $this->_objectManager->create(Thing::class);
            $id = $this->getRequest()->getParam('thing_id');

            if ($id) {
                $model = $this->objectRepository->getById($id);
            }

            $model->setData($data);

            try {
                $this->objectRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the thing.'));
                $this->dataPersistor->clear('m2_mvvm_thing');

                if ($this->getRequest()->getParam('back')) {

                    return $resultRedirect->setPath('*/*/edit', [
                        'thing_id' => $model->getId(),
                        '_current' => true,
                    ]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the data.'));
            }

            $this->dataPersistor->set('M2_mvvm_thing', $data);

            return $resultRedirect->setPath('*/*/edit', ['thing_id' => $this->getRequest()->getParam('thing_id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
