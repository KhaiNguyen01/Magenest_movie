<?php

namespace Khai\Parttime\Block;

use Magento\Framework\View\Element\Template\Context;
use Khai\Parttime\Model\MemberFactory as Member;
use Magento\Customer\Model\Session;

/**
 * Test List block
 */
class ShowMember extends \Magento\Framework\View\Element\Template
{
    protected $_member;
    protected $customerSession;
    public function __construct( Context $context, Member $member, Session $customerSession)
    {
        $this->_member = $member;
        $this->customerSession = $customerSession;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Member Info'));

        return parent::_prepareLayout();
    }


    public function  getMember()
    {
        $member = $this->_member->create()->getCollection();
        return $member;
    }

    public function getMemberInfo()
    {
        $info = $this->customerSession->getCustomer();
        return $info;
    }
}