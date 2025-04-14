<?php

namespace Omnipay\Khalti;

use Omnipay\Common\AbstractGateway;
use Omnipay\Khalti\Message\PurchaseRequest;
use Omnipay\Khalti\Message\VerifyPaymentRequest;

class KhaltiGateway extends AbstractGateway
{
    public function getName()
    {
        return 'Khalti';
    }

    public function getDefaultParameters()
    {
        return [
            'secret' => '',
            'testMode' => false,
        ];
    }

    public function getSecret()
    {
        return $this->getParameter('secret');
    }

    public function setSecret($value)
    {
        return $this->setParameter('secret', $value);
    }

    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }

    public function purchase(array $parameters = []): PurchaseRequest
    {
        return $this->createRequest('\Omnipay\Khalti\Message\PurchaseRequest', $parameters);
    }

    public function fetchTransaction(array $parameters = []): VerifyPaymentRequest
    {
        return $this->createRequest('\Omnipay\Khalti\Message\VerifyPaymentRequest', $parameters);
    }
}
