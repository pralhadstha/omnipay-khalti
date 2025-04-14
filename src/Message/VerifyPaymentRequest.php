<?php

namespace Omnipay\Khalti\Message;

class VerifyPaymentRequest extends BaseAbstractRequest
{
    public $verifyEndpoint = 'epayment/lookup/';

    public function getData()
    {
        $this->validate('paymentId');

        return [
            'pidx' => $this->getPaymentId(),
        ];
    }

    public function sendData($data): VerifyPaymentResponse
    {
        $headers = [
            'Authorization' => "Key {$this->getSecret()}",
            'Content-Type' => 'application/json',
        ];

        $response = $this->httpClient->request('POST', $this->getEndpoint(), $headers, json_encode($data));

        $responseBody = $response->getBody()->getContents();

        return $this->response = new VerifyPaymentResponse($this, json_decode($responseBody, true));
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        $endPoint = $this->getEndpointBase();

        return "{$endPoint}{$this->verifyEndpoint}";
    }
}
