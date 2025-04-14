<?php

namespace Omnipay\Khalti\Message;

use Omnipay\Common\Message\RequestInterface;

class PurchaseResponse extends BaseAbstractResponse
{
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
        $this->request = $request;
        $this->data = $data;
        $this->redirectUrl = $data['payment_url'];
    }
}
