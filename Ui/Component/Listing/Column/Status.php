<?php

namespace Khai\ManufacturerEntity\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use Khai\ManufacturerEntity\Model\EntityFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class Status extends Column
{
    protected $_entity;

    public function __construct(
        EntityFactory $entity,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    )
    {

        $this->_entity = $entity;
        parent::__construct($context, $uiComponentFactory, $components, $data);

    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {

                if($item['enabled'] == 0){
                    $item[$this->getData('name')] = "<span class='grid-severity-critical'><span>Disabled</span></span>";
                }else{
                    $item[$this->getData('name')] = "<span class='grid-severity-notice'><span>Enabled</span></span>";
                }
            }
        }

        return $dataSource;
    }
}