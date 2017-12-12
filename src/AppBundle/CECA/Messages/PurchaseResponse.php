<?php
/**
 * Created by PhpStorm.
 * User: gianfranco
 * Date: 5/12/17
 * Time: 18:33
 */

namespace Omnipay\CECA\Messages;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;


class PurchaseResponse extends   AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return $this-> getRequest()->getEndpoint();
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectData()
    {
     return $this->data;
    }
}