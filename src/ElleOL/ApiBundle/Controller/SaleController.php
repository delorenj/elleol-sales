<?php

namespace ElleOL\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class SaleController extends Controller
{
    /**
     * @Route("/new")
     * @Template()
     */
    public function newAction()
    {
    }

    /**
     * @Route("/index")
     * @Template()
     */
    public function indexAction()
    {
        $auth = require("/etc/apache2/conf.d/etsy-oauth.php");

        $client = new \Etsy\EtsyClient($auth['consumer_key'], $auth['consumer_secret']);
        $client->authorize($auth['access_token'], $auth['access_token_secret']);

        $api = new \Etsy\EtsyApi($client);

        var_dump(($api->getUser(array('params' => array('user_id' => '__SELF__')))));
        die();
    }

    /**
     * @Route("/delete")
     * @Template()
     */
    public function deleteAction()
    {
    }

}
