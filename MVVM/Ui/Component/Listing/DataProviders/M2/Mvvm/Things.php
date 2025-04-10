<?php

namespace M2\MVVM\Ui\Component\Listing\DataProviders\M2\Mvvm;

use M2\MVVM\Model\ResourceModel\Thing\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class Things extends AbstractDataProvider
{
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        protected CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
}
