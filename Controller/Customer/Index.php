<?php
namespace Magenest\Khai\Controller\Customer;
class Index extends \Magento\Framework\App\Action\Action {

    public function execute() {

        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }

}