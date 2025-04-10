<?php

declare(strict_types=1);

namespace M2\Knockout\Ui\Component;

use Magento\Ui\Component\AbstractComponent;

class Simple extends AbstractComponent
{
    const NAME = 'html_content_m2_simple_valid';

    public function getComponentName()
    {
        return self::getName();
    }
}
