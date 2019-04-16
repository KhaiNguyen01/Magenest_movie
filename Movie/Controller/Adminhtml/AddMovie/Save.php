<?php

namespace Magenest\Movie\Controller\Adminhtml\AddMovie;

use Magenest\Movie\Controller\Adminhtml\AddMovie;
use Magenest\Movie\Model\ResourceModel\MagenestMovie\CollectionFactory;


class Save extends \Magento\Framework\App\Action\Action
{
    /**
     * @return void
     */
    public function execute()
    {
        $isPost = $this->getRequest()->getParam('movie');

        if ($isPost) {
            $name = $isPost['name'];
            $des = $isPost['description'];
            $rating = $isPost['rating'];
            $dir = $isPost['director_id'];
            $subscription = $this->_objectManager->create('Magenest\Movie\Model\MagenestMovie');
            $subscription->setName($name);
            $subscription->setDescription($des);
            $subscription->setRating($rating);
            $subscription->setDirector_id($dir);
            $subscription->save();
        }


    }
}