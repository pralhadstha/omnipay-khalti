<?php

namespace Omnipay\Khalti\Message;

use Omnipay\Common\Exception\InvalidRequestException;
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

    public function getEndpointBase(): string
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }

    public function setReturnUrl($value)
    {
        return $this->setParameter('returnUrl', $value);
    }

    public function getWebsiteUrl()
    {
        return $this->getParameter('websiteUrl');
    }

    public function setWebsiteUrl($value)
    {
        return $this->setParameter('websiteUrl', $value);
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function getPurchaseOrderId()
    {
        return $this->getParameter('purchaseOrderId');
    }

    public function setPurchaseOrderId($value)
    {
        return $this->setParameter('purchaseOrderId', $value);
    }

    public function getPurchaseOrderName()
    {
        return $this->getParameter('purchaseOrderName');
    }

    public function setPurchaseOrderName($value)
    {
        return $this->setParameter('purchaseOrderName', $value);
    }

    public function setCustomerInfo($value)
    {
        return $this->setParameter('customerInfo', $value);
    }

    public function getCustomerInfo()
    {
        return $this->getParameter('customerInfo');
    }

    public function setAmountBreakdown($value)
    {
        return $this->setParameter('amountBreakdown', $value);
    }

    public function getAmountBreakdown()
    {
        return $this->getParameter('amountBreakdown');
    }

    public function setProductDetails($value)
    {
        return $this->setParameter('productDetails', $value);
    }

    public function getProductDetails()
    {
        return $this->getParameter('productDetails');
    }

    public function setMerchantUsername($value)
    {
        return $this->setParameter('merchantUsername', $value);
    }

    public function getMerchantUsername()
    {
        return $this->getParameter('merchantUsername');
    }

    public function setMerchantExtra($value)
    {
        return $this->setParameter('merchantExtra', $value);
    }

    public function getMerchantExtra()
    {
        return $this->getParameter('merchantExtra');
    }

    public function setPaymentId($value)
    {
        return $this->setParameter('paymentId', $value);
    }

    public function getPaymentId()
    {
        return $this->getParameter('paymentId');
    }

    protected function handleResponse($response): array
    {
        $body = json_decode($response->getBody()->getContents(), true);

        if ($response->getStatusCode() == 401) {
            throw new InvalidRequestException($body['detail']);
        }

        if ($response->getStatusCode() == 400) {
            throw new InvalidRequestException(json_encode($body));
        }

        return $body;
    }
}
