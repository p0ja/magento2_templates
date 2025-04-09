<?php

declare(strict_types=1);

namespace Vendor\NewtypesGraphQl\Model\Resolver\DataProvider;

use Vendor\NewtypesGraphQl\Service\GetNewtypesList;

class Newtypes
{
    /**
     * @param GetNewtypesList $getNewtypesList
     */
    public function __construct(
        private readonly GetNewtypesList $getNewtypesList
    ){
    }

    /**
     * @param array $data
     * @return array
     */
    public function getData(array $data): array
    {
        $newtypes = [];
        $newtypesList = $this->getNewtypesList->execute($data);

        foreach ($newtypesList as $newtype) {
            $newtypes[] = [
                'name' => $newtype->getName(),
                'date_from' => $newtype->getDateFrom(),
                'date_to' => $newtype->getDateTo(),
                'content' => $newtype->getContent(),
                'url' => $newtype->getUrl(),
                'model' => $newtype,
            ];
        }

        return $newtypes;
    }
}
