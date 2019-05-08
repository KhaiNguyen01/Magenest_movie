<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Khai\Parttime\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use Khai\Parttime\Model\MemberFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class Phone extends Column
{

    protected $_member;

    public function __construct(
        MemberFactory $member,
        UrlInterface $urlBuilder,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    )
    {

        $this->_member = $member;
        parent::__construct($context, $uiComponentFactory, $components, $data);

    }

    public function prepareDataSource(array $dataSource)
    {

        if (isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as & $item) {
                $item[$this->getData('name')] = "+84".$item['phone'];
            }
        }
        return $dataSource;
    }
}