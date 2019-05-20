<?php
namespace Magenest\Khai\Model\Attribute\Source;

use Magento\Framework\Escaper;
use Magenest\Khai\Model\VendorFactory;

class Vendor extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected $escaper;
    protected $_vendor;

    public function __construct(VendorFactory $vendor, Escaper $escaper)
    {
        $this->_vendor = $vendor;
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
        $collection = $this->_vendor->create()->getCollection();
        $result = [];
        $result[] = ['value' => ' ', 'label' => 'Select...'];
        foreach ($collection as $group) {
                $result[] = ['value' => $group->getId(), 'label' => $group->getFirstName()];
        }
        return $result;
    }
}