<?php

declare(strict_types=1);

namespace M2\MVVM\Block\Adminhtml\Thing\Edit;

use Magento\Backend\Block\Widget\Context;

class GenericButton
{
    public function __construct(
        protected Context $context,
    ) {
    }

    public function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }

    public function getUrl(?string $route = '', array $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', [
            'object_id' => $this->getObjectId()
        ]);
    }

    public function getObjectId()
    {
        return $this->context->getRequest()->getParam('thing_id');
    }
}
