<?php


namespace Bluethink\Grid\Model\ResourceModel\Grid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init(
            'Bluethink\Grid\Model\Grid',
            'Bluethink\Grid\Model\ResourceModel\Grid'
        );
    }
}
