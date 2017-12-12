<?php

namespace AppBundle\Controller;

use Omnipay\Omnipay;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class PurchaseController extends Controller
{
    /**
     * @Route ("/")
     */
    public function pago() {
        $gateway = Omnipay::create('CECA') ;

        $gateway->setMerchantID('081582793');
        $gateway->setAcquirerBIN('0000554026');
        $gateway-> setTerminal('00000003');
        $gateway->setClaveEncriptacion('E6DBVG5H');
        $gateway->setMode(true);

        $response = $gateway->purchase(array(
            'Num_operacion'=> 8,
            'Importe'=> 5000,
            'URL_OK'=> 'http://localhost:8000',
            'URL_NOK'=> 'http://www.ceca.es'
            ))->send();
        $redirectData = $response->getRedirectData();
        $endpoint = $response->getRedirectUrl();
        print_r($redirectData);
        if(!$gateway){
            throw $this->createNotFoundException(
                'No hay Datos ni endpoint'
            );
        }
        return $this->render('default/index.html.twig', array(
            'data'=> $redirectData,
            'endpoint'=> $endpoint
        ));
    }
}
