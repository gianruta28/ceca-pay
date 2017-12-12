<?php
/**
 * Created by PhpStorm.
 * User: gianfranco
 * Date: 11/12/17
 * Time: 19:01
 */

namespace Omnipay\CECA\Messages;


use Omnipay\Common\Message\AbstractResponse;
use Symfony\Component\HttpFoundation\Response;

class CompletePurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
       return true;
    }

    public function getTransactionReference()
    {
        return $this->data['Num_aut'];
    }
    public function getTransactionId()
    {
        return $this->data['Num_operacion'];
    }
    public function getOkResponse(){
        return new Response('$*$OKY$*$');
    }
}