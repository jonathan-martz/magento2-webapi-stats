<?php

namespace JonathanMartz\WebApiStats\Plugin\Rest;

use JonathanMartz\WebApiStats\Model\RequestFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\UrlInterface;
use Magento\Webapi\Controller\Rest;
use Psr\Log\LoggerInterface;

class Api
{
    protected $logger;

    protected $webapistats;

    /**
     * @var UrlInterface
     */
    private $url;
    /**
     * @var RemoteAddress
     */
    private $remote;
    /**
     * @var Session
     */
    private $customerSession;

    public function __construct(
        LoggerInterface $logger,
        UrlInterface $url,
        RemoteAddress $remote,
        Session $customerSession,
        RequestFactory $webapistats
    ) {
        $this->logger = $logger;
        $this->url = $url;
        $this->remote = $remote;
        $this->customerSession = $customerSession;
        $this->webapistats = $webapistats;
    }

    public function aroundDispatch(
        Rest $subject,
        callable $proceed,
        RequestInterface $request
    ) {
        var_dump('hallo');

        $url = str_replace($this->url->getBaseUrl(), '', $this->url->getCurrentUrl());
        $loggedIn = $this->customerSession->isLoggedIn();
        $id = $this->customerSession->getSessionId();
        $ip = $this->remote->getRemoteAddress();

        // var_dump($url);
        // var_dump($loggedIn);
        // var_dump($id);
        // var_dump($ip);

        if(false) {
            $model = $this->webapistats->create();
            $model->addData([
                "title" => 'Title 01',
                "content" => 'Content 01',
                "status" => true,
                "sort_order" => 1
            ]);
            $saveData = $model->save();
            if($saveData) {
                // erfolgreich
            }
        }

        die('Konalo');

        return $proceed($request);
    }
}
