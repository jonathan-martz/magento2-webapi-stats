<?php

namespace JonathanMartz\WebApiStats\Plugin\Rest;

use JonathanMartz\WebApiStats\Model\RequestFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\UrlInterface;
use Magento\Webapi\Controller\Rest;
use Psr\Log\LoggerInterface;
use function json_encode;

/**
 * Class Api
 * @package JonathanMartz\WebApiStats\Plugin\Rest
 */
class Api
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var RequestFactory
     */
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

    /**
     * Api constructor.
     * @param LoggerInterface $logger
     * @param UrlInterface $url
     * @param RemoteAddress $remote
     * @param Session $customerSession
     * @param RequestFactory $webapistats
     */
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

    /**
     * @param Rest $subject
     * @param callable $proceed
     * @param RequestInterface $request
     * @return mixed
     */
    public function aroundDispatch(
        Rest $subject,
        callable $proceed,
        RequestInterface $request
    ) {
        $url = str_replace([$this->url->getBaseUrl(), 'rest/V1/'], ['', ''], $this->url->getCurrentUrl());
        $loggedIn = $this->customerSession->isLoggedIn();
        $id = $this->customerSession->getSessionId();
        $ip = $this->remote->getRemoteAddress();

        $model = $this->webapistats->create();
        $data = [
            'url' => $url,
            'loggedin' => (int)$loggedIn,
            'session' => $id,
            'ip' => sha1($ip),
            'time' => time()
        ];
        $model->addData($data);
        $saveData = $model->save();
        if(!$saveData) {
            $this->logger->alert('Cant add Request: ' . json_encode($data));
        }

        die('Konalo');

        return $proceed($request);
    }
}
