<?php

namespace Magenest\Movie\Block\Adminhtml\AddMovie\Edit;

use \Magento\Backend\Block\Widget\Form\Generic;
use Magento\Config\Block\System\Config\Form\Field as BaseField;
use Magenest\Movie\Model\MagenestDirectorFactory as Director;

class Form extends Generic
{

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    protected $_director;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        Director $director,
        array $data = []
    )
    {
        $this->_systemStore = $systemStore;
        $this->_director = $director;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('movie_form');
        $this->setTitle(__('Add Movie'));
    }

    public function getOptions()
    {
        $collection = $this->_director->create()->getCollection();
        $arr=[];
        foreach($collection as $model){
            $arr[]=[
                'label'=>$model->getName(),
                'value'=>$model->getID()
            ];
        }
        return $arr;
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var $model \Magenest\Movie\Model\MagenestMovie */
        $model = $this->_coreRegistry->registry('magenest_movie');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );
        $form->setHtmlIdPrefix('movie_');
        $form->setFieldNameSuffix('movie');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Add Movie')]
        );

        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Name'),
                'required' => true
            ]
        );
        $fieldset->addField(
            'description',
            'text',
            [
                'name' => 'description',
                'label' => __('Description'),

            ]
        );
        $fieldset->addField(
            'rating',
            'text',
            [
                'name' => 'rating',
                'label' => __('Rating'),
                'class' => 'validate-digits-range digits-range-1-10'
            ]
        );
        $fieldset->addField(
            'director_id',
            'select',
            [
                'name' => 'director_id',
                'label' => __('Director_ID'),
                'required' => true,
                'values' => $this->getOptions()
            ]
        );

        //$data = $model->getData();
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}