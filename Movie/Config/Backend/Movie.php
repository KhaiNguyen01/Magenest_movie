<?php
namespace Atwix\DynamicFields\Config\Backend;

use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Value as ConfigValue;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Magento\Framework\Serialize\SerializerInterface;
use Magenest\Movie\Model\MagenestMovieFactory;
class Movie extends ConfigValue
{
    protected $_magenestMovie;

    public function __construct(
        SerializerInterface $serializer,
        Context $context,
        Registry $registry,
        ScopeConfigInterface $config,
        TypeListInterface $cacheTypeList,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        MagenestMovieFactory $magenestMovieFactory,
        array $data = []
    )
    {
        $this->_magenestMovieFactory = $magenestMovieFactory;
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    public function getMovieCollection()
    {
        //$magenestMovieFactory = $this->_magenestMovieFactory->create();
        $collection = $this->_magenestMovieFactory->create()->getCollection();
        return $collection;
    }
}