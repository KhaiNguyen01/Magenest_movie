<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magenest\Movie\Model\MagenestMovieFactory as MagenestMovie;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;


class Save extends \Magento\Framework\App\Action\Action
{
    protected $_movie;

    public function __construct(Context $context, MagenestMovie $movie)
    {
        $this->_movie = $movie;
        parent::__construct($context);
    }

    /**
     * @return void
     */
    public function execute()
    {
//        $data = $this->getRequest()->getParam('movieui');
        $data = $this->getRequest()->getPostValue();
        $movieModel = $this->_movie->create();
        $movieModel->setData($data)->save();

        $this->messageManager->addSuccessMessage('Add done !');


        $this->_redirect('movie/movie');

    }
}