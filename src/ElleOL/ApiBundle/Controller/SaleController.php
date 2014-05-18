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
        $auth = array (
          'consumer_key' => 'wef33dv7danu3ba1m0xnwgl6',
          'consumer_secret' => '3nne1t9fe6',
          'token_secret' => '8f861f9a80f5a3798ee7c517f79300',
          'token' => 'b6179c49ea',
          'access_token' => 'f2845473d8f80cbf94c8299e84cf74',
          'access_token_secret' => '7b75995db6',
        );

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
