<?php
namespace JonathanMartz\WebApiStats\Model;

use Magento\Framework\Model\AbstractModel;

class Request extends AbstractModel
{
    public function _construct()
    {
        $this->_init("JonathanMartz\WebApiStats\Model\ResourceModel\Resource");
    }
}

?>
