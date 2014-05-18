<?php

namespace ElleOL\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use ElleOL\ApiBundle\Entity\Sale;

class SaleController extends Controller
{
    /**
     * @Route("/update")
     * @Template()
     */
    public function updateAction()
    {
        $resp = $this->get('etsy_helper')->updateSalesCount();
        return new Response(json_encode($resp));
    }

    /**
     * @Route("/index")
     * @Template()
     */
    public function indexAction()
    {
        $numSales = $this->get('doctrine')->getRepository("EOLApiBundle:Sale")->getLatestCount();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 0,
            CURLOPT_URL => 'https://agent.electricimp.com/7FaKnIJOtsHD?led=1&timer=5'
        ));
        curl_exec($curl);
        curl_close($curl);
        return new Response(json_encode(array("numSales" => $numSales)));
    }

    /**
     * @Route("/delete")
     * @Template()
     */
    public function deleteAction()
    {
    }

}
