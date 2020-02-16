<?php
namespace JonathanMartz\WebApiStats\Model\ResourceModel\DataExample;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init("JonathanMartz\WebApiStats\Model\Request", "JonathanMartz\WebApiStats\Model\ResourceModel\Resource");
    }
}

?>
