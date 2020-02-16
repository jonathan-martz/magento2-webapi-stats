<?php
namespace JonathanMartz\WebApiStats\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Resource extends AbstractDb
{
    public function _construct()
    {
        $this->_init("web_api_stats", "id");
    }
}

?>
