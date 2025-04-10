<?php

declare(strict_types=1);

namespace M2\MVVM\Block\Adminhtml\Thing\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData(): array
    {
        if (!$this->getObjectId()) {
            return [];
        }

        return [
            'label' => __('Delete Object'),
            'class' => 'delete',
            'on_click' => 'deleteConfirm( \'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
            'sort_order' => 20,
        ];
    }
}
