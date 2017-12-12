<?php
/**
 * Created by PhpStorm.
 * User: gianfranco
 * Date: 11/12/17
 * Time: 18:23
 */

namespace Omnipay\CECA\Messages;


use Omnipay\Common\Exception\InvalidResponseException;

class CompletePurchaseRequest extends PurchaseRequest
{
    public function getData()
    {
        $our_data=array();
        $our_data['MerchantID'] =$this->getParameter('MerchantID');
        $our_data['AcquirerBIN'] =$this->getParameter('AcquirerBIN');
        $our_data['TerminalID'] =$this->getParameter('TerminalID');

        $query = $this->httpRequest->request;

        $data = array();
        $clave_encriptacion =$this->getParameter('clave_encriptacion');
        $data['MerchantID'] = $query->get('MerchantID');
        $data['AcquirerBIN'] = $query->get('AcquirerBIN');
        $data['TerminalID'] = $query->get('TerminalID');
        $data['Num_operacion'] = $query->get('Num_operacion');
        $data['Importe'] = $query->get('Importe');
        $data['TipoMoneda'] = $query->get('TipoMoneda');
        $data['Exponente'] = $query->get('Exponente');
        $data['Firma'] = $query->get('Firma');
        $data['Referencia'] = $query->get('Referencia');

        $firmaBack = $this-> checkFirma($data, $clave_encriptacion);
        $this->checkInfo($data,$our_data );

        if($firmaBack !== $data['Firma']){
            throw new InvalidResponseException('Firma Erronea');
        }

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }

    private function checkInfo($data, $our_data){

        if ($data['MerchantID'] !==  $our_data['MerchantID']){
            throw new InvalidResponseException('Wrong MerchantID');
        }elseif ($data['AcquirerBIN'] !==  $our_data['AcquirerBIN']){
            throw new InvalidResponseException('Wrong AcquirerBIN');
        }elseif ($data['TerminalID'] !==  $our_data['TerminalID']){
            throw new InvalidResponseException('Wrong TerminalID');
        }
    }

    private function checkFirma($data, $clave_encriptacion){
        $firma =
            $clave_encriptacion
            . $data['MerchantID']
            . $data['AcquirerBIN']
            . $data['TerminalID']
            . $data['Num_operacion']
            . $data['Importe']
            . $data['TipoMoneda']
            . $data['Exponente']
            . $data['Referencia'];
        $firma = hash('sha256', $firma, false);
        return $firma;

    }
}