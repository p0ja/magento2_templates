<?php

declare(strict_types=1);

namespace M2\MVVM\Block;

use Magento\Framework\View\Element\Template;

class Main extends Template
{
    protected function _prepareLayout(): self
    {
        $this->setMessage('Message from block Main');
        $this->setName($this->getRequest()->getParam('name'));

        return $this;
    }
}
