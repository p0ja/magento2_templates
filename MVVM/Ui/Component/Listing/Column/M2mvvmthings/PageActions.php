<?php

namespace M2\MVVM\Ui\Component\Listing\Column\M2mvvmthings;

use Magento\Ui\Component\Listing\Columns\Column;

class PageActions extends Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource["data"]["items"])) {
            foreach ($dataSource["data"]["items"] as & $item) {
                $name = $this->getData("name");
                $id = "X";

                if (isset($item["thing_id"])) {
                    $id = $item["thing_id"];
                }
                $item[$name]["view"] = [
                    "href" => $this->getContext()->getUrl(
                        "M2_mvvm_things/thing/edit",
                        [
                            "thing_id" => $id,
                        ]
                    ),
                    "label" => __("Edit")
                ];
            }
        }

        return $dataSource;
    }
}
