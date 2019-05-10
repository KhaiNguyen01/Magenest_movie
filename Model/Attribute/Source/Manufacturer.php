<?php
namespace Khai\ManufacturerEntity\Model\Attribute\Source;

use Magento\Framework\Escaper;
use Khai\ManufacturerEntity\Model\EntityFactory;

class Manufacturer extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected $escaper;
    protected $_manu;

    public function __construct(EntityFactory $manu, Escaper $escaper)
    {
        $this->_manu = $manu;
        $this->escaper = $escaper;
    }

    public function getAllOptions()
    {
        if ($this->_options !== null) {
            return $this->_options;
        }
        $this->_options = $this->getAvailableGroups();
        return $this->_options;
    }

    private function getAvailableGroups()
    {
        $collection = $this->_manu->create()->getCollection();
        $result = [];
        $result[] = ['value' => ' ', 'label' => 'Select...'];
        foreach ($collection as $group) {
            if($group->getEnabled()){
                $result[] = ['value' => $group->getId(), 'label' => $group->getName()];
            }
        }
        return $result;
    }

//    public function getAllOptions()
//    {
//        if (!$this->_options) {
//            $this->_options = [
//                ['label' => __('Cotton'), 'value' => 'cotton'],
//                ['label' => __('Leather'), 'value' => 'leather'],
//                ['label' => __('Silk'), 'value' => 'silk'],
//                ['label' => __('Denim'), 'value' => 'denim'],
//                ['label' => __('Fur'), 'value' => 'fur'],
//                ['label' => __('Wool'), 'value' => 'wool'],
//            ];
//        }
//        return $this->_options;
//    }
}