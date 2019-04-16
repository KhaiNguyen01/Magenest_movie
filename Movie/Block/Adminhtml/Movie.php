<?php
namespace Magenest\Movie\Block\Adminhtml;
class Movie extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'Magenest_Movie';
        $this->_controller = 'adminhtml_movie';
        parent::_construct();
        $this->buttonList->add(
            '<new_movie>',
            [
                'label' => __('New Movie'),
                'class' => 'save',
                'onclick' => 'setLocation(\'' . $this->getUrl('movie/addmovie') . '\')',
                'style' => '    background-color: #ba4000; border-color: #b84002; box-shadow: 0 0 0 1px #007bdb;color: #fff;text-decoration: none;'
            ]
        );
    }
}