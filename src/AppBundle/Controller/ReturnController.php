<?php
/**
 * Created by PhpStorm.
 * User: gianfranco
 * Date: 11/12/17
 * Time: 18:30
 */

namespace AppBundle\Controller;

use Omnipay\CECA\Messages\CompletePurchaseResponse;
use Omnipay\Omnipay;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


class ReturnController extends Controller
{
    /**
     * @Route("/return")
     */


    public function returnAction(Request $request){
        $gateway = Omnipay::create('CECA');
        /**
         * @var CompletePurchaseResponse $response
         */
        $gateway->setMerchantID('081582793');
        $gateway->setAcquirerBIN('0000554026');
        $gateway-> setTerminal('00000003');
        $gateway->setClaveEncriptacion('E6DBVG5H');
        $response = $gateway-> completePurchase()->send();

        if ($response->isSuccessful()){
            return $response->getOkResponse();
        }

    }

}