<?php

namespace JonathanMartz\WebApiStats\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'JonathanMartz\WebApiStats\Model\Request',
            'JonathanMartz\WebApiStats\Model\ResourceModel\Resource'
        );
    }
}
