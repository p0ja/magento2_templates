<?php

namespace Dev\Grid\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action
{
    const ADMIN_RESOURCE = 'Magento_Catalog::categories';

    public function __construct(
        protected Action\Context $context,
        private readonly Filter $filter,
        private readonly CollectionFactory $collectionFactory,
        private ?CategoryRepositoryInterface $categoryRepository = null
    ) {
        $this->categoryRepository = $categoryRepository
            ?: ObjectManager::getInstance()->create(CategoryRepositoryInterface::class);

        parent::__construct($context);
    }

    public function execute(): ResultInterface
    {
        if (!$this->getRequest()->isPost()) {
            throw new NotFoundException(__('Page not found'));
        }

        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $categoryDeleted = 0;

        foreach ($collection->getItems() as $category) {
            $this->categoryRepository->delete($category);
            $categoryDeleted++;
        }

        if ($categoryDeleted) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $categoryDeleted)
            );
        }

        return $this->resultFactory
            ->create(ResultFactory::TYPE_REDIRECT)
            ->setPath('dev_grid/index/index');
    }
}
