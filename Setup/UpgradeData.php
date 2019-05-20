<?php
namespace Magenest\Khai\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\Customer;

class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;

    private $eavConfig;

    public function __construct(EavSetupFactory $eavSetupFactory, Config $eavConfig)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig       = $eavConfig;
    }

    public function upgrade( ModuleDataSetupInterface $setup, ModuleContextInterface $context ) {
        if ( version_compare($context->getVersion(), '1.0.3', '<' )) {
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $attributeSetId = $eavSetup->getDefaultAttributeSetId(Customer::ENTITY);
            $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(Customer::ENTITY);
            $sampleAttribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'is_approved')
                ->addData([
                    'attribute_set_id' => $attributeSetId,
                    'attribute_group_id' => $attributeGroupId,
                ]);
            $sampleAttribute->save();
        }
    }
}