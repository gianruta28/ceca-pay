<?php
/**
 * Created by PhpStorm.
 * User: gianfranco
 * Date: 5/12/17
 * Time: 16:58
 */

namespace Omnipay\CECA;

use Symfony\Component\HttpFoundation\Request;
use Omnipay\Common\AbstractGateway;


class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Ceca';
    }
    public function getDefaultParameters()
    {
        return array(
            'TipoMoneda' => '978',
            'Exponente' => '2',
            'Idioma' => '1',
            'Cifrado' => 'SHA2',
            'Pago_soportado' => 'SSL',
        );
    }
    //Set merchanID - required
    public function setMerchantID($MerchantID)
    {
        return $this->setParameter('MerchantID', $MerchantID);
    }
    //Set AcquirerBIN - required
    public function setAcquirerBIN($AcquirerBIN)
    {
        return $this->setParameter('AcquirerBIN', $AcquirerBIN);
    }
    //Set TerminalID - required
    public function setTerminal($TerminalID)
    {
        return $this->setParameter('TerminalID', $TerminalID);
    }
    //Set TipoMoneda - required
    public function setTipoMoneda($TipoMoneda)
    {
        return $this->setParameter('TipoMoneda', $TipoMoneda);
    }
    public function  setImporte($Importe){
        return $this->setParameter('Importe', $Importe);
    }
    //Set Idioma - required
    public function setIdioma($Idioma)
    {
        return $this->setParameter('Idioma', $Idioma);
    }
    //Set Idioma - required
    public function setClaveEncriptacion($clave_encriptacion)
    {
        return $this->setParameter('clave_encriptacion', $clave_encriptacion);
    }
    //Set UrlOk - required
    public function setUrlOk($url)
    {
        return $this->setParameter('URL_OK', $url);
    }
    //Set UrlNOK - required
    public function setUrlNoOk($url)
    {
        return $this->setParameter('URL_NOK', $url);
    }

    //Set Mode
    public function setMode($mode)
    {
        return $this->setParameter('testMode', $mode);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('Omnipay\CECA\Messages\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CECA\Messages\CompletePurchaseRequest', $parameters);
    }


}