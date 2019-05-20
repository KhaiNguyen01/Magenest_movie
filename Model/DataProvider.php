<?php
namespace Magenest\Khai\Model;


use Magenest\Khai\Model\ResourceModel\Vendor\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Filesystem;
/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Magenest\Khai\Model\ResourceModel\Vendor\Collection
     */
    protected $collection;
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var array
     */
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $bannerCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $bannerCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $bannerCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \Magenest\Khai\Model\Vendor $banner */
        foreach ($items as $banner) {
            $this->loadedData[$banner->getId()] = $banner->getData();
        }
        // Used from the Save action
        $data = $this->dataPersistor->get('vendor');
        if (!empty($data)) {
            $banner = $this->collection->getNewEmptyItem();
            $banner->setData($data);
            $this->loadedData[$banner->getId()] = $banner->getData();
            $this->dataPersistor->clear('vendor');
        }
        return $this->loadedData;
    }
}