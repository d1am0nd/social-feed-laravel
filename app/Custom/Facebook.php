<?php

namespace App\Custom;

use Exception;
use App\Custom\SocialInterface;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class Facebook implements SocialInterface
{

    private $fb, $id;

    public function __construct(LaravelFacebookSdk $fb, $id)
    {
        $this->fb = $fb;
        $this->id = $id;
        $this->fb->setDefaultAccessToken($this->getAppAccessToken());
    }

    public function getLastFromFeed()
    {
        return $this->getPageFeed()[0];
    }

    private function getPageFeed()
    {
        try {
            return $this->decode($this->fb->get('/' . $this->id . '/posts')->getGraphEdge()->asJson());
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            throw $e;
        }
    }

    private function getAppAccessToken()
    {
        $url = 'https://graph.facebook.com/oauth/access_token?client_id=' . env('FACEBOOK_APP_ID') . 
        '&client_secret=' . env('FACEBOOK_APP_SECRET') . 
        '&grant_type=client_credentials';

        try{
            $result = file_get_contents($url);
        } catch(Exception $e) {
            throw new Exception('There was a problem getting an app access token');
        }

        return explode('=', $result)[1];
    }

    private function decode($stuff)
    {
        return json_decode($stuff);
    }
}
