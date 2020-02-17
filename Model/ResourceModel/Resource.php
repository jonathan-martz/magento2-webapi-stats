<?php
namespace JonathanMartz\WebApiStats\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Resource
 * @package JonathanMartz\WebApiStats\Model\ResourceModel
 */
class Resource extends AbstractDb
{
    /**
     *
     */
    public function _construct()
    {
        $this->_init("webapi_stats_request", "id");
    }
}

?>
