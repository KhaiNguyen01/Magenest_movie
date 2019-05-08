<?php

namespace Khai\Parttime\Controller\Index;

class Config extends \Magento\Framework\App\Action\Action
{

    protected $helperData;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Khai\Parttime\Helper\Data $helperData

    )
    {
        $this->helperData = $helperData;
        return parent::__construct($context);
    }

    public function execute()
    {
        echo $this->helperData->getGeneralConfig('product_name');
        exit();
    }
}