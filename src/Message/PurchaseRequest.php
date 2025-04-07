<?php

namespace Omnipay\Khalti\Message;

class PurchaseRequest extends BaseAbstractRequest
{
    public $purchaseEndpoint = 'epayment/initiate/';

    public function getData() {}

    public function sendData($data) {}

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        $endPoint = $this->getEndpointBase();

        return "{$endPoint}{$this->purchaseEndpoint}";
    }
}
