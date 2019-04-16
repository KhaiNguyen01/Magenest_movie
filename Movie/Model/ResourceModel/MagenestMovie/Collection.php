<?php
namespace Magenest\Movie\Model\ResourceModel\MagenestMovie;

/**
 * Subscription Collection
 */
class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_magenestMovieCollectionFactory;
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Magenest\Movie\Model\MagenestMovie',
            'Magenest\Movie\Model\ResourceModel\MagenestMovie');
    }
}