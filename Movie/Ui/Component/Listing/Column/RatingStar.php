<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magenest\Movie\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use Magenest\Movie\Model\MagenestMovieFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class RatingStar extends Column
{

    protected $_movieFactory;

    public function __construct(
        MagenestMovieFactory $movieFactory,
        UrlInterface $urlBuilder,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    )
    {

        $this->_movieFactory = $movieFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);

    }

//    public function prepareDataSource(array $dataSource) {
//        if (isset($dataSource['data']['items'])) {
//            foreach ($dataSource['data']['items'] as $key => $items) {
//                $product = $this->_movieFactory->create()->load(1);
//                //$product_name = html_entity_decode('<a href="' . $this->_urlBuilder->getUrl($product->getProductUrl()) . '">' . $items['title'] . '</a>');
//                $ratingStar=$product->getRating()->getRatingSummary();
//                $dataSource['data']['items'][$key]['rating'] = $ratingStar;
//            }
//        }
//        return $dataSource;
//    }
    public function prepareDataSource(array $dataSource)
    {

        if (isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as & $item) {
                $fieldName = $this->getData('name');
                $rating = '';
                $loop = $item['rating'];
                for ($i = 0; $i < $loop; $i++) {
                    $rating .= "<label style=\"color: darkred;\">★</label>";
                }
                for ($i = $loop; $i < 5; $i++) {
                    $rating .= "<label  style=\"color: rgb(204, 204, 204);\">★</label>";
                }
                $item[$fieldName] = $rating;


            }
        }
        return $dataSource;
    }
}