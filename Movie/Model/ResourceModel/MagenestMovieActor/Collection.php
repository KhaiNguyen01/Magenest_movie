<?php
namespace Magenest\Movie\Model\ResourceModel\MagenestMovieActor;

/**
 * Subscription Collection
 */
class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Magenest\Movie\Model\MagenestMovieActor',
            'Magenest\Movie\Model\ResourceModel\MagenestMovieActor');
    }
}