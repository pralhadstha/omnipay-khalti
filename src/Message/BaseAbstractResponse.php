<?php

namespace Omnipay\Khalti\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class BaseAbstractResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $redirectUrl;

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return true;
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return $this->getData();
    }
}
