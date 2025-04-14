<?php

namespace Omnipay\Khalti\Message;

class PurchaseRequest extends BaseAbstractRequest
{
    public $purchaseEndpoint = 'epayment/initiate/';

    public function getData(): array
    {
        $this->validate('returnUrl', 'websiteUrl', 'amount', 'purchaseOrderId', 'purchaseOrderName');

        return array_merge([
            'return_url' => $this->getReturnUrl(),
            'website_url' => $this->getWebsiteUrl(),
            'amount' => $this->getAmount(),
            'purchase_order_id' => $this->getPurchaseOrderId(),
            'purchase_order_name' => $this->getPurchaseOrderName(),
        ], $this->getOptionalData());
    }

    public function getOptionalData(): array
    {
        return array_filter([
            'customer_info' => $this->getCustomerInfo(),
            'amount_breakdown' => $this->getAmountBreakdown(),
            'product_details' => $this->getProductDetails(),
            'merchant_username' => $this->getMerchantUsername(),
            'merchant_extra' => $this->getMerchantExtra(),
        ]);
    }

    public function sendData($data)
    {
        $headers = [
            'Authorization' => "Key {$this->getSecret()}",
            'Content-Type' => 'application/json',
        ];

        $response = $this->httpClient->request('POST', $this->getEndpoint(), $headers, json_encode($data));

        return $this->response = new PurchaseResponse($this, $this->handleResponse($response));
    }

    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        $endPoint = $this->getEndpointBase();

        return "{$endPoint}{$this->purchaseEndpoint}";
    }
}
