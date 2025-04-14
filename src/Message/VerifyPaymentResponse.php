<?php

namespace Omnipay\Khalti\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class VerifyPaymentResponse extends AbstractResponse
{
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
        $this->request = $request;
        $this->data = $data;
    }

    public function isSuccessful(): bool
    {
        return $this->checkStatus('completed');
    }

    public function isPending(): bool
    {
        return $this->checkStatus('pending');
    }

    public function isExpired(): bool
    {
        return $this->checkStatus('expired');
    }

    public function isRefunded(): bool
    {
        return $this->checkStatus('refunded') || $this->data['refunded'];
    }

    public function isUserCanceled(): bool
    {
        return $this->checkStatus('user canceled');
    }

    public function isPartiallyRefunded(): bool
    {
        return $this->checkStatus('partially refunded');
    }

    /**
     * @return string
     */
    public function getResponseText()
    {
        return (string) trim($this->data['status']);
    }

    /**
     * Extracts status from the response.
     *
     * @param mixed $type
     *
     * @return bool
     */
    public function checkStatus($type)
    {
        $string = strtolower($this->getResponseText());

        return in_array($string, [$type]);
    }
}
