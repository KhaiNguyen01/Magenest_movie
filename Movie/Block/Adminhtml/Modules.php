<?php

namespace Magenest\Movie\Block\Adminhtml;

class Modules extends \Magento\Framework\View\Element\Template
{
    protected $fullModuleList;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Module\FullModuleList $fullModuleList,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->fullModuleList = $fullModuleList;
        $this->_objectManager = $objectManager;
    }

    public function modulesList()
    {
        $allModules = $this->fullModuleList->getAll();
        $numbersOfModule = count($allModules);
        return $numbersOfModule;
    }

    public function otherModules(){
        $countOther = 0;
        $allModules = $this->fullModuleList->getNames();
        foreach ($allModules as $allModule){
            if (stristr ($allModule,"Magento", False )){
                $countOther++;
            }
        }
        return $countOther;
    }
}