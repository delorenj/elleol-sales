<?php
namespace ElleOL\ApiBundle\Services;

use ElleOL\ApiBundle\Entity\Sale;

class EtsyHelper {

    protected $container;
    protected $em;
    protected $log;

    public function __construct($container, $em, $log) {
        $this->container = $container;
        $this->em = $em;
        $this->log = $log;
    }

    public function updateSalesCount() {
        $auth = require("/etc/apache2/conf.d/etsy-oauth.php");

        $client = new \Etsy\EtsyClient($auth['consumer_key'], $auth['consumer_secret']);
        $client->authorize($auth['access_token'], $auth['access_token_secret']);

        $api = new \Etsy\EtsyApi($client);
        $numSales = $api->findAllShopReceipts(array('params' => array('shop_id' => 'elleol')));
        if(is_array($numSales)) {
            $numSales = $numSales["count"];
            $latestSaleCount = intval($this->container->get('doctrine')->getRepository("EOLApiBundle:Sale")->getLatestCount());
            if($numSales !== $latestSaleCount) {
                $sale = new Sale();
                $sale->setSaleCount($numSales);
                $this->container->get('doctrine')->getManager()->persist($sale);
                $this->container->get('doctrine')->getManager()->flush();
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 0,
                    CURLOPT_URL => 'https://agent.electricimp.com/7FaKnIJOtsHD?led=1&timer=5'
                ));
                curl_exec($curl);
                curl_close($curl);
            }

            return array("numSales" => $numSales, "delta" => $numSales - $latestSaleCount);

        } else {
            throw new \Exception("Error contacting Etsy API");
        }
    }

    public function testImp($time = 5) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 0,
            CURLOPT_URL => 'https://agent.electricimp.com/7FaKnIJOtsHD?led=1&timer=' . $time
        ));
        curl_exec($curl);
        curl_close($curl);
    }
}