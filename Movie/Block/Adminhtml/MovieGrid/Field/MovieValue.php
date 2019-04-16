<?php

namespace Magenest\Movie\Block\Adminhtml\MovieGrid\Field;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field as BaseField;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\UrlInterface;
use Zend\Uri\UriFactory;
use Magenest\Movie\Model\ResourceModel\MagenestMovie;

class MovieValue extends BaseField
{
    /**
     * Render element value
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return                                        string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected $_movieCollectionFactory;

    public function __construct(
        Context $context,
        \Magenest\Movie\Model\ResourceModel\MagenestMovie\CollectionFactory $movieCollectionFactory,
        array $data = [])
    {
        $this->_movieCollectionFactory = $movieCollectionFactory;
        parent::__construct($context, $data);
    }

    protected function _renderValue(AbstractElement $element)
    {

        $movies = $this->_movieCollectionFactory->create();

        $count = count($movies);


        $element->setReadonly(true);
        $element->setValue($count);

        return parent::_renderValue($element);

    }
}
