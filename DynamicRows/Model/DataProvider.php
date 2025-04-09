<?php

declare(strict_types=1);

namespace Vendor\DynamicRows\Model;

use Vendor\DynamicCategory\Model\ResourceModel\VendorCollection;
use Vendor\DynamicCategory\Model\ResourceModel\VendorCollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
   protected $loadedData;
   protected $rowCollection;

   public function __construct(
       $name,
       $primaryFieldName,
       $requestFieldName,
       VendorCollection $collection,
       VendorCollectionFactory $collectionFactory,
       array $meta = [],
       array $data = []
   ) {
       $this->collection = $collection;
       $this->rowCollection = $collectionFactory;

       parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
   }

   public function getData()
   {
       if (isset($this->loadedData)) {

           return $this->loadedData;
       }
       $collection = $this->rowCollection->create()->setOrder('value', 'ASC');
       $items = $collection->getItems();

       foreach ($items as $item) {
           $this->loadedData['stores']['dynamic_rows_container'][] = $item->getData();
       }

       return $this->loadedData;
   }
}
