<?php

declare(strict_types=1);

namespace Vendor\DynamicRows\Model\Source;

use Magento\Framework\Option\ArrayInterface;

class Condition implements ArrayInterface
{
   public function toOptionArray()
   {
       $conditions[] = [
           'label' => 'GreaterThan',
           'value' => 'gt',
       ];

       $conditions[] = [
           'label' => 'Equal',
           'value' => 'eq',
       ];

       return $conditions;
   }
}
