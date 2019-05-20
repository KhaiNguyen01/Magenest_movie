<?php
namespace Magenest\Khai\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\Customer;


class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    private $eavConfig;

    public function __construct(EavSetupFactory $eavSetupFactory, Config $eavConfig)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig       = $eavConfig;
    }
//    const IS_APPROVED = 'is_approved';
//    protected $customerSetupFactory;
//    private $attributeSetFactory;
//
//    public function __construct(
//        CustomerSetupFactory $customerSetupFactory, AttributeSetFactory $attributeSetFactory
//    ) {
//        $this->customerSetupFactory = $customerSetupFactory;
//        $this->attributeSetFactory = $attributeSetFactory;
//    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            Customer::ENTITY,
            'is_approved',
            [
                'type' => 'int',
                'label' => 'Khai_is_approved',
                'input' => 'select',
                'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'required' => false,
                'visible'      => true,
                'user_defined' => true,
                'position'     => 999,
                'system'       => 0
            ]
        );
        $sampleAttribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'is_approved');
        $sampleAttribute->setData(
            'used_in_forms', [
                'adminhtml_customer',
                'adminhtml_checkout',
                'customer_account_create',
                'customer_account_edit'

        ]);
        $sampleAttribute->save();

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'khai_product_vendor',
            [
                'group' => 'General',
                'type' => 'varchar',
                'label' => 'Vendor',
                'input' => 'select',
                'source' => 'Magenest\Khai\Model\Attribute\Source\Vendor',
                'required' => false,
                'sort_order' => 50,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true
            ]
        );
    }

}