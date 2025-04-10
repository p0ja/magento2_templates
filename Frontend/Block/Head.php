<?php

declare(strict_types=1);

namespace M2\Frontend\Block;

use Magento\Framework\View\Asset\Repository;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Head extends Template
{
    public function __construct(
        Context $context,
        private readonly Repository $assetRepository,
        array $data = [],
    ) {
        parent::__construct($context, $data);
    }
}
