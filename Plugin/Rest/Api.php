<?php
namespace JonathanMartz\WebApiStats\Plugin\Rest;

class Api
{
    protected $logger;

    protected $currentRequest;

    public function __construct(\JonathanMartz\WebApiStats\Logger\Handler $logger)
    {
        $this->logger = $logger;
    }

        public function aroundDispatch(
        \Magento\Webapi\Controller\Rest $subject,
        callable $proceed,
        \Magento\Framework\App\RequestInterface $request
    ) {
        die('Konalo');

        return $proceed($request);
    }
}
