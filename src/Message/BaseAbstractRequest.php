<?php

namespace Omnipay\Khalti\Message;

use Omnipay\Common\Message\AbstractRequest;

abstract class  BaseAbstractRequest extends AbstractRequest
{
    protected $liveEndpoint = 'https://khalti.com/api/v2/';
    protected $testEndpoint = 'https://dev.khalti.com/api/v2/';

    public function getSecret()
    {
        return $this->getParameter('secret');
    }

    public function setSecret($value)
    {
        return $this->setParameter('secret', $value);
    }

    public function getEndpointBase()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
