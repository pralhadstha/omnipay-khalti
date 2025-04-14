# Omnipay: Khalti

**Khalti driver for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP.

This package implements Khalti support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/).

To install, simply require `pralhadstha/omnipay-khalti` with Composer:

```
composer require pralhadstha/omnipay-khalti
```

## Basic Usage

### Purchase

```php
    use Omnipay\Omnipay;
    use Exception;

    $gateway = Omnipay::create('Khalti_Khalti');

    $gateway->setSecretKey('secret_key_provided_by_khalti');
    $gateway->setTestMode(true);

    try {
        $response = $gateway->purchase([
            'amount' =>  10000, // Rs. 100 in paisa
            'purchaseOrderId' => 'SH-100',
            'purchaseOrderName' => "Basmati Rice 500gm",
            'websiteUrl' =>  'https://merchant.com/',
            'returnUrl' => 'https://merchant.com/payment/1/complete',
        ])->send();

        if ($response->isRedirect()) {
            $response->redirect();
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
```

After successful payment and redirect back to merchant site, you can verify the payment status and work accordingly.

### Verify Payment

```php
    $gateway = Omnipay::create('Khalti_Khalti');

    $gateway->setSecretKey('secret_key_provided_by_khalti');
    $gateway->setTestMode(true);

    $payload = json_decode($_GET['data'], true);

    try {
        $response = $gateway->fetchTransaction([
            'paymentId' => $payload['pidx']
        ])->send();

        if ($response->isSuccessful()) {
            // Verified
        } else {
            // Unverified
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
```

## Working Example

Want to see working examples before integrating them into your project? View the examples **[here](https://github.com/pralhadstha/payment-gateways-examples)**

## Official Doc

Please follow the [Official Doc](https://docs.khalti.com/) to understand about the parameters and their descriptions.

## Contributing

Contributions are **welcome** and will be fully **credited**.

Contributions can be made via a Pull Request on [Github](https://github.com/pralhadstha/omnipay-khalti).

## Support

If you are having general issues with Omnipay Khalti, drop an email to pralhad.shrestha05@gmail.com for quick support.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/pralhadstha/omnipay-khalti/issues),
or better yet, fork the library and submit a pull request.

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
