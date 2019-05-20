<?php

namespace Magenest\Khai\Ui\Component\Listing\Column;

use Magento\Framework\Escaper;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as Customer;

/**
 * Class Options
 */
class Options implements OptionSourceInterface
{
    /**
     * Escaper
     *
     * @var Escaper
     */
    protected $escaper;
    protected $_customer;
    protected $customerRepositoryInterface;
    /**
     * @var array
     */
    protected $options;
    /**
     * @var array
     */
    protected $currentOptions = [];

    /**
     * Constructor
     *
     * @param Product $systemStore
     * @param Escaper $escaper
     */
    public function __construct(Customer $customer, Escaper $escaper, CustomerRepositoryInterface $customerRepositoryInterface)
    {
        $this->_customer = $customer;
        $this->escaper = $escaper;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->options !== null) {
            return $this->options;
        }
        $this->options = $this->getAvailableGroups();
        return $this->options;
    }

    /**
     * Prepare groups
     *
     * @return array
     */
    private function getAvailableGroups()
    {
        $collection = $this->_customer->create();
        $collection->addAttributeToSelect('*');
        $result = [];
        $result[] = ['value' => ' ', 'label' => 'Select...'];
        foreach ($collection as $group) {
            $customerId = $group->getId();
            if ($this->customerRepositoryInterface->getById($customerId)->getCustomAttribute('is_approved')) {
                $result[] = ['value' => $group->getId(), 'label' => $group->getFirstname()." ".$group->getLastname()];
            }
        }
        return $result;
    }
}